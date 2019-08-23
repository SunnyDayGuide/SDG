(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/app"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/NavWeatherComponent.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/NavWeatherComponent.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _services_weather_weather__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../services/weather/weather */ "./resources/js/services/weather/weather.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    weatherCity: {
      type: String
    },
    route: {
      type: String
    }
  },
  data: function data() {
    return {
      weather: {
        weather: '',
        temperature: '',
        icon: ''
      }
    };
  },
  created: function created() {
    this.fetchWeather();
    setInterval(this.fetchWeather, 15 * 60 * 1000);
  },
  methods: {
    fetchWeather: function () {
      var _fetchWeather = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var condition, icons;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.next = 2;
                return _services_weather_weather__WEBPACK_IMPORTED_MODULE_1__["default"].forCity(this.weatherCity);

              case 2:
                condition = _context.sent;
                icons = [];
                condition.weather.slice(0, 1) // There's not enough room for > 1 emoji -> only display the first weather condition
                .forEach(function (weatherCondition) {
                  var isNight = weatherCondition.icon.includes('n');
                  var icon = _services_weather_weather__WEBPACK_IMPORTED_MODULE_1__["default"].getIcon(weatherCondition.id, isNight);
                  icons.push(icon);
                });
                this.weather.temperature = condition.main.temp.toFixed(0);
                this.weather.icon = icons[0];
                this.weather.weather = condition.weather;

              case 8:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function fetchWeather() {
        return _fetchWeather.apply(this, arguments);
      }

      return fetchWeather;
    }()
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/NavWeatherComponent.vue?vue&type=template&id=24492691&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/NavWeatherComponent.vue?vue&type=template&id=24492691& ***!
  \**********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("li", { staticClass: "nav-item pr-4 weather" }, [
    _c(
      "a",
      { staticClass: "condition align-middle", attrs: { href: _vm.route } },
      [
        _c("i", { staticClass: "wi", class: _vm.weather.icon }),
        _vm._v(" "),
        _c("span", { staticClass: "temp" }, [
          _vm._v(_vm._s(_vm.weather.temperature)),
          _c("i", { staticClass: "wi wi-degrees" })
        ])
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

window.Vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js"); // window.$ = window.jQuery = require('jquery');

__webpack_require__(/*! selectize */ "./node_modules/selectize/dist/js/selectize.js");
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('nav-weather', __webpack_require__(/*! ./components/NavWeatherComponent.vue */ "./resources/js/components/NavWeatherComponent.vue")["default"]);
var app = new Vue({
  el: '#app'
});

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
window.Popper = __webpack_require__(/*! popper.js */ "./node_modules/popper.js/dist/esm/popper.js")["default"];
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

  __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");
} catch (e) {}
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo'
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

/***/ }),

/***/ "./resources/js/components/NavWeatherComponent.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/NavWeatherComponent.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _NavWeatherComponent_vue_vue_type_template_id_24492691___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./NavWeatherComponent.vue?vue&type=template&id=24492691& */ "./resources/js/components/NavWeatherComponent.vue?vue&type=template&id=24492691&");
/* harmony import */ var _NavWeatherComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./NavWeatherComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/NavWeatherComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _NavWeatherComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _NavWeatherComponent_vue_vue_type_template_id_24492691___WEBPACK_IMPORTED_MODULE_0__["render"],
  _NavWeatherComponent_vue_vue_type_template_id_24492691___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/NavWeatherComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/NavWeatherComponent.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/NavWeatherComponent.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NavWeatherComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./NavWeatherComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/NavWeatherComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NavWeatherComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/NavWeatherComponent.vue?vue&type=template&id=24492691&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/NavWeatherComponent.vue?vue&type=template&id=24492691& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NavWeatherComponent_vue_vue_type_template_id_24492691___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./NavWeatherComponent.vue?vue&type=template&id=24492691& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/NavWeatherComponent.vue?vue&type=template&id=24492691&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NavWeatherComponent_vue_vue_type_template_id_24492691___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NavWeatherComponent_vue_vue_type_template_id_24492691___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/services/weather/weather.js":
/*!**************************************************!*\
  !*** ./resources/js/services/weather/weather.js ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var Weather =
/*#__PURE__*/
function () {
  function Weather() {
    _classCallCheck(this, Weather);
  }

  _createClass(Weather, [{
    key: "forCity",
    value: function () {
      var _forCity = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(city) {
        var key, response;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                key = '25b09bfe7f2dcb3b138d6054dc132b9b';
                _context.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("https://api.openweathermap.org/data/2.5/weather?id=".concat(city, "&appid=").concat(key, "&units=imperial"));

              case 3:
                response = _context.sent;
                return _context.abrupt("return", response.data);

              case 5:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }));

      function forCity(_x) {
        return _forCity.apply(this, arguments);
      }

      return forCity;
    }() // icons from: https://erikflowers.github.io/weather-icons/

  }, {
    key: "getIcon",
    value: function getIcon(weatherId, isNight) {
      var group = parseInt(weatherId.toString().charAt(0)); // Thunderstorms: Group 2xx

      if (weatherId >= 201 && weatherId <= 221) {
        return 'wi-thunderstorm';
      }

      if (weatherId === 200 || weatherId >= 230 && weatherId <= 232) {
        return 'wi-storm-showers';
      } // Drizzle: Group 3xx


      if (weatherId >= 300 && weatherId <= 302 || weatherId >= 313 && weatherId <= 321) {
        return 'wi-showers';
      }

      if (weatherId >= 310 && weatherId <= 312) {
        return 'wi-sprinkle';
      } // Rain: Group 5xx


      if (weatherId === 500) {
        return 'wi-sprinkle';
      }

      if (weatherId >= 501 && weatherId <= 504 || weatherId >= 520 && weatherId <= 531) {
        return 'wi-rain';
      }

      if (weatherId === 511) {
        return 'wi-rain-mix';
      } // Snow: Group 6xx


      if (weatherId >= 600 && weatherId <= 602 || weatherId >= 620 && weatherId <= 622) {
        return 'wi-snowflake-cold';
      }

      if (weatherId >= 611 && weatherId <= 613) {
        return 'wi-sleet';
      }

      if (weatherId >= 615 && weatherId <= 616) {
        return 'wi-rain-mix';
      } // Atmosphere: Group 7xx


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
      } // if (group === 8) {
      //     return '<i class="wi wi-cloudy"></i>';
      // }


      return 'wi-cloud-refresh';
    }
  }]);

  return Weather;
}();

/* harmony default export */ __webpack_exports__["default"] = (new Weather());

/***/ }),

/***/ "./resources/sass/admin.scss":
/*!***********************************!*\
  !*** ./resources/sass/admin.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/home.scss":
/*!**********************************!*\
  !*** ./resources/sass/home.scss ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!********************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ./resources/sass/home.scss ./resources/sass/admin.scss ***!
  \********************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/meredith/Sites/sunnyday/resources/js/app.js */"./resources/js/app.js");
__webpack_require__(/*! /Users/meredith/Sites/sunnyday/resources/sass/app.scss */"./resources/sass/app.scss");
__webpack_require__(/*! /Users/meredith/Sites/sunnyday/resources/sass/home.scss */"./resources/sass/home.scss");
module.exports = __webpack_require__(/*! /Users/meredith/Sites/sunnyday/resources/sass/admin.scss */"./resources/sass/admin.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);