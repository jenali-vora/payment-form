<?php
header("Content-Type: application/json");

if (isset($_POST['amount']) && isset($_POST['from_currency']) && isset($_POST['to_currency'])) {
    $amount = $_POST['amount'];
    $from = strtoupper(trim($_POST['from_currency']));
    $to = strtoupper(trim($_POST['to_currency']));

    $apiKey = "y4yf2TU9Kk95C9WziwAhhLUz4j38IfPv"; // ✅ Apni API Key Yaha Lagaye
    $apiUrl = "https://api.apilayer.com/exchangerates_data/latest?base=$from";

    $headers = array(
        "apikey: $apiKey"
    );

    $context = stream_context_create(array(
        "http" => array(
            "header" => implode("\r\n", $headers)
        )
    ));

    $response = file_get_contents($apiUrl, false, $context);
    $data = json_decode($response, true);

    if (isset($data['rates'][$to])) {
        $rate = $data['rates'][$to];

        $converted_amount = round($amount * $rate, 2);
        $bank_transfer_fee = 0; // 0% Bank Transfer Fee
        $our_fee = round($converted_amount * 0.03, 2); // 3% Our Fee
        $savings_amount = round($converted_amount * 0.05, 2); // 5% Savings
        $final_amount = $converted_amount - $our_fee;

        $response = array(
            'success' => true,
            'rate' => $rate,
            'converted_amount' => $converted_amount,
            'bank_transfer_fee' => $bank_transfer_fee,
            'our_fee' => $our_fee,
            'savings_amount' => $savings_amount,
            'final_amount' => $final_amount
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
