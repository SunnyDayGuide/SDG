<template>
    <div class="nav-item pr-4 weather">
        <a v-bind:href="route" class="condition align-middle">
            <i v-bind:class="weather.icon" class="wi"></i>
            <span class="temp">{{ weather.temperature }}<i class="wi wi-degrees"></i></span>
        </a>
    </div>
</template>

<script>
import weather from '../services/weather/weather';

export default {
    props: {
        weatherCity: {
            type: String,
        },
        route: {
            type: String,
        },
    },

    data() {
        return {
            weather: {
                weather: '',
                temperature: '',
                icon: '',
            },
        };
    },

    created() {
        this.fetchWeather();
        setInterval(this.fetchWeather, 15 * 60 * 1000);
    },

    methods: {
        async fetchWeather() {
            const condition = await weather.forCity(this.weatherCity);

            let icons = [];

            condition.weather
                .slice(0, 1) // There's not enough room for > 1 emoji -> only display the first weather condition
                .forEach(weatherCondition => {
                    const isNight = weatherCondition.icon.includes('n');

                    const icon = weather.getIcon(weatherCondition.id, isNight);

                    icons.push(icon);
                });

                this.weather.temperature = condition.main.temp.toFixed(0);
                this.weather.icon = icons[0];
                this.weather.weather = condition.weather;
        },
    },

};
</script>
