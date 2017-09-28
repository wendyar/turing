gulp          = require 'gulp'
sass          = require 'gulp-sass'
cssmin        = require 'gulp-cssmin'
rename        = require 'gulp-rename'
uglify        = require 'gulp-uglify'
autoprefixer  = require 'gulp-autoprefixer'
# ------------------------------------------------------------------

inSass    = './src/assets/sass/**/*.sass'
outSass   = './build/css/'

inCss     = './build/css/*.css'
outCss    = './assets/css/'

# inJs      = './assets/js/*.js'
# outJs     = './assets/js'


# Compile sass
# ------------------------------------------------------------------
gulp.task 'sass', ->
  console.log 'Compiling Sass...'
  gulp.src(inSass)
      .pipe sass()
      # .pipe autoprefixer({
      #   browsers: ['last 10 versions']
      #   cascade: false
      #   })
      .pipe gulp.dest(outSass)


# Minify CSS files
# ------------------------------------------------------------------
gulp.task 'minifyCss', ->
  console.log 'Minifying CSS files...'
  gulp.src(inCss)
      .pipe cssmin()
      .pipe rename({ suffix: '.min' })
      .pipe gulp.dest(outCss)


# Minify Js files
# ------------------------------------------------------------------
# gulp.task 'minifyJs', ->
#   console.log 'Minifying Js files...'
#   gulp.src(inJs)
#       .pipe uglify()
#       .pipe rename({ suffix: '.min' })
#       .pipe gulp.dest(outJs)


# Watch process
# ------------------------------------------------------------------
gulp.task 'default', ['sass', 'minifyCss'], ->
  gulp.watch(inSass, ['sass'])
  gulp.watch(inCss, ['minifyCss'])
  # gulp.watch(inJs, ['minifyJs'])
