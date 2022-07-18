<?php

namespace Thotam\Bs4AwStarter\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Thotam\Bs4AwStarter\Traits\HelperTrait;
use Symfony\Component\Process\PhpExecutableFinder;

class InstallCommandStep2 extends Command
{
	use InstallsBladeStack;
	use HelperTrait;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'bs4-aw-starters:install-step-2';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install the Bootstrap 4 - Appwork - Starter Kits Step 2 install';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		\Artisan::call('vendor:publish', ['--provider' => "Thotam\LaravelPermission\LaravelPermissionServiceProvider"]);
		\Artisan::call('config:clear');

		$this->info('Bootstrap 4 - Appwork - Starter Kits scaffolding installed successfully step 2.');
		$this->comment('Please execute the "php artisan bs4-aw-starters:install-step-3" to conplete install.');
	}
}
