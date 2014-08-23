var gulp = require('gulp');

var sass = require('gulp-sass');
var concatCss = require('gulp-concat-css');
var concatJS = require('gulp-concat');
var minifyCSS = require('gulp-minify-css');
var uglify = require('gulp-uglify');

gulp.task('sass', function () {
    gulp.src('dev/*.scss')
    .pipe(sass())
    .pipe(gulp.dest('dev/css'))
});

gulp.task('concatCSS', function () {
    gulp.src('dev/css/*.css')
    .pipe(concatCss("style.min.css"))
    .pipe(minifyCSS({keepBreaks:false}))
    .pipe(gulp.dest('.'))
});

gulp.task('concatJS', function () {
    gulp.src('dev/js/**/*.js')
    .pipe(concatJS('scripts.min.js'))
    .pipe(gulp.dest('.'))
});

gulp.task('default', ['sass', 'concatCSS', 'concatJS']);