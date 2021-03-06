const gulp = require('gulp');
const plumber = require('gulp-plumber');
const pug = require('gulp-pug');
const pugLinter = require('gulp-pug-linter');
const htmlValidator = require('gulp-w3c-html-validator');
const bemValidator = require('gulp-html-bem-validator');
const config = require('../config');

module.exports = function pug2html() {
    return (
        gulp
            .src(['src/**/*.pug', '!src/**/_*.pug'])
            .pipe(plumber())
            // .pipe(pugLinter({ reporter: 'default' }))
            .pipe(
                pug({
                    pretty: process.env.NODE_ENV === 'development' ? true : !config.pug2html.productionMinifyHTML,
                    data: {
                        env: process.env,
                    },
                }),
            )
            .pipe(htmlValidator())
            // .pipe(bemValidator())
            .pipe(gulp.dest('build'))
    );
};
