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
		\Artisan::call("laravel-auth:install");
		\Artisan::call("laravel-hr:install");
		\Artisan::call("vendor:publish", ["--tag" => ["datatables-buttons"]]);
		\Artisan::call("thotam-laravel-datatables-filter:install");
		\Artisan::call("laravel-team:install");
		\Artisan::call("laravel-permission:install");
		\Artisan::call("laravel-plus:install");

		$this->info('Bootstrap 4 - Appwork - Starter Kits scaffolding installed successfully.');
		$this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
	}
}
