jQuery(document).ready(function ($) {
    function updateConversion() { //function call to ajax
        var fromCurrency = $('#send_currency').val();
        var toCurrency = $('#receive_currency').val();
        var amount = $('#you_send').val();

        if (fromCurrency === '' || toCurrency === '' || amount === '' || isNaN(amount)) {
            console.log("Invalid input");
            return;
        }

        console.log("From: " + fromCurrency);
        console.log("To: " + toCurrency);
        console.log("Amount: " + amount);
        console.log("AJAX URL: " + wise_payment_ajax.ajaxurl);

        $.ajax({ // ajax call post reqest
            url: wise_payment_ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'wise_payment_conversion',
                from_currency: fromCurrency,
                to_currency: toCurrency,
                amount: amount
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    $('#recipient_gets').val(response.converted_amount);
                    $('#our_fee').text(response.our_fee);
                    $('#gst_fee').text(response.gst_fee);
                    $('#total_fees').text(response.total_fees);
                    $('#savings_amount').text(response.savings_amount);
                } else {
                    console.error("API Error:", response.message);
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
                alert("AJAX Error: " + xhr.responseText);
            }
        });
    }

    $('#you_send, #send_currency, #receive_currency').on('change keyup', function () {
        updateConversion();
    });

    updateConversion();
});
