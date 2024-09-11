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
    <h2>Current Weather in {{ $city }}</h2>
    @if(isset($weatherData) && is_array($weatherData))
        <input type="hidden" id="temperature-unit" value="{{ $temperatureUnit }}">
        <p>Temperature: 
            <span id="temperature">{{ $weatherData['temperature'] ?? 'N/A' }}{{ $temperatureUnit }}</span>
            <button class="temperature-toggle" onclick="toggleTemperatureUnit()">Switch to {{ $temperatureUnit === 'C' ? 'Fahrenheit' : 'Celsius' }}</button>
        </p>
        <p>Feels Like: {{ $weatherData['feels_like'] ?? 'N/A' }}{{ $temperatureUnit }}</p>
        <p>Min Temperature: {{ $weatherData['temp_min'] ?? 'N/A' }}{{ $temperatureUnit }}</p>
        <p>Max Temperature: {{ $weatherData['temp_max'] ?? 'N/A' }}{{ $temperatureUnit }}</p>
        <p>Pressure: {{ $weatherData['pressure'] ?? 'N/A' }} hPa</p>
        <p>Humidity: {{ $weatherData['humidity'] ?? 'N/A' }}%</p>
        <p>Weather Condition: {{ $weatherData['description'] ?? 'N/A' }}</p>
    @else
        <p>Error: {{ $error ?? 'Unable to retrieve weather data.' }}</p>
    @endif
</div>

<script>
    let temperatureUnit = document.getElementById('temperature-unit').value;

    function toggleTemperatureUnit() {
        temperatureUnit = temperatureUnit === 'C' ? 'F' : 'C';
        document.location.href = '/weather?city={{ $city }}&temperatureUnit=' + temperatureUnit;
    }
</script>