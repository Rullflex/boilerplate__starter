const gulp = require('gulp');
const ttf2woff = require('gulp-ttf2woff');
const ttf2woff2 = require('gulp-ttf2woff2');

module.exports.copyFonts = function copyFonts() {
    return gulp.src(['src/**/*.{ttf,woff2,woff}']).pipe(gulp.dest('build/'));
};

module.exports.convertFonts = function convertFonts() {
    return gulp
        .src(['src/**/*.ttf', '!src/**/_*.ttf'])
        .pipe(ttf2woff2())
        .pipe(gulp.dest('src/'))
        .pipe(gulp.src(['src/**/*.ttf', '!src/**/_*.ttf']))
        .pipe(ttf2woff())
        .pipe(gulp.dest('src/'));
};
