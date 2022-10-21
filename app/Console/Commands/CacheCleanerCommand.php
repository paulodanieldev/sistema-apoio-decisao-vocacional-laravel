<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CacheCleanerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean
            {--bootstrap : Clear the bootstrap cache folder}
            {--all : Clear all laravel cache}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans the cache of config, routes, views and autoload.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('bootstrap')) {
            $this->clearBootstrapFolderCache();
        } else {
            $this->clearAllCache();

            $this->info('====================================');
            $this->info('Cache commands was executed.');
            $this->info('Project data was configured.');
        }
    }

    protected function clearAllCache()
    {
        $this->clearBootstrapFolderCache();
        $this->optimizeApplication();
        $this->clearConfigCache();
        $this->clearGeneralCache();
        $this->clearViewCache();
        $this->clearRouteCache();
        $this->clearApplicationLogs();
        $this->updateTheAutoload();
    }

    protected function clearBootstrapFolderCache()
    {
        system('rm -r bootstrap/cache/*');
        $this->info('- bootstrap/cache/ folder was cleaned.');
    }

    protected function optimizeApplication()
    {
        Artisan::call('optimize:clear');
        $this->info('- Optimize clear was executed.');
    }

    protected function clearConfigCache()
    {
        Artisan::call('config:clear');
        $this->info('- Configuration clear was executed.');

        Artisan::call('config:cache');
        $this->info('- Configuration was uncached.');
    }

    protected function clearGeneralCache()
    {
        Artisan::call('cache:clear');
        $this->info('- Configuration cache was cleared');
    }

    protected function clearViewCache()
    {
        Artisan::call('view:clear');
        $this->info('- Configuration view was cleared.');
    }

    protected function clearRouteCache()
    {
        Artisan::call('route:clear');
        $this->info('- Configuration route was cleared.');
    }

    protected function clearApplicationLogs()
    {
        exec('rm ' . storage_path('logs/*.log'));
        $this->info('- Logs folder was cleaned.');
    }

    protected function updateTheAutoload()
    {
        $this->info('====================================');
        $this->info('Executing dump-autoload...');

        system('composer dump-autoload');
        $this->info('- Dump autoload was composed.');
    }
}
