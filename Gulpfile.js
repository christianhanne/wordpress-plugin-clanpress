'use strict';

var gulp = require('gulp');
var gutil = require('gulp-util');

var source = require('vinyl-source-stream');
var rename = require('gulp-rename');
var browserify = require('browserify');
var babel = require('babelify');
var glob = require('glob');
var es = require('event-stream');

var zip = require('gulp-zip');

var sass = require('gulp-sass');
var minifyCss = require('gulp-minify-css');
var sourcemaps = require('gulp-sourcemaps');

var settings = require('./package.json');

gulp.task('compile:css', () => {
  return gulp.src('src/scss/*')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(minifyCss())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('dist/css'));
});

gulp.task('compile:js', () => {
	glob('./src/es6/*.es6', function(error, files) {
    if (error) {
			done(error);
		}

    var tasks = files.map((entry) => {
      return browserify({ entries: [entry] })
			  .transform(babel)
        .bundle()
        .pipe(source(entry))
        .pipe(rename({
					dirname: 'js',
          extname: '.js'
        }))
        .pipe(gulp.dest('./dist'));
      });

			es.merge(tasks);
  })
});

gulp.task('build', () => {
	gulp.start('default');

	return gulp
		.src([
			'dist/css/**',
			'dist/js/**',
			'dist/vendor/**',
			'includes/**',
			'templates/**',
			'clanpress.php',
			'index.php'
		], {base: '.'})
		.pipe(zip('clanpress-' + settings.version +  '.zip'))
		.pipe(gulp.dest('./build'));
});

gulp.task('default', () =>  {
  gulp.start('compile:css');
  gulp.start('compile:js');
});
