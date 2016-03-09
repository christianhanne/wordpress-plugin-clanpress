'use strict';

var gulp = require('gulp');
var gutil = require('gulp-util');

var source = require('vinyl-source-stream');
var rename = require('gulp-rename');
var browserify = require('browserify');
var babel = require('babelify');
var glob = require('glob');
var es = require('event-stream');
var del = require('del');
var uglify = require('gulp-uglify');

var zip = require('gulp-zip');

var shell = require('gulp-shell');
var ftp = require( 'vinyl-ftp' );

var sass = require('gulp-sass');
var minifyCss = require('gulp-minify-css');
var sourcemaps = require('gulp-sourcemaps');

var bower = require('gulp-bower');

var sequence = require('run-sequence');

var settings = require('./package.json');
var credentials = require('./credentials.json');

gulp.task('clean', () => {
	return del(['dist/css', 'dist/js', 'dist/vendor']);
});

gulp.task('compile:css', () => {
  return gulp.src('./components/*/css/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(sourcemaps.write())
    .pipe(rename((path) => {
      path.dirname = path.dirname.replace('/css', '');
    }))
    .pipe(gulp.dest('dist/css'));
});

gulp.task('minify:css', ['compile:css'], () => {
	return gulp.src('./dist/css/*/*.css')
    .pipe(minifyCss())
		.pipe(rename({
			extname: '.min.css'
		}))
    .pipe(gulp.dest('dist/css'));
});

gulp.task('compile:js', (done) => {
	return glob('./components/*/js/*.js', function(error, files) {
    if (error) {
			done(error);
		}

    var tasks = files.map((entry) => {
      return browserify({ entries: [entry] })
			  .transform(babel)
        .bundle()
        .pipe(source(entry))
        .pipe(rename((path) => {
          path.dirname = path.dirname.replace('components/', '');
          path.dirname = path.dirname.replace('/js', '');
        }))
        .pipe(gulp.dest('./dist/js'));
    });

		es.merge(tasks).on('end', done);
  });
});

gulp.task('minify:js', ['bower', 'compile:js'], () => {
	return gulp.src('./dist/js/*/*.js')
    .pipe(uglify())
		.pipe(rename({
			extname: '.min.js'
		}))
    .pipe(gulp.dest('dist/js'));
});

gulp.task('docs:create', shell.task([
  `rm -rf documentation/${settings.version}`,
  `apigen generate --config apigen.yml -d documentation/${settings.version} --title 'Clanpress ${settings.version}'`
]));

gulp.task('docs:publish', ['docs:create'], () => {
  var remoteDir = '/';

  var conn = ftp.create(credentials);

  return gulp.src(`documentation/${settings.version}/**/*`, {
      base: './documentation',
      buffer: false
    })
    .pipe(conn.newer(remoteDir))
    .pipe(conn.dest(remoteDir));
});

gulp.task('bower', () => {
	return bower();
});

gulp.task('build', () => {
	return gulp
		.src([
      'LICENSE',
      'README.md',
      'assets/**',
			'dist/css/**',
			'dist/js/**',
			'dist/vendor/jquery-*/**',
      'components/**',
      'modes/**',
			'includes/**',
			'clanpress.php',
			'index.php'
		], {base: '.'})
		.pipe(zip('clanpress-' + settings.version +  '.zip'))
		.pipe(gulp.dest('./builds'));
})

gulp.task('publish', ['default'], (cb) => {
	sequence(['build'], cb);
});

gulp.task('default', ['clean'], (cb) => {
	sequence(['minify:css', 'minify:js'], cb);
});
