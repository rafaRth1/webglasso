const { src, dest, parallel, watch } = require("gulp");
const sass = require("gulp-sass");
const imagemin = require("gulp-imagemin");
const notify = require("gulp-notify");
const concat = require("gulp-concat");

const paths = {
   js: "src/js/**/*",
   scss: "src/sass/**/*.scss",
   img: "src/img/**/*",
};

function css() {
   return src(paths.scss)
      .pipe(
         sass({
            outputStyle: "expanded",
         })
      )
      .pipe(dest("./dest/css"));
}

function javascript() {
   return src(paths.js).pipe(concat("app.js")).pipe(dest("./dest/js"));
}

function imagenes() {
   return src(paths.img)
      .pipe(imagemin([imagemin.optipng({ optimizationLevel: 3 })]))
      .pipe(dest("dest/img"))
      .pipe(notify({ message: "Imagen Completa" }));
}

function watchFiles() {
   watch(paths.scss, css);
   watch(paths.img, imagenes);
   watch(paths.js, javascript);
}

exports.default = parallel(css, javascript, watchFiles, imagenes);

// SUbir archivos a un servuidor y guardar la referencia, no se guarada el
// archivo completo
