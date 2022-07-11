<?php

namespace Thotam\Bs4AwStarter\Console;

use Illuminate\Filesystem\Filesystem;

trait InstallsBladeStack
{
	/**
	 * Install the Blade Bootstrap 4 - Appwork - Starter Kits stack.
	 *
	 * @return void
	 */
	protected function installBladeStack()
	{
		$this->updateConfig("'name' => env('APP_NAME', 'Laravel')", "'name' => env('APP_NAME', 'Laravel BS4 AW STARTER KIT')", base_path('config/app.php'));
		$this->updateConfig("'timezone' => 'UTC'", "'timezone' => 'Asia/Ho_Chi_Minh'", base_path('config/app.php'));
		$this->updateConfig("'locale' => 'en'", "'locale' => 'vi'", base_path('config/app.php'));
		$this->updateConfig("'faker_locale' => 'en_US'", "'faker_locale' => 'vi_VN'", base_path('config/app.php'));

		$this->updateNodeBrowserslist();

		// NPM Packages...
		$this->updateNodePackages(function ($packages) {
			return [
				'cross-env' => '~7.0.3',
				'node-sass' => '~7.0.1',
				'resolve-url-loader' => '~5.0.0',
				'sass-loader' => '~13.0.2',
				'sass' => '^1.53.0',
				'vue-template-compiler' => '^2.6.14',
				'@claviska/jquery-minicolors' => '~2.3.6',
				'@flowjs/flow.js' => '~2.14.1',
				'@fullcalendar/bootstrap' => '~5.11.0',
				'@fullcalendar/core' => '~5.11.0',
				'@fullcalendar/daygrid' => '~5.11.0',
				'@fullcalendar/interaction' => '~5.11.0',
				'@fullcalendar/list' => '~5.11.0',
				'@fullcalendar/timegrid' => '~5.11.0',
				'@fullcalendar/timeline' => '~5.11.0',
				'add' => '^2.0.6',
				'animate.css' => '~4.1.1',
				'autosize' => '~5.0.1',
				'block-ui' => '~2.70.1',
				'blueimp-gallery' => '~3.4.0',
				'bootbox' => '~5.5.3',
				'bootstrap' => '~4.6.1',
				'bootstrap-datepicker' => '~1.9.0',
				'bootstrap-daterangepicker' => '~3.1.0',
				'bootstrap-duallistbox' => '~3.0.9',
				'bootstrap-markdown' => '~2.10.0',
				'bootstrap-material-datetimepicker' => '~2.7.3',
				'bootstrap-maxlength' => '~1.10.1',
				'bootstrap-menu' => '~1.0.14',
				'bootstrap-select' => '~1.13.18',
				'bootstrap-slider' => '~11.0.2',
				'bootstrap-table' => '~1.20.0',
				'bootstrap-tagsinput' => '~0.7.1',
				'c3' => '~0.7.20',
				'chart.js' => '~2.9.4',
				'chartist' => '~0.11.4',
				'clipboard' => '~2.0.11',
				'core-js' => '~3.23.3',
				'cropper' => '~4.1.0',
				'custom-event-polyfill' => '1.0.7',
				'datatables.net' => '~1.12.1',
				'datatables.net-bs4' => '~1.12.1',
				'datatables.net-buttons' => '~2.2.3',
				'datatables.net-buttons-bs4' => '~2.2.3',
				'dragula' => '~3.7.3',
				'dropzone' => '~5.9.3',
				'flatpickr' => '~4.6.13',
				'flot' => '~4.2.2',
				'gmaps' => '~0.4.25',
				'jquery' => '~3.6.0',
				'jquery-knob' => '~1.2.11',
				'jquery-mapael' => '~2.2.0',
				'jquery-sparkline' => '~2.4.0',
				'jquery-validation' => '~1.19.4',
				'jquery.growl' => '~1.3.5',
				'jstree' => '~3.3.12',
				'jszip' => '^3.6.0',
				'ladda' => '~2.0.3',
				'markdown' => '~0.5.0',
				'masonry-layout' => '~4.2.2',
				'moment' => '~2.29.3',
				'morris.js' => '~0.5.0',
				'nestable' => '~0.2.0',
				'node-waves' => '~0.7.6',
				'nouislider' => '~14.7.0',
				'numeral' => '~2.0.6',
				'pace-js' => '~1.2.4',
				'pdfmake' => '^0.1.70',
				'perfect-scrollbar' => '~1.5.5',
				'photoswipe' => '~4.1.3',
				'plyr' => '3.6.8',
				'popper.js' => '~1.16.1',
				'pwstrength-bootstrap' => '~3.1.1',
				'quill' => '~1.3.7',
				'raphael' => '~2.3.0',
				'select2' => '~4.1.0-rc.0',
				'shepherd.js' => '~10.0.0',
				'smartwizard' => '~6.0.1',
				'sortablejs' => '~1.15.0',
				'spinkit' => '~2.0.1',
				'sweetalert2' => '~10.16.8',
				'swiper' => '~8.2.5',
				'tableexport.jquery.plugin' => '~1.26.0',
				'text-mask-addons' => '~3.8.0',
				'timepicker' => '~1.13.18',
				'toastr' => '~2.1.4',
				'typeahead.js' => '~0.11.1',
				'url-polyfill' => '~1.1.12',
				'vanilla-text-mask' => '~5.1.1',
			] + $packages;
		});

		// requireComposerPackages
		$this->requireComposerPackages('yajra/laravel-datatables:^1.5', 'livewire/livewire:^2.10');

		\Artisan::call("vendor:publish --tag=datatables-buttons");

		// Controllers...
		copy(__DIR__ . '/../../stubs/App/Http/Controllers/HomeController.php', app_path('Http/Controllers/HomeController.php'));
		copy(__DIR__ . '/../../stubs/App/Http/Controllers/Page2Controller.php', app_path('Http/Controllers/Page2Controller.php'));

		// Middlewares...
		(new Filesystem)->ensureDirectoryExists(app_path('Http/Middleware'));
		(new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/App/Http/Middleware', app_path('Http/Middleware'));

		// Views...
		(new Filesystem)->ensureDirectoryExists(resource_path('views'));
		(new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views', resource_path('views'));

		// Languages...
		(new Filesystem)->ensureDirectoryExists(base_path('lang'));
		(new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/lang', base_path('lang'));

		// Tests...
		$this->installTests();

		// Routes...
		copy(__DIR__ . '/../../stubs/routes/web.php', base_path('routes/web.php'));

		// Assets ...
		(new Filesystem)->deleteDirectory(resource_path('js'));
		(new Filesystem)->deleteDirectory(resource_path('css'));
		(new Filesystem)->ensureDirectoryExists(resource_path('assets'));
		(new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/assets', resource_path('assets'));

		// Webpack...
		copy(__DIR__ . '/../../stubs/webpack.mix.js', base_path('webpack.mix.js'));

		// Middleware...
		// $this->installMiddlewareAfter('VerifyCsrfToken::class', '\App\Http\Middleware\HandleInertiaRequests::class');

		$this->info('Bootstrap 4 - Appwork - Starter Kits scaffolding installed successfully.');
		$this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
	}
}
