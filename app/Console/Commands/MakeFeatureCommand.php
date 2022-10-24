<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeFeatureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'make:feature
    //         {--name= : The name of the feature/resource/entity}
    //         {--all : Make all resource files}';
    protected $signature = 'make:feature {name : The name of the feature/resource/entity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a conjunction of resource files with a basic CRUD.';

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
        $this->createCompleteResourceStructure();
    }

    protected function createServiceResourceStructure()
    {
        // $name = $this->option('name');
        $name = $this->argument('name');

        Artisan::call("make:interface {$name} service");
        Artisan::call("make:service {$name}");
    }

    protected function createRepositoryResourceStructure()
    {
        // $name = $this->option('name');
        $name = $this->argument('name');

        Artisan::call("make:interface {$name} repository");
        Artisan::call("make:repository {$name}");
    }

    protected function createControllerResourceStructure()
    {
        // $name = $this->option('name');
        $name = $this->argument('name');

        Artisan::call("make:rest-api-controller {$name}");
    }

    protected function createFormRequestResourceStructure()
    {
        // $name = $this->option('name');
        $name = $this->argument('name');

        Artisan::call("make:rest-api-request Index {$name}");
        Artisan::call("make:rest-api-request Show {$name}");
        Artisan::call("make:rest-api-request Store {$name}");
        Artisan::call("make:rest-api-request Update {$name}");
        Artisan::call("make:rest-api-request Destroy {$name}");
    }

    protected function createModelAndMigrationResourceStructure()
    {
        // $name = $this->option('name');
        $name = $this->argument('name');

        Artisan::call("make:model {$name} -m");
    }

    protected function createCompleteResourceStructure()
    {
        // $name = $this->option('name');
        $name = $this->argument('name');

        $this->createServiceResourceStructure();
        $this->createRepositoryResourceStructure();
        $this->createControllerResourceStructure();
        $this->createFormRequestResourceStructure();
        $this->createModelAndMigrationResourceStructure();

        $this->info($name . ' resource was created.');
    }
}
