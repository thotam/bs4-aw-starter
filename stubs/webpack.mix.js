const { EnvironmentPlugin } = require("webpack");
const mix = require("laravel-mix");
const glob = require("glob");
const path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix config
 |--------------------------------------------------------------------------
 */

mix.options({
	resourceRoot: process.env.ASSET_URL || undefined,
	postCss: [require("autoprefixer")],
});

/*
 |--------------------------------------------------------------------------
 | Configure Webpack
 |--------------------------------------------------------------------------
 */

mix.webpackConfig({
	output: {
		publicPath: process.env.ASSET_URL || undefined,
		libraryTarget: "window",
	},
	plugins: [
		new EnvironmentPlugin({
			// Application's public url
			BASE_URL: process.env.ASSET_URL ? `${process.env.ASSET_URL}/` : "/",
		}),
	],
	module: {
		rules: [
			{
				test: /\.js$/,
				include: [
					path.join(__dirname, "node_modules/bootstrap/"),
					path.join(__dirname, "node_modules/bootstrap-slider/"),
					path.join(__dirname, "node_modules/popper.js/"),
					path.join(__dirname, "node_modules/bootstrap-table/"),
					path.join(__dirname, "node_modules/shepherd.js/"),
					path.join(__dirname, "node_modules/flot/"),
					path.join(__dirname, "node_modules/plyr/"),
					path.join(__dirname, "node_modules/rangetouch/"),
				],
				loader: "babel-loader",
				options: {
					presets: [
						[
							"@babel/preset-env",
							{ targets: "last 2 versions, ie >= 10" },
						],
					],
					plugins: [
						"@babel/plugin-transform-destructuring",
						"@babel/plugin-proposal-object-rest-spread",
						"@babel/plugin-transform-template-literals",
					],
					babelrc: false,
				},
			},
		],
	},
	externals: {
		jquery: "jQuery",
		moment: "moment",
		"datatables.net": "$.fn.dataTable",
		"spin.js": "Spinner",
		jsdom: "jsdom",
		d3: "d3",
		eve: "eve",
		velocity: "Velocity",
		hammer: "Hammer",
		raphael: "Raphael",
		"jquery-mapael": "Mapael",
		pace: '"pace-progress"',
		"popper.js": "Popper",
		"jquery-validation": "jQuery",

		// blueimp-file-upload plugin
		"canvas-to-blob": "blueimpDataURLtoBlob",
		"blueimp-tmpl": "blueimpTmpl",
		"load-image": "blueimpLoadImage",
		"load-image-meta": "null",
		"load-image-scale": "null",
		"load-image-exif": "null",
		"jquery-ui/ui/widget": "null",
		"./jquery.fileupload": "null",
		"./jquery.fileupload-process": "null",
		"./jquery.fileupload-image": "null",
		"./jquery.fileupload-video": "null",
		"./jquery.fileupload-validate": "null",

		// blueimp-gallery plugin
		"./blueimp-helper": "jQuery",
		"./blueimp-gallery": "blueimpGallery",
		"./blueimp-gallery-video": "blueimpGallery",
	},
});

/*
 |--------------------------------------------------------------------------
 | Vendor assets
 |--------------------------------------------------------------------------
 */

function mixAssetsDir(query, cb) {
	(glob.sync("resources/assets/" + query) || []).forEach((f) => {
		f = f.replace(/[\\\/]+/g, "/");
		cb(f, f.replace("resources/assets", "public"));
	});
}

const sassOptions = {
	implementation: require("node-sass"),
};

// Core stylesheets
mix.sass(
	"resources/assets/vendor/sass/rtl/bootstrap-material.scss",
	"public/vendor/css",
	sassOptions
)
	.sass(
		"resources/assets/vendor/sass/rtl/appwork-material.scss",
		"public/vendor/css",
		sassOptions
	)
	.sass(
		"resources/assets/vendor/sass/rtl/theme-soft-material.scss",
		"public/vendor/css",
		sassOptions
	)
	.sass(
		"resources/assets/vendor/sass/rtl/colors-material.scss",
		"public/vendor/css",
		sassOptions
	)
	.sass(
		"resources/assets/vendor/sass/rtl/uikit.scss",
		"public/vendor/css",
		sassOptions
	);

// Core javascripts
mixAssetsDir("vendor/js/**/*.js", (src, dest) => mix.js(src, dest));

// Libs
mixAssetsDir("vendor/libs/**/*.js", (src, dest) => mix.js(src, dest));
mixAssetsDir("vendor/libs/**/!(_)*.scss", (src, dest) =>
	mix.sass(src, dest.replace(/\.scss$/, ".css"), sassOptions)
);

// Pages
mixAssetsDir("vendor/sass/pages/**/!(_)*.scss", (src, dest) =>
	mix.sass(
		src,
		dest
			.replace(/(\\|\/)sass(\\|\/)/, "$1css$2")
			.replace(/\.scss$/, ".css"),
		sassOptions
	)
);

// Fonts
mixAssetsDir("vendor/fonts/**/*.css", (src, dest) => mix.copy(src, dest));
mixAssetsDir("vendor/fonts/**/*", (src, dest) => mix.copy(src, dest));

/*
 |--------------------------------------------------------------------------
 | ThoTam assets
 |--------------------------------------------------------------------------
 */
mixAssetsDir("audio", (src, dest) => mix.copyDirectory(src, dest));
mixAssetsDir("img", (src, dest) => mix.copyDirectory(src, dest));
mixAssetsDir("json", (src, dest) => mix.copyDirectory(src, dest));
mixAssetsDir("video", (src, dest) => mix.copyDirectory(src, dest));
mixAssetsDir("favicon", (src, dest) => mix.copyDirectory(src, dest));
mixAssetsDir("favicon.ico", (src, dest) => mix.copy(src, dest));
mixAssetsDir("css/**/*.css", (src, dest) => mix.copy(src, dest));

/*
 |--------------------------------------------------------------------------
 | Application assets
 |--------------------------------------------------------------------------
 */

mix.js("resources/assets/js/application.js", "public/js").sass(
	"resources/assets/sass/application.scss",
	"public/css"
);

mix.version();
