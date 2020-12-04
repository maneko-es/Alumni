var gulp = require('gulp');
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var cssComb = require('gulp-csscomb');
var cleanCss = require('gulp-clean-css');
var notify = require('gulp-notify');

var nodeModulesPath = './node_modules/';

/*SASS*/
gulp.task('sass',function(){
    //gulp.src(['resources/assets/sass/front/**/*.scss'])
    gulp.src(['resources/assets/sass/intranet/**/*.scss'])
        .pipe(plumber({
            handleError: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('html/css'))
        .pipe(notify('css task finished'))
}).on('error', onError);

gulp.task('watch',function(){
    //gulp.watch('resources/assets/sass/front/**/*.scss',['sass']);
    gulp.watch('resources/assets/sass/intranet/**/*.scss',['sass']);
});

gulp.task('default',['sass']);


function onError(err) {
  console.log(err);
  this.emit('end');
}