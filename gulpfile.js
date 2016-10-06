var gulp = require('gulp'),
    less = require("gulp-less");

// task
gulp.task('less', function () {
    gulp.src(['./less/style.less']) // path to your file
    .pipe(less())
    .pipe(gulp.dest('./htdocs/css'));
});

gulp.task('watch', function () {
    gulp.watch(['./less/**/*.less'], ['less']);
});
