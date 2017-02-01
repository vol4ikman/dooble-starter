/******************************************************
****** Dep
******************************************************/
var gulp         = require('gulp'),
    uglify       = require('gulp-uglify'),
    rename       = require('gulp-rename'),
    cleanCSS     = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    concat       = require('gulp-concat'),
    notify       = require("gulp-notify");

gulp.task('production', ['js','css','main-js','ajax-js','main-css','responsive-css'], function(){
    //main-css-rtl
    console.log("Production executed!!!");
});

gulp.task('default', function(){
    console.log("Gulp started");
    console.log("Gulp is running: '"+this.isRunning+"'");
    console.log("Yuval looser");
});

/******************************************************
****** Include JS libraries HERE
******************************************************/
var source_scripts = [
    './assets/foundation-6.2.1-ltr/js/vendor/foundation.min.js',
    './assets/js/device.min.js',
    './assets/js/magnific.js',
    './assets/js/slick.min.js',
];

gulp.task('js', function() {
  return gulp.src(source_scripts)
    .pipe(concat('assets.js'))                          // create main.js file
    .pipe(gulp.dest('./build/js/'))                     // move it to build/js/ directory
    .pipe(rename('assets.min.js'))                      // rename it
    .pipe(uglify())                                     // minify js
    .pipe(gulp.dest('./build/js/'))                     // move it again to build/js/ directory
    .pipe(notify("Scripts compliled + minified"));      // notify message
});

gulp.task('ajax-js', function() {
  return gulp.src('./build/js/ajax.js')              // move it to build/js/ directory
    .pipe(rename('ajax.min.js'))                     // rename it
    .pipe(uglify())                                  // minify js
    .pipe(gulp.dest('./build/js/'))                  // move it again to build/js/ directory
    .pipe(notify("Ajax script was minified"));       // notify message
});

gulp.task('main-js', function() {
  return gulp.src('./build/js/scripts.js')              // move it to build/js/ directory
    .pipe(rename('scripts.min.js'))                      // rename it
    .pipe(uglify())                                     // minify js
    .pipe(gulp.dest('./build/js/'))                     // move it again to build/js/ directory
    .pipe(notify("Main script was minified"));      // notify message
});

/******************************************************
****** Include CSS libraries HERE
******************************************************/
var source_styles = [
    './assets/css/normalize.css',
    './assets/css/animate.css',
    './assets/css/magnific.css',
    './assets/css/slick.css'
];

gulp.task('css', function() {
  return gulp.src(source_styles)
    .pipe(concat('assets.css'))                        // create style.css file
    .pipe(gulp.dest('./build/css/'))                   // move it to build/css/ directory
    .pipe(rename('assets.min.css'))                    // rename it
    .pipe(cleanCSS())                                  // minify css
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('./build/css/'))                    // move it again to build/clean/ directory
    .pipe(notify("Styles compliled + minified"));       // notify message
});

gulp.task('main-css', function() {
    return gulp.src('./build/css/main-style.css')       // move it to build/css/ directory
    .pipe(rename('main-style.min.css'))                 // rename it
    .pipe(cleanCSS())                                   // minify css
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('./build/css/'))                    // move it again to build/clean/ directory
    .pipe(notify("Main style compliled + minified"));   // notify message
});

/*
gulp.task('main-css-rtl', function() {
    return gulp.src('./build/css/main-style-rtl.css')                        // move it to build/css/ directory
    .pipe(rename('main-style-rtl.min.css'))                 // rename it
    .pipe(cleanCSS())                                   // minify css
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('./build/css/'))                    // move it again to build/clean/ directory
    .pipe(notify("Main style compliled + minified"));   // notify message
});
*/

gulp.task('responsive-css', function() {
  return gulp.src('./build/css/responsive.css')         // move it to build/css/ directory
    .pipe(rename('responsive.min.css'))                 // rename it
    .pipe(cleanCSS())                                   // minify css
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('./build/css/'))                    // move it again to build/clean/ directory
    .pipe(notify("responsive style was minified"));     // notify message
});
