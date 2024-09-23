<style>
    .currency-calculator {
        max-width: 400px;
        margin: 40px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .currency-calculator h2 {
        margin-top: 0;
    }

    .currency-calculator label {
        display: block;
        margin-bottom: 10px;
    }

    .currency-calculator input, .currency-calculator select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .currency-calculator button.calculate-button {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .currency-calculator button.calculate-button:hover {
        background-color: #3e8e41;
    }

    #result {
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
    }
</style>

<div class="currency-calculator">
    <h2>Currency Calculator</h2>
    <form>
        <label for="amount">Amount:</label>
        <br><br>
        <input type="number" id="amount" name="amount" value="" />
        <br><br>
        <label for="fromCurrency">From Currency:</label>
        <br><br>
        <select id="fromCurrency" name="fromCurrency">
            @foreach($currencies as $currency)
                <option value="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->code }})</option>
            @endforeach
        </select>
        <br><br>
        <label for="toCurrency">To Currency:</label>
        <br><br>
        <select id="toCurrency" name="toCurrency">
            @foreach($currencies as $currency)
                <option value="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->code }})</option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="calculate-button">Calculate</button>
    </form>
    <p id="result"></p>
</div>

<script>
    const apiUrl = 'https://api.nbp.pl/api/exchangerates/tables/a/';
    let currencies = [];
    let exchangeRates = {};

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            currencies = data[0].rates;
            exchangeRates = data[0].rates.reduce((acc, rate) => {
                acc[rate.code] = rate.mid;
                return acc;
            }, {});
        });

    document.querySelector('form').addEventListener('submit', (e) => {
        e.preventDefault();
        const amount = document.getElementById('amount').value;
        const fromCurrency = document.getElementById('fromCurrency').value;
        const toCurrency = document.getElementById('toCurrency').value;

        const result = (amount * exchangeRates[toCurrency]) / exchangeRates[fromCurrency];
        document.getElementById('result').innerText = `Result: ${result.toFixed(2)} ${toCurrency}`;
    });
</script>