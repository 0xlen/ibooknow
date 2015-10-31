var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var bowerDir = './resources/assets/bower/';

elixir(function(mix) {

    mix.scripts([
        'jquery/dist/jquery.min.js',

        'moment/min/moment.min.js',
        'moment/min/locales.min.js',
        'moment/min/moment-with-locales.min.js',

        'fullcalendar/dist/fullcalendar.min.js',
        'fullcalendar/dist/gcal.js',
        'fullcalendar/dist/lang-all.js',

    ], 'public/js/all.js', bowerDir);

    mix.styles([
        'fullcalendar/dist/fullcalendar.min.css'
    ], 'public/css/app.css', bowerDir);

});
