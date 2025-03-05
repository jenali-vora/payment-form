<div class="transfer-money">
    <div>
        <label>You Send:</label>
        <input type="number" id="you_send" value="1000">
    </div>

    <div>
        <label>From Currency:</label>
        <select id="send_currency">
            <option value="USD">USD</option>
            <option value="INR">INR</option>
            <option value="AUD">AUD</option>
        </select>
    </div>

    <div>
        <label>To Currency:</label>
        <select id="receive_currency">
            <option value="INR">INR</option>
            <option value="USD">USD</option>
            <option value="AUD">AUD</option>
        </select>
    </div>

    <div>
        <label>Recipient Gets:</label>
        <input type="text" id="recipient_gets" readonly>
    </div>

    <div>
        <p>Our Fee: <span id="our_fee"></span></p>
        <p>GST Fee: <span id="gst_fee"></span></p>
        <p>Total Fees: <span id="total_fees"></span></p>
        <p>Savings Amount: <span id="savings_amount"></span></p>
    </div>
</div>
