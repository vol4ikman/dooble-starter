// jshint esversion: 6

// Run this command first:
// npm install gulp -g
// npm install gulp
// npm install gulpjs/gulp-cli -g
// npm install gulp-uglify gulp-rename gulp-clean-css gulp-postcss gulp-concat gulp-rtlcss gulp-notify

const gulp                  = require("gulp");
const { series, src, dest } = require('gulp');

const uglify                = require("gulp-uglify");
const rename                = require("gulp-rename");
const cleanCSS              = require("gulp-clean-css");
const postcss 				= require('gulp-postcss');
const concat                = require("gulp-concat");
const gulp_rtlcss           = require("gulp-rtlcss");
const notify                = require("gulp-notify");

/****************************
    Framework Libraries
****************************/
var framework = 'foundation'; // foundation or bootstrap <==================
if( framework == 'foundation' ) {
    var framework_js = './assets/' + framework + '/js/foundation.min.js';
    var framework_css = './assets/' + framework + '/css/foundation.min.css';
} else if( framework == 'bootstrap' ) {
    var framework_js = './assets/' + framework + '/js/bootstrap.min.js';
    var framework_css = './assets/' + framework + '/css/bootstrap.min.css';
}

/****************************************************************
    JS Libraries
    1. https://dimsemenov.com/plugins/magnific-popup/
    2. https://idangero.us/swiper/
    3. http://grsmto.github.io/simplebar/
    4. http://malsup.com/jquery/block/#overview
****************************************************************/
var source_scripts = [
    framework_js,
    './assets/js/magnific.js',
    './assets/js/swiper.min.js',
    './assets/js/simplebar.min.js',
    './assets/js/jquery.blockUI.js',
    './assets/js/functions.js'
];

function scripts() {
  return gulp.src(source_scripts)
      .pipe(concat('assets.js'))                          // create main.js file
      .pipe(gulp.dest('./build/js/'))                     // move it to build/js/ directory
      .pipe(rename('assets.min.js'))                      // rename it
      .pipe(uglify())                                     // minify js
      .pipe(gulp.dest('./build/js/'))                     // move it again to build/js/ directory
      .pipe(notify("Scripts compliled + minified"));      // notify message
}

/****************************
    CSS Libraries
****************************/
var source_styles = [
    './assets/css/normalize.css',
    framework_css,
    './assets/css/animate.css',
    './assets/css/magnific.css',
    './assets/css/simplebar.css',
    './assets/css/swiper.min.css'
];

function styles() {
    return gulp.src(source_styles)
        .pipe(concat('assets.css'))                        // create style.css file
        .pipe(gulp.dest('./build/css/'))                   // move it to build/css/ directory
        .pipe(rename('assets.min.css'))                    // rename it
        .pipe(cleanCSS())                                  // minify css
        .pipe(gulp.dest('./build/css/'))                    // move it again to build/clean/ directory
        .pipe(notify("Styles compliled + minified"));       // notify message
}

/****************************
    Build Development
***************************/
gulp.task( 'js', scripts );
gulp.task( 'css', styles );
gulp.task( 'dev', gulp.series( scripts, styles ) );

/*************************
*****  Production  *****
**************************/
// var production_scripts = [
//     './build/js/assets.min.js',
//     './build/js/scripts.js'
// ];
//
// gulp.task('production-js', function() {
//     return gulp.src(production_scripts)
//       .pipe(concat('production.min.js'))              // create main.js file
//       .pipe(gulp.dest('./build/js/'))                // move it to build/js/ directory
//       .pipe(uglify())                               // minify js
//       .pipe(gulp.dest('./build/js/'))               // move it again to build/js/ directory
//       .pipe(notify("Production script done"));      // notify message
// });
//
// var production_styles = [
//     './build/css/assets.min.css',
//     './build/css/main-style.css',
//     './build/css/responsive.css'
// ];
//
// gulp.task('production-css',['production-js'], function() {
//     return gulp.src(production_styles)        // move it to build/css/ directory
//     .pipe(rename('production.min.css'))       // rename it
//     .pipe(cleanCSS())                         // minify css
//     .pipe(autoprefixer({
//         browsers: ['last 2 versions'],
//         cascade: false
//     }))
//     .pipe(concat('production.min.css'))
//     .pipe(gulp.dest('./build/css/'))          // move it again to build/clean/ directory
//     .pipe(notify("Production style done"));   // notify message
// });
//
// gulp.task('production', ['production-css'], function(){
//     console.log("Production executed!!!");
// });
