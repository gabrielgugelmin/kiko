//npm install --save-dev gulp-sass gulp-notify gulp-livereload gulp-concat gulp-sequence gulp-uglifycss gulp-uglifyjs

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    notify = require('gulp-notify'),
    livereload = require('gulp-livereload'),
    concat = require('gulp-concat'),
    gulpSequence = require('gulp-sequence'),
    uglifycss = require('gulp-uglifycss'),
    uglifyjs = require('gulp-uglifyjs'),
    autoprefixer = require('gulp-autoprefixer'),
    browserSync = require('browser-sync').create();

var path = 'assets/';

gulp.task('default', ['watch', 'sequence'], function() {
  
});

gulp.task('serve', ['styles'], function () {

  browserSync.init({
    server: "./"
  });

  gulp.watch(path + 'sass/**/*.scss', ['styles']);
  gulp.watch(path + 'css/style.css', ['concatcss']);
  gulp.watch(path + 'js/js.js', ['uglifyjs']);
  gulp.watch('*.html').on('change', browserSync.reload);
});

gulp.task('sequence', gulpSequence('styles', 'uglifyjs'));

gulp.task('styles', function() {
  gulp.src(path + 'sass/**/*.scss')
    .pipe(sass({'outputStyle': 'compressed'}).on('error', sass.logError))
    .pipe(autoprefixer({
      // http://browserl.ist/?q=%3E+1%25%2C+last+2+major+versions%2C+last+3+iOS+versions%2C+last+3+Safari+versions
      browsers: [
        '> 1%',
        'last 2 major versions',
        'last 3 iOS versions',
        'last 3 Safari versions',
        'not ie < 11',
      ],
    }))
    .pipe(gulp.dest(path + 'css/'))
    .pipe(browserSync.stream());
});

gulp.task('watch', function() {
  gulp.watch(path + 'sass/**/*.scss', ['styles']);
  gulp.watch(path + 'css/style.css',['concatcss']);
  gulp.watch(path + 'js/js.js', ['uglifyjs']);
  gulp.watch('*.html', ['html']);
});

gulp.task('uglifyjs', function () {
  gulp.src(['assets/js/*.js', '!assets/js/js.min.js', '!assets/js/jquery.min.js'])
    .pipe(concat('js.min.js'))
    .pipe(uglifyjs())
    .pipe(gulp.dest('assets/js/'))
    .pipe(browserSync.stream());
});

gulp.task('concatcss', function () {
  gulp.src([path + 'css/*.css', '!assets/css/style.min.css'])
    .pipe(concat('style.min.css'))
    .pipe(uglifycss())
    .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);