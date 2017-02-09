var gulp         = require('gulp'),
    uglify       = require('gulp-uglify'),
    rename       = require('gulp-rename'),
    cleanCSS     = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    concat       = require('gulp-concat'),
    notify       = require("gulp-notify");

gulp.task('default', function(){
    console.log("Gulp default started");
});

/*************************
*****  Development *****
**************************/

var source_scripts = [
    './assets/foundation-6.2.1-ltr/js/vendor/foundation.min.js',
    './assets/js/device.min.js',
    './assets/js/magnific.js',
    './assets/js/slick.min.js',
    './assets/js/ajax.js',
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

var source_styles = [
    './assets/css/normalize.css',
    './assets/foundation-6.2.1-ltr/css/foundation.min.css',
    './assets/css/animate.css',
    './assets/css/magnific.css',
    './assets/css/slick.css'
];

gulp.task('css', ['js'], function() {
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

gulp.task('dev', ['css'], function(){
    console.log("Production executed!!!");
});

/*************************
*****  Production  *****
**************************/
var production_scripts = [
    './build/js/assets.min.js',
    './build/js/scripts.js'
];

gulp.task('production-js', function() {
    return gulp.src(production_scripts)
      .pipe(concat('production.min.js'))              // create main.js file
      .pipe(gulp.dest('./build/js/'))                // move it to build/js/ directory
      .pipe(uglify())                               // minify js
      .pipe(gulp.dest('./build/js/'))               // move it again to build/js/ directory
      .pipe(notify("Production script done"));      // notify message
});

var production_styles = [
    './build/css/assets.min.css',
    './build/css/main-style.css',
    './build/css/responsive.css'
];

gulp.task('production-css',['production-js'], function() {
    return gulp.src(production_styles)        // move it to build/css/ directory
    .pipe(rename('production.min.css'))       // rename it
    .pipe(cleanCSS())                         // minify css
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('./build/css/'))          // move it again to build/clean/ directory
    .pipe(notify("Production style done"));   // notify message
});

gulp.task('production', ['production-css'], function(){
    console.log("Production executed!!!");
});
