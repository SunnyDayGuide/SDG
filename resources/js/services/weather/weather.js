import axios from 'axios';

class Weather {
    async forCity(city) {
        const key = '25b09bfe7f2dcb3b138d6054dc132b9b';

        response = await axios.get(
            'https://cors-anywhere.herokuapp.com/https://api.openweathermap.org/data/2.5/weather?id=' + city + '&appid=' + key + '&units=imperial'
        );

        return response.data;
    }

    // icons from: https://erikflowers.github.io/weather-icons/
    getIcon(weatherId, isNight) {
        const group = parseInt(weatherId.toString().charAt(0));

        // Thunderstorms: Group 2xx
        if (weatherId >= 201 && weatherId <= 221) {
            return 'wi-thunderstorm';
        }

        if (weatherId === 200 || (weatherId >= 230 && weatherId <= 232) ) {
            return 'wi-storm-showers';
        }

        // Drizzle: Group 3xx
        if ((weatherId >= 300 && weatherId <= 302) || (weatherId >= 313 && weatherId <= 321)) {
            return 'wi-showers';
        }

        if (weatherId >= 310 && weatherId <= 312) {
            return 'wi-sprinkle';
        }

        // Rain: Group 5xx
        if (weatherId === 500) {
            return 'wi-sprinkle';
        }

        if ((weatherId >= 501 && weatherId <= 504) || (weatherId >= 520 && weatherId <= 531)) {
            return 'wi-rain';
        }

        if (weatherId === 511) {
            return 'wi-rain-mix';
        }

        // Snow: Group 6xx
        if ((weatherId >= 600 && weatherId <= 602) || (weatherId >= 620 && weatherId <= 622)) {
            return 'wi-snowflake-cold';
        }

        if (weatherId >= 611 && weatherId <= 613) {
            return 'wi-sleet';
        }

        if (weatherId >= 615 && weatherId <= 616) {
            return 'wi-rain-mix';
        }

        // Atmosphere: Group 7xx
        if (weatherId === 701 || weatherId === 721 || weatherId === 741) {
            return 'wi-fog';
        }

        if (weatherId === 711) {
            return 'wi-smoke';
        }

        if (weatherId === 731 || weatherId === 751 || weatherId === 761) {
            return 'wi-dust';
        }

         if (weatherId === 762) {
            return 'wi-volcano';
        }

        if (weatherId === 771) {
            return 'wi-hurricane';
        }

        if (weatherId === 781) {
            return 'wi-tornado';
        }

        if (weatherId === 800) {
            return isNight ? 'wi-night-clear' : 'wi-day-sunny';
        }

        if (weatherId === 801 || weatherId === 802) {
            return isNight ? 'wi-night-alt-partly-cloudy' : 'wi-day-sunny-overcast';
        }

        if (weatherId === 803 || weatherId === 804) {
            return 'wi-cloudy';
        }

        // if (group === 8) {
        //     return '<i class="wi wi-cloudy"></i>';
        // }

        return 'wi-cloud-refresh';
    }
}

export default new Weather();
