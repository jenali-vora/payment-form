<?php
header("Content-Type: application/json");

if (isset($_POST['amount']) && isset($_POST['from_currency']) && isset($_POST['to_currency'])) {
    $amount = $_POST['amount'];
    $from = $_POST['from_currency'];
    $to = $_POST['to_currency'];

    $apiKey = 'y4yf2TU9Kk95C9WziwAhhLUz4j38IfPv'; // Your API Key
    $apiUrl = "https://api.apilayer.com/exchangerates_data/latest?base=EUR&symbols=$from,$to";

    $headers = [
        "apikey: $apiKey"
    ];

    $context = stream_context_create([
        "http" => [
            "header" => implode("\r\n", $headers)
        ]
    ]);

    $response = file_get_contents($apiUrl, false, $context);
    $data = json_decode($response, true);

    if (isset($data['rates'][$from]) && isset($data['rates'][$to])) {
        $from_rate = $data['rates'][$from];
        $to_rate = $data['rates'][$to];

        $converted_amount = ($amount / $from_rate) * $to_rate; // Dynamic Conversion
        $our_fee = round($converted_amount * 0.02, 2); // 2% Fee
        $gst_fee = round($our_fee * 0.18, 2); // 18% GST
        $total_fees = $our_fee + $gst_fee; // Total Fees
        $savings_amount = round($converted_amount * 0.05, 2); // 5% Savings

        $response = array(
            'success' => true,
            'converted_amount' => round($converted_amount, 2),
            'our_fee' => $our_fee,
            'gst_fee' => $gst_fee,
            'total_fees' => $total_fees,
            'savings_amount' => $savings_amount
        );

        echo json_encode($response);
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'Invalid Currency Conversion'
        ));
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => 'Invalid Input'
    ));
}

wp_die();
?>
