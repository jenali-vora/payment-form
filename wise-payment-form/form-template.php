<div class="transfer-money">
    <div class="currency-rate">
        <p id="currency_rate">Loading Rate...</p>
    </div>

    <div>
        <label>You Send:</label>
        <input type="number" id="you_send" value="1000">
    </div>

    <div>
        <label>From Currency:</label>
        <select id="send_currency">
            <?php
            $currencies = ['USD', 'INR', 'AUD', 'EUR', 'GBP', 'CAD', 'JPY', 'AED', 'SGD', 'ZAR'];
            foreach ($currencies as $currency) {
                echo "<option value='$currency'>$currency</option>";
            }
            ?>
        </select>
    </div>

    <div>
        <label>To Currency:</label>
        <select id="receive_currency">
            <?php
            foreach ($currencies as $currency) {
                echo "<option value='$currency'>$currency</option>";
            }
            ?>
        </select>
    </div>

    <div>
        <label>Recipient Gets:</label>
        <input type="text" id="recipient_gets" readonly>
    </div>

    <div>
        <p>Bank Transfer Fee: <span id="bank_transfer_fee">0</span></p>
        <p>Our Fee: <span id="our_fee"></span></p>
        <p>Savings Amount: <span id="savings_amount"></span></p>
    </div>
</div>
