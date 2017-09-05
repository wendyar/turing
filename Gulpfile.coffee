gulp          = require 'gulp'
sass          = require 'gulp-sass'
coffee        = require 'gulp-coffee'
cssmin        = require 'gulp-cssmin'
rename        = require 'gulp-rename'
uglify        = require 'gulp-uglify'
autoprefixer  = require 'gulp-autoprefixer'
# ------------------------------------------------------------------

inCoffee  = './src/assets/coffee/**/*.coffee'
outCoffee = './app/assets/js/'

inSass    = './src/assets/sass/**/*.sass'
outSass   = './app/assets/css/'

inCss     = './app/assets/css/*.css'
outCss    = './app/assets/css/'

inJs      = './app/assets/js/*.js'
outJs     = './app/assets/js'


# Compile Coffee
# ------------------------------------------------------------------
gulp.task 'coffee', ->
  console.log 'Compiling coffee...'
  gulp.src(inCoffee)
      .pipe coffee()
      .pipe rename({ suffix: '.min' })
      .pipe gulp.dest(outJs)
      # .pipe gulp.dest(outCoffee)


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
gulp.task 'minifyJs', ->
  console.log 'Minifying Js files...'
  gulp.src(inJs)
      .pipe uglify()
      .pipe rename({ suffix: '.min' })
      .pipe gulp.dest(outJs)


# Watch process
# ------------------------------------------------------------------
gulp.task 'default', ['coffee', 'sass', 'minifyCss'], ->
  gulp.watch(inCoffee, ['coffee'])
  gulp.watch(inSass, ['sass'])
  gulp.watch(inCss, ['minifyCss'])
  # gulp.watch(inJs, ['minifyJs'])
