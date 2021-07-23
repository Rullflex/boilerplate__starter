const gulp = require('gulp');
const ttf2woff = require('gulp-ttf2woff');
const ttf2woff2 = require('gulp-ttf2woff2');

module.exports.copyFonts = function fonts() {
    return gulp
        .src(['src/**/*.woff'])
        .pipe(gulp.dest('build/'))
        .pipe(gulp.src(['src/**/*.woff2']))
        .pipe(gulp.dest('build/'));
};

module.exports.convertFonts = function fonts() {
    return gulp
        .src(['src/**/*.ttf', '!src/**/_*.ttf'])
        .pipe(ttf2woff2())
        .pipe(gulp.dest('build/'))
        .pipe(gulp.src(['src/**/*.ttf', '!src/**/_*.ttf']))
        .pipe(ttf2woff())
        .pipe(gulp.dest('build/'));
};
