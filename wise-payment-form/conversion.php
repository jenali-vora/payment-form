<?php
header("Content-Type: application/json");

if (isset($_POST['amount']) && isset($_POST['from_currency']) && isset($_POST['to_currency'])) {
    $amount = floatval($_POST['amount']);
    $from = strtoupper(trim($_POST['from_currency']));
    $to = strtoupper(trim($_POST['to_currency']));

    $apiUrl = "https://wise.com/gateway/v1/rates?source=$from&target=$to";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "User-Agent: Mozilla/5.0",
        "Accept: application/json"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data['rate'])) {
        $rate = $data['rate'];
        $converted_amount = round($amount * $rate, 2);
        $bank_transfer_fee = 0;
        $our_fee = round($converted_amount * 0.03, 2);
        $savings_amount = round($converted_amount * 0.05, 2);
        $final_amount = $converted_amount - $our_fee;

        echo json_encode(array(
            'success' => true,
            'rate' => round($rate, 6),
            'converted_amount' => $converted_amount,
            'bank_transfer_fee' => $bank_transfer_fee,
            'our_fee' => $our_fee,
            'savings_amount' => $savings_amount,
            'final_amount' => $final_amount
        ));
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
?>
