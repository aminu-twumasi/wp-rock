"use strict";

// Questions? Visit our documentation: https://the-ljibrary.fjorgedigital.com/books/technology-standard-gulp

/****************************************
		DEPENDENCIES
*****************************************/
/*
 * This list of dependency variables comes from the package.json file. Ensure any dependency listed here is also added to package.json.
 * These variables are declared here at the top and are used throughout the gulpfile to complete certain tasks and add functionality.
 */
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const gulp = require('gulp');
const concat = require('gulp-concat');
const notify = require("gulp-notify");
const plumber = require("gulp-plumber");
const postcss = require("gulp-postcss");
const rename = require('gulp-rename');
const sass = require('gulp-sass')(require('sass'));
const uglify = require('gulp-uglify');


/****************************************
		SOURCE PATHS
*****************************************/
/**
 * The 'config' object defines where all the assets are found.
 * Changing the values of this object will change where all the tasks below look for files
 */

// Common defaults
const path_src = './assets/src/';
const path_dist = './assets/dist/';

// Pathing config
const config = {
	theme: {
		name: 'theme', // if you change this value, update your file enqueue's too. This is a prefix for all file names (usage example: config.theme.name)
	},
	css: {
		sass: path_src + 'sass/style.scss',
		sass_comps: path_src + 'sass/**/*.scss', // to watch; imported into config.css.sass for build
		sass_blocks_comps: './template-parts/**/*.scss', // to watch; imported into config.css.sass_blocks, which gets imported into config.css.sass for build
		dist: path_dist + 'css/',
	},
	js: {
		src: [
			path_src + 'js/**/*.js', // Wildcard - Used as a catch-all. This will add all .js files located within assets/src/js/ to be compiled.
			// path_src + 'js/main.js', // Manual - FOR DEPENDENCIES - if you want to control your enqueue order, manually add each file in the order you'd like
		],
		src_blocks: [
			'./template-parts/blocks/**/*.js', // Wildcard - Used as a catch-all. This will add all .js files located within assets/src/js/ to be compiled.
			// './template-parts/blocks/custom-content/custom-content.js', // Manual - FOR DEPENDENCIES - if you want to control your enqueue order, manually add each file in the order you'd like
		],
		dist: path_dist + 'js/',
	}
};



/****************************************
		STANDARD TASKS
*****************************************/

/**
 * COMPILE GLOBAL SASS :: UN-MINIFIED & MINIFIED
 */
function styles() {
	// Define plugins for "PostCSS"
	var plugins_expanded = [
		autoprefixer()
	];
	var plugins_min = [
		cssnano()
	];

	// Run SASS Task
	return gulp.src(config.css.sass, {sourcemaps: true})
		.pipe(plumber({
			errorHandler: () => {
				notify.onError("SASS Error: <%= error.message %>");
				process.nextTick(() => process.exit(1));
			} // on error, send push and exit
		}))
		.pipe(sass().on('error', sass.logError))
		.pipe(postcss(plugins_expanded))
		.pipe(rename(config.theme.name + '-custom.css'))
		.pipe(gulp.dest(config.css.dist)) // DIST un-minified file

		// minify for production
		.pipe(postcss(plugins_min)) // minify
		.pipe(rename(config.theme.name + '-custom.min.css')) // rename with .min
		.pipe(gulp.dest(config.css.dist, {sourcemaps: true})); // DIST minified version
}


/**
 * COMPILE CUSTOM JS :: UN-MINIFIED & MINIFIED
 */
function scripts_global() {
	return gulp.src(config.js.src, {sourcemaps: true})
		.pipe(plumber({
			errorHandler: () => {
				notify.onError("JS Global Error: <%= error.message %>");
				process.nextTick(() => process.exit(1));
			} // on error, send push and exit
		}))
		.pipe(concat(config.theme.name + '-custom.js')) // group files together
		.pipe(gulp.dest(config.js.dist)) // DIST un-minified file

		// minify for production
		.pipe(rename(config.theme.name + '-custom.min.js')) // rename with .min
		.pipe(uglify()) // minify
		.pipe(gulp.dest(config.js.dist, {sourcemaps: true})); // DIST minified version
};


/**
 * COMPILE CUSTOM BLOCKS JS :: UN-MINIFIED & MINIFIED
 */
function scripts_blocks() {
	return gulp.src(config.js.src_blocks, {sourcemaps: true})
		.pipe(plumber({
			errorHandler: () => {
				notify.onError("JS Blocks Error: <%= error.message %>");
				process.nextTick(() => process.exit(1));
			} // on error, send push and exit
		}))
		.pipe(concat(config.theme.name + '-custom-blocks.js')) // group files together
		.pipe(gulp.dest(config.js.dist)) // DIST un-minified file

		// minify for production
		.pipe(rename(config.theme.name + '-custom-blocks.min.js')) // rename with .min
		.pipe(uglify()) // minify
		.pipe(gulp.dest(config.js.dist, {sourcemaps: true})); // DIST minified version
};


/****************************************
		ACTIONS
*****************************************/

// BUILD TASK - COMPILES SCSS, CSS & JS, but does NOT watch for file changes
const build = gulp.series([styles, scripts_global, scripts_blocks]);

// WATCH AND LOG SOURCE FILE CHANGES
function watch() {
	// WATCH SCSS
	gulp.watch([config.css.sass_comps, config.css.sass_blocks_comps], styles)
		.on('change', (path) => {
			console.log(`File ${path} was updated, running tasks...`);
		});

	// WATCH JS
	gulp.watch(config.js.src, scripts_global)
		.on('change', (path) => {
			console.log(`File ${path} was updated, running tasks...`);
		});
	gulp.watch(config.js.src_blocks, scripts_blocks)
		.on('change', (path) => {
			console.log(`File ${path} was updated, running tasks...`);
		});
}


// DEFAULT GULP TASK
const start = gulp.series([build, watch]);


/****************************************
		EXPORTS
*****************************************/
// Dev
exports.styles = styles;
exports.scripts_global = scripts_global;
exports.scripts_blocks = scripts_blocks;
exports.build = build;
exports.watch = watch;
exports.default = start;
