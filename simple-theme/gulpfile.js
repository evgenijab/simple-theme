// Polyfill for globalThis in older Node.js versions (like v10.x)
if (typeof globalThis === 'undefined') {
	Object.defineProperty(Object.prototype, '__globalThis__', {
	  get: function() {
		return this;
	  },
	  configurable: true
	});
	__globalThis__.globalThis = __globalThis__;
	delete Object.prototype.__globalThis__;
  }

  
  require('es6-promise').polyfill(); // Polyfill for promises in older environments

	var gulp = require('gulp'); // Import Gulp
	var sass = require('gulp-sass')(require('sass'));
	gulp.task('sass', function() {
		gulp.src('./sass/**/*.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./'));
	});
	gulp.task('default', gulp.series('sass'));