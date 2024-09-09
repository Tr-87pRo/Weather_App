<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }
    .weather-data {
        max-width: 400px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .weather-data h2 {
        margin-top: 0;
    }
    .weather-data p {
        margin-bottom: 10px;
    }
    .temperature-toggle {
        margin-top: 10px;
    }
    .city-select {
        margin-bottom: 20px;
    }
</style>

<div class="weather-data">
    <h2>Current Weather in 
        <select class="city-select" onchange="updateCity(this.value)">
            <option value="New York">New York</option>
            <option value="London">London</option>
            <option value="Paris">Paris</option>
            <option value="Tokyo">Tokyo</option>
            
        </select>
    </h2>
    @if(isset($weatherData) && is_array($weatherData))
        <input type="hidden" id="temperature-unit" value="{{ $temperatureUnit }}">
        <p>Temperature: 
            <span id="temperature"></span>
            <button class="temperature-toggle" onclick="toggleTemperatureUnit()">Switch to Fahrenheit</button>
        </p>
        <p>Humidity: {{ $weatherData['humidity'] ?? 'N/A' }}%</p>
        <p>Weather Condition: {{ $weatherData['weatherCondition'] }}</p>
    @else
        <p>Error: Unable to retrieve weather data.</p>
    @endif
</div>

<script>
    let city = 'New York'; 
    let temperatureUnit = document.getElementById('temperature-unit').value;

    function updateCity(newCity) {
        city = newCity;
        document.location.reload();
    }

    function toggleTemperatureUnit() {
        temperatureUnit = temperatureUnit === 'C' ? 'F' : 'C';
        document.location.reload();
    }

    function updateTemperatureDisplay() {
        let temperature = {{ $weatherData['temperature'] }};
        if (temperatureUnit === 'C') {
            document.getElementById('temperature').innerHTML = temperature + '°C';
        } else {
            document.getElementById('temperature').innerHTML = (temperature * 9/5) + 32 + '°F';
        }
    }

    updateTemperatureDisplay();
</script>