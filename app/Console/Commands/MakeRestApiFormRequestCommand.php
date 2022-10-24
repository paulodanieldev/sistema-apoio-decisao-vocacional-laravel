<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeRestApiFormRequestCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:rest-api-request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new REST API form request';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'FormRequest';

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace('Stub', $this->argument('folder'), $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stubBasePath = app_path() . "/Console/Commands/Stubs/Requests";

        switch ($this->argument('name')) {
            case 'Index':
                return  "{$stubBasePath}/index.stub";
                break;

            case 'Show':
                return  "{$stubBasePath}/show.stub";
                break;

            case 'Store':
                return  "{$stubBasePath}/store.stub";
                break;

            case 'Update':
                return  "{$stubBasePath}/update.stub";
                break;

            case 'Destroy':
                return  "{$stubBasePath}/destroy.stub";
                break;

            default:
                return  "{$stubBasePath}/index.stub";
                break;
        }
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $folder = $this->argument('folder');

        return "{$rootNamespace}/Http/Requests/{$folder}";
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name')) . "Request";
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the form request.'],
            ['folder', InputArgument::OPTIONAL, 'The folder of the form request.'],
        ];
    }
}
