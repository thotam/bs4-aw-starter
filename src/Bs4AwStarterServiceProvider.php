<?php

namespace Thotam\Bs4AwStarter;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class Bs4AwStarterServiceProvider extends ServiceProvider implements DeferrableProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if (!$this->app->runningInConsole()) {
			return;
		}

		$this->commands([
			Console\InstallCommand::class,
			Console\InstallCommandStep2::class,
			Console\InstallCommandStep3::class,
		]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [Console\InstallCommand::class];
	}
}
