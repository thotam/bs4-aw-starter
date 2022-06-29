<?php

namespace Thotam\Bs4AwStarter\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpExecutableFinder;

class InstallCommand extends Command
{
	use InstallsBladeStack;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'bs4-aw-starters:install
						    {--pest : Indicate that Pest should be installed }
							{--composer=global : Absolute path to the Composer binary which should be used to install packages}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install the Bootstrap 4 - Appwork - Starter Kits controllers and resources';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		return $this->installBladeStack();
	}

	/**
	 * Install Bootstrap 4 - Appwork - Starter Kits's tests.
	 *
	 * @return void
	 */
	protected function installTests()
	{
		(new Filesystem)->ensureDirectoryExists(base_path('tests/Feature/Auth'));

		if ($this->option('pest')) {
			$this->requireComposerPackages('pestphp/pest:^1.16', 'pestphp/pest-plugin-laravel:^1.1');

			(new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/pest-tests/Feature', base_path('tests/Feature/Auth'));
			(new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/pest-tests/Unit', base_path('tests/Unit'));
			(new Filesystem)->copy(__DIR__ . '/../../stubs/pest-tests/Pest.php', base_path('tests/Pest.php'));
		} else {
			(new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/tests/Feature', base_path('tests/Feature/Auth'));
		}
	}

	/**
	 * Install the middleware to a group in the application Http Kernel.
	 *
	 * @param  string  $after
	 * @param  string  $name
	 * @param  string  $group
	 * @return void
	 */
	protected function installMiddlewareAfter($after, $name, $group = 'web')
	{
		$httpKernel = file_get_contents(app_path('Http/Kernel.php'));

		$middlewareGroups = Str::before(Str::after($httpKernel, '$middlewareGroups = ['), '];');
		$middlewareGroup = Str::before(Str::after($middlewareGroups, "'$group' => ["), '],');

		if (!Str::contains($middlewareGroup, $name)) {
			$modifiedMiddlewareGroup = str_replace(
				$after . ',',
				$after . ',' . PHP_EOL . '            ' . $name . ',',
				$middlewareGroup,
			);

			file_put_contents(app_path('Http/Kernel.php'), str_replace(
				$middlewareGroups,
				str_replace($middlewareGroup, $modifiedMiddlewareGroup, $middlewareGroups),
				$httpKernel
			));
		}
	}

	/**
	 * Installs the given Composer Packages into the application.
	 *
	 * @param  mixed  $packages
	 * @return void
	 */
	protected function requireComposerPackages($packages)
	{
		$composer = $this->option('composer');

		if ($composer !== 'global') {
			$command = ['php', $composer, 'require'];
		}

		$command = array_merge(
			$command ?? ['composer', 'require'],
			is_array($packages) ? $packages : func_get_args()
		);

		(new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
			->setTimeout(null)
			->run(function ($type, $output) {
				$this->output->write($output);
			});
	}

	/**
	 * Update the "package.json" file.
	 *
	 * @param  callable  $callback
	 * @param  bool  $dev
	 * @return void
	 */
	protected static function updateNodePackages(callable $callback, $dev = true)
	{
		if (!file_exists(base_path('package.json'))) {
			return;
		}

		$configurationKey = $dev ? 'devDependencies' : 'dependencies';

		$packages = json_decode(file_get_contents(base_path('package.json')), true);

		$packages[$configurationKey] = $callback(
			array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
			$configurationKey
		);

		ksort($packages[$configurationKey]);

		file_put_contents(
			base_path('package.json'),
			json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
		);
	}

	/**
	 * Delete the "node_modules" directory and remove the associated lock files.
	 *
	 * @return void
	 */
	protected static function flushNodeModules()
	{
		tap(new Filesystem, function ($files) {
			$files->deleteDirectory(base_path('node_modules'));

			$files->delete(base_path('yarn.lock'));
			$files->delete(base_path('package-lock.json'));
		});
	}

	/**
	 * Replace a given string within a given file.
	 *
	 * @param  string  $search
	 * @param  string  $replace
	 * @param  string  $path
	 * @return void
	 */
	protected function replaceInFile($search, $replace, $path)
	{
		file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
	}

	/**
	 * Get the path to the appropriate PHP binary.
	 *
	 * @return string
	 */
	protected function phpBinary()
	{
		return (new PhpExecutableFinder())->find(false) ?: 'php';
	}

	/**
	 * Update the "package.json" browserslist.
	 *
	 * @return void
	 */
	protected static function updateNodeBrowserslist()
	{
		if (!file_exists(base_path('package.json'))) {
			return;
		}

		$packages = json_decode(file_get_contents(base_path('package.json')), true);

		$packages['name'] = "bs4-aw-starters";

		$packages['browserslist'] = [
			">= 1%",
			"last 2 versions",
			"not dead",
			"Chrome >= 45",
			"Firefox >= 38",
			"Edge >= 12",
			"Explorer >= 10",
			"iOS >= 9",
			"Safari >= 9",
			"Android >= 4.4",
			"Opera >= 30"
		];

		$packages['babel'] = [
			"presets" => [
				[
					"@babel/env",
					[
						"targets" => [
							"browsers" => [
								">= 1%",
								"last 2 versions",
								"not dead",
								"Chrome >= 45",
								"Firefox >= 38",
								"Edge >= 12",
								"Explorer >= 10",
								"iOS >= 9",
								"Safari >= 9",
								"Android >= 4.4",
								"Opera >= 30"
							]
						]
					]
				]
			]
		];

		file_put_contents(
			base_path('package.json'),
			json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
		);
	}
}
