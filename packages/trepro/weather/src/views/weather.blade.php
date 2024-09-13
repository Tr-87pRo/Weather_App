<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7; 
    }
    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px; 
        text-align: center;
    }
    .input-box {
        display: inline-block;
        width: 40%; 
        margin: 20px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px; 
    }
    .weather-data {
        display: inline-block;
        width: 40%; 
        margin: 20px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px; 
    }
    .weather-data h2 {
        margin-top: 0;
        color: #333; 
    }
    .weather-data p {
        margin-bottom: 10px;
        color: #666; 
    }
    .temperature-toggle {
        margin-top: 10px;
        background-color: #4CAF50; 
        color: #fff; 
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }
    .temperature-toggle:hover {
        background-color: #3e8e41; 
    }
    
    label {
        margin-bottom: 10px;
    }
    button[type="submit"] {
        margin-top: 20px;
    }
    .temperature-toggle {
        margin-left: 10px;
    }
    .fetch-weather-button {
        background-color: #4CAF50; 
        color: #fff; 
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }
    .fetch-weather-button:hover {
        background-color: #3e8e41; 
    }
</style>

<div class="container">
    <div class="input-box">
        <form>
            <label for="city">Enter a city:</label>
            <br><br> 
            <input type="text" id="city" name="city" value="{{ $city }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <br><br> 
            <label for="temperatureUnit">Temperature Unit:</label>
            <br><br> 
            <select id="temperatureUnit" name="temperatureUnit" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <br> 
                <option value="C" {{ $temperatureUnit == 'C' ? 'selected' : '' }}>Celsius</option>
                <br> 
                <option value="F" {{ $temperatureUnit == 'F' ? 'selected' : '' }}>Fahrenheit</option>
            </select>
            <br>
            <button type="submit" class="fetch-weather-button">Get Weather</button>
        </form>
    </div>
    <div class="weather-data">
        <h2>Current Weather in {{ $city }}</h2>
        @if(isset($weatherData) && is_array($weatherData))
            <input type="hidden" id="temperature-unit" value="{{ $temperatureUnit }}">
            <p>Temperature: 
                <span id="temperature">{{ $weatherData['temperature'] ?? 'N/A' }}{{ $temperatureUnit }}</span>
            </p>
            <p>Feels Like: {{ $weatherData['feels_like'] ?? 'N/A' }}{{ $temperatureUnit }}</p>
            <p>Min Temperature: {{ $weatherData['temp_min'] ?? 'N/A' }}{{ $temperatureUnit }}</p>
            <p>Max Temperature: {{ $weatherData['temp_max'] ?? 'N/A' }}{{ $temperatureUnit }}</p>
            <p>Pressure: {{ $weatherData['pressure'] ?? 'N/A' }} hPas</p>
            <p>Humidity: {{ $weatherData['humidity'] ?? 'N/A' }}%</p>
            <p>Weather Condition: {{ $weatherData['description'] ?? 'N/A' }}</p>
            <button class="temperature-toggle" style="margin-left: 10px;" onclick="toggleTemperatureUnit()">Switch to {{ $temperatureUnit === 'C' ? 'Fahrenheit' : 'Celsius' }}</button>
        @else
            <p>Error: {{ $error ?? 'Unable to retrieve weather data.' }}</p>
        @endif
    </div>
</div>

{{-- <div class="currency-calculator">   
      <h2>Currency Calculator</h2>
    <form>
        <label for="amount">Amount:</label>
        <br><br>
        <input type="number" id="amount" name="amount" value="" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <br><br>
        <label for="fromCurrency">From Currency:</label>
        <br><br>
        <select id="fromCurrency" name="fromCurrency" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            @foreach($currencies as $currency)
                <option value="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->code }})</option>
            @endforeach
        </select>
        <br><br>
        <label for="toCurrency">To Currency:</label>
        <br><br>
        <select id="toCurrency" name="toCurrency" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            @foreach($currencies as $currency)
                <option value="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->code }})</option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="calculate-button">Calculate</button>
    </form>
    <p id="result"></p>
</div> --}}

<script>
    let temperatureUnit = document.getElementById('temperature-unit').value;

    function toggleTemperatureUnit() {
        temperatureUnit = temperatureUnit === 'C' ? 'F' : 'C';
        document.location.href = '/weather?city={{ $city }}&temperatureUnit=' + temperatureUnit;
    }
    
    // const apiUrl = 'https://api.nbp.pl/api/exchangerates/tables/a/';
    // let currencies = [];
    // let exchangeRates = {};

    
    // fetch(apiUrl)
    //     .then(response => response.json())
    //     .then(data => {
    //         currencies = data[0].rates;
    //         exchangeRates = data[0].rates.reduce((acc, rate) => {
    //             acc[rate.code] = rate.mid;
    //             return acc;
    //         }, {});
    //     });

    
    // document.querySelector('form').addEventListener('submit', (e) => {
    //     e.preventDefault();
    //     const amount = document.getElementById('amount').value;
    //     const fromCurrency = document.getElementById('fromCurrency').value;
    //     const toCurrency = document.getElementById('toCurrency').value;

        
    //     const result = (amount * exchangeRates[toCurrency]) / exchangeRates[fromCurrency];
    //     document.getElementById('result').innerText = `Result: ${result.toFixed(2)} ${toCurrency}`;
    // });
</script>

