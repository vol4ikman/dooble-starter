// Run this command first:
// npm install gulp@3.9.2 gulp-uglify gulp-rename gulp-clean-css gulp-autoprefixer gulp-concat gulp-rtlcss gulp-notify

var gulp         = require('gulp'),
    uglify       = require('gulp-uglify'),
    rename       = require('gulp-rename'),
    cleanCSS     = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    concat       = require('gulp-concat'),
    rtlcss       = require('gulp-rtlcss'),
    notify       = require("gulp-notify");

/*******************************
    Define CSS Framework
*******************************/
// CSS framework definition came from the parent theme GULPFILE.JS

gulp.task('default', function(){
    console.log("Gulp default started");
});

/*************************
*****  Development *****
**************************/

var source_scripts = [
    framework_js,
    //'./assets/js/magnific.js'
];

gulp.task('js', function() {
  return gulp.src(source_scripts)
    .pipe(concat('assets-child.js'))                          // create main.js file
    .pipe(gulp.dest('./build/js/'))                     // move it to build/js/ directory
    .pipe(rename('assets-child.min.js'))                      // rename it
    .pipe(uglify())                                     // minify js
    .pipe(gulp.dest('./build/js/'))                     // move it again to build/js/ directory
    .pipe(notify("CHILD THEME Scripts compliled + minified"));      // notify message
});

var source_styles = [
    //'./assets/css/normalize.css'
];

// Auto generate css to RTL
gulp.task('css-to-rtl', function () {
    return gulp.src('./build/css/main-style.css')
        .pipe(rename('main.style.rtl.css'))
        .pipe(rtlcss())
        .pipe(gulp.dest('./build/css/'));
});

gulp.task('css', ['js'], function() {
  return gulp.src(source_styles)
    .pipe(concat('assets-child.css'))                        // create style.css file
    .pipe(gulp.dest('./build/css/'))                   // move it to build/css/ directory
    .pipe(rename('assets-child.min.css'))                    // rename it
    .pipe(cleanCSS())                                  // minify css
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('./build/css/'))                    // move it again to build/clean/ directory
    .pipe(notify("CHILD THEME Styles compliled + minified"));       // notify message
});

gulp.task('dev', ['css'], function(){
    console.log("Development scripts & styles compiled!!!");
});

/*************************
*****  Production  *****
**************************/
var production_scripts = [
    './build/js/assets-child.min.js',
    './build/js/scripts.js'
];

gulp.task('production-js', function() {
    return gulp.src(production_scripts)
      .pipe(concat('production-child.min.js'))              // create main.js file
      .pipe(gulp.dest('./build/js/'))                // move it to build/js/ directory
      .pipe(uglify())                               // minify js
      .pipe(gulp.dest('./build/js/'))               // move it again to build/js/ directory
      .pipe(notify("CHILD THEME Production script done"));      // notify message
});

var production_styles = [
    './build/css/assets-child.min.css',
    './build/css/main-style-child.css',
    './build/css/responsive-child.css'
];

gulp.task('production-css',['production-js'], function() {
    return gulp.src(production_styles)        // move it to build/css/ directory
    .pipe(rename('production-child.min.css'))       // rename it
    .pipe(cleanCSS())                         // minify css
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(concat('production-child.min.css'))
    .pipe(gulp.dest('./build/css/'))          // move it again to build/clean/ directory
    .pipe(notify("Production style done"));   // notify message
});

gulp.task('production', ['production-css'], function(){
    console.log("CHILD THEME Production executed!!!");
});
