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
</style>

<div class="weather-data">
    <h2>Current Weather in London</h2>
    @if(isset($weatherData) && is_array($weatherData))
        <input type="hidden" id="temperature-unit" value="{{ $temperatureUnit }}">
        <p>Temperature: 
            <span id="temperature">{{ $weatherData['temperature'] ?? 'N/A' }}{{ $temperatureUnit }}</span>
            <button class="temperature-toggle" onclick="toggleTemperatureUnit()">Switch to {{ $temperatureUnit === 'C' ? 'Fahrenheit' : 'Celsius' }}</button>
        </p>
        <p>Humidity: {{ $weatherData['humidity'] ?? 'N/A' }}%</p>
        <p>Weather Condition: {{ $weatherData['weatherCondition'] ?? 'N/A' }}</p>
    @else
        <p>Error: {{ $error ?? 'Unable to retrieve weather data.' }}</p>
    @endif
</div>

<script>
    let temperatureUnit = document.getElementById('temperature-unit').value;

    function toggleTemperatureUnit() {
        temperatureUnit = temperatureUnit === 'C' ? 'F' : 'C';
        document.location.href = '/weather?temperatureUnit=' + temperatureUnit;
    }
</script>