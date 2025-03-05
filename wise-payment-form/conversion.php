<?php

header("Content-Type: application/json");

if (isset($_POST['amount'])) {
    $amount = $_POST['amount'];
    $from = $_POST['from_currency'];
    $to = $_POST['to_currency'];

    $converted_amount = $amount * 83; // Example Conversion
    $response = array(
        'success' => true,
        'converted_amount' => $converted_amount,
        'our_fee' => 5,
        'gst_fee' => 2,
        'total_fees' => 7,
        'savings_amount' => 10
    );

    echo json_encode($response);
} else {
    echo json_encode(array(
        'success' => false,
        'message' => 'Invalid Input'
    ));
}

wp_die();
?>
