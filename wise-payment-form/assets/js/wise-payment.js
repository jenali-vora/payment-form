jQuery(document).ready(function ($) {
    function updateConversion() {
        var fromCurrency = $('#send_currency').val();
        var toCurrency = $('#receive_currency').val();
        var amount = $('#you_send').val();

        if (amount === '' || isNaN(amount) || parseFloat(amount) <= 0) {
            return;
        }

        $.ajax({
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
                if (response.success) {
                    $('#currency_rate').text(`1 ${fromCurrency} = ${response.rate} ${toCurrency}`);
                    $('#recipient_gets').val(response.final_amount);
                    $('#bank_transfer_fee').text(response.bank_transfer_fee);
                    $('#our_fee').text(response.our_fee);
                    $('#savings_amount').text(response.savings_amount);
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Invalid Currency Conversion");
            }
        });
    }

    // setInterval(updateConversion, 30000);
    updateConversion();
    $('#you_send, #send_currency, #receive_currency').on('change keyup', function () {
        updateConversion();
    });
});
