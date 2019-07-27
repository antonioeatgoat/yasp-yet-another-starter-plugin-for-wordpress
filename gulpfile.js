var gulp = require('gulp'),
    sass = require('gulp-sass'),
    cleanCSS = require('gulp-clean-css'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename');

const assetsPath = './assets',
    cssPath = assetsPath + '/css',
    scssPath = assetsPath + '/scss',
    jsPath = assetsPath + '/js';

gulp.task('default', ['main-css', 'main-js']);


// Styles
gulp.task('main-css', function () {

    var notMinified = gulp.src( [ scssPath + '/yasp.scss' ] )
    .pipe(sass({
            outputStyle: 'nested',
            precison: 3,
            includePaths: []
        }))
        .pipe(gulp.dest( cssPath ));

    return notMinified.pipe(cleanCSS({ advanced : true }))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest( cssPath ))
});


// Scripts
gulp.task('main-js', function () {
    return gulp.src( [ jsPath + '/yasp.js' ] )
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest( jsPath ));
});


// Watch
gulp.task('watch', function () {
    gulp.watch( scssPath + '/*.scss', ['main-css'] );
    gulp.watch( jsPath + '/yasp.js', ['main-js'] );
});