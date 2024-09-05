<h2>Current Weather in {{ $city }}</h2>
@if(isset($weatherData) && is_array($weatherData))
    <p>Temperature: {{ $weatherData['temperature'] }}°C</p>
    <p>Humidity: {{ $weatherData['humidity'] }}%</p>
    <p>Weather Condition: {{ $weatherData['weatherCondition'] }}</p>
@else
    <p>Error: Unable to retrieve weather data.</p>
@endif