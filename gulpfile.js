const gulp = require('gulp');
const sassCompiler = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();

const paths = {
  sassEntry: './styles/base.sass',
  sassWatch: ['./styles/**/*.sass', './styles/**/*.scss'],
  phpWatch: './**/*.php',
  jsWatch: './js/**/*.js',
  cssWatch: './styles/**/*.css',
  cssDest: './styles',
};

function compileSass() {
  return gulp
    .src(paths.sassEntry)
    .pipe(sassCompiler().on('error', sassCompiler.logError))
    .pipe(gulp.dest(paths.cssDest))
    .pipe(browserSync.stream());
}

function startBrowserSync(done) {
  browserSync.init({
    proxy: 'http://routeware-website-live.local',
    notify: false,
    open: false,
  });
  done();
}

function watchFiles() {
  gulp.watch(paths.sassWatch, compileSass);
  gulp.watch(paths.phpWatch).on('change', browserSync.reload);
  gulp.watch(paths.jsWatch).on('change', browserSync.reload);
  gulp.watch(paths.cssWatch).on('change', browserSync.reload);
}

exports.sass = compileSass;
exports.serve = gulp.series(compileSass, startBrowserSync, watchFiles);
exports.watch = exports.serve;
exports.default = exports.sass;
