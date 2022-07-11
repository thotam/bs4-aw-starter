<?php

namespace Thotam\Bs4AwStarter\Traits;

use Illuminate\Support\Str;

trait HelperTrait
{
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
	 * Update Config file.
	 *
	 * @param  string  $search
	 * @param  string  $replace
	 * @param  string  $path
	 * @return void
	 */
	protected function updateConfig($search, $replace, $path)
	{

		$this->replaceInFile($search, $replace, $path);
	}

	/**
	 * Install the route middleware to $routeMiddleware Http Kernel.
	 *
	 * @param  string  $after
	 * @param  string  $name
	 * @return void
	 */
	protected function installRouteMiddlewareAfter($after, $name)
	{
		$httpKernel = file_get_contents(app_path('Http/Kernel.php'));

		$routeMiddleware = Str::before(Str::after($httpKernel, '$routeMiddleware = ['), '];');

		if (!Str::contains($routeMiddleware, $name)) {
			$modifiedRouteMiddleware = str_replace(
				$after . ',',
				$after . ',' . PHP_EOL . '        ' . $name . ',',
				$routeMiddleware,
			);

			file_put_contents(app_path('Http/Kernel.php'), str_replace(
				$routeMiddleware,
				$modifiedRouteMiddleware,
				$httpKernel
			));
		}
	}

	/**
	 * Add github vcs to composer.
	 *
	 * @param  string  $name
	 * @return void
	 */
	protected function addRepositories($name)
	{
		$composers = json_decode(file_get_contents(base_path('composer.json')), true);
		if (array_key_exists("repositories", $composers)) {
			$repositories = $composers['repositories'];
		} else {
			$repositories = [];
		}

		$collect_repositories = collect($repositories)->filter(function ($value, $key) use ($name) {
			return Str::contains($value['url'], $name);
		});

		if ($collect_repositories->count() == 0) {
			$repositories[] = [
				'type' => 'vcs',
				'url' => "git@github.com:" . $name . ".git"
			];
		}

		$composers['repositories'] = $repositories;

		file_put_contents(
			base_path('composer.json'),
			json_encode($composers, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
		);
	}
}
