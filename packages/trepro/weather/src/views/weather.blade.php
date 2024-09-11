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

<script>
    let temperatureUnit = document.getElementById('temperature-unit').value;

    function toggleTemperatureUnit() {
        temperatureUnit = temperatureUnit === 'C' ? 'F' : 'C';
        document.location.href = '/weather?city={{ $city }}&temperatureUnit=' + temperatureUnit;
    }
</script>