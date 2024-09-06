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
        <p>Temperature: 
            @if($temperatureUnit == 'C')
                {{ $weatherData['temperature'] }}°C
                <button class="temperature-toggle" onclick="toggleTemperatureUnit()">Switch to Fahrenheit</button>
            @else
                {{ ($weatherData['temperature'] * 9/5) + 32 }}°F
                <button class="temperature-toggle" onclick="toggleTemperatureUnit()">Switch to Celsius</button>
            @endif
        </p>
        <p>Humidity: {{ $weatherData['humidity'] }}%</p>
        <p>Weather Condition: {{ $weatherData['weatherCondition'] }}</p>
    @else
        <p>Error: Unable to retrieve weather data.</p>
    @endif
</div>

<script>
    let temperatureUnit = 'C';
    let city = 'New York'; 

    function updateCity(newCity) {
        city = newCity;
        document.location.reload();
    }

    function toggleTemperatureUnit() {
        temperatureUnit = temperatureUnit === 'C' ? 'F' : 'C';
        document.location.reload();
    }
</script>