<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeInterfaceCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Interface';

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

        return str_replace('Stub', $this->argument('name'), $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stubBasePath = app_path() . "/Console/Commands/Stubs/Interfaces";

        if ($this->argument('folder') === "service")
            $fileName = "service-interface.stub";
        else
            $fileName = "repository-interface.stub";

        return "{$stubBasePath}/{$fileName}";
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->argument('folder') == "service")
            return $rootNamespace . '\Interfaces\Services';
        else
            return $rootNamespace . '\Interfaces\Repositories';
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name')) . "Interface";
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the entity.'],
            ['folder', InputArgument::OPTIONAL, 'The folder of the interface.'],
        ];
    }
}
