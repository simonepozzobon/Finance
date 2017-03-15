var gulp = require('gulp');
gulp.task('default', function () { console.log('Hello Gulp!') });

var elixir = require('laravel-elixir');
var bowerDir = './resources/assets/bower/';

elixir(function(mix) {
    mix.scripts([
       '../../bower_components/fullcalendar/dist/fullcalendar.min.js',
       '../../bower_components/fullcalendar/dist/gcal.min.js'
    ], 'public/js/calendar.js');
    mix.styles([
       '../../bower_components/fullcalendar/dist/fullcalendar.min.css',
       '../../bower_components/fullcalendar/dist/fullcalendar.print.min.css'
    ], 'public/css/calendar.css')
});
