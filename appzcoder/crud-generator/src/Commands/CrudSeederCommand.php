<?php

namespace Appzcoder\CrudGenerator\Commands;

use Illuminate\Console\GeneratorCommand;

class CrudSeederCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:seeder
                            {name : The name of the controler.}
                            {--model-name= : The name of the Model.}
                            {--section-seeder-snippet= : The namespace of the Seeder.}
                            {--seeder-namespace= : The namespace of the Seeder.}
                            {--model-namespace= : The namespace of the Model.}
                            {--module-name= : Module name for set view path.}
                            {--force : Overwrite already existing controller.}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new resource seeder.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('crudgenerator.custom_template')
        ? config('crudgenerator.path') . '/seeder.stub'
        : __DIR__ . '/../stubs/seeder.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {

        //echo 'Modules\test1' . '\\' . ($this->option('controller-namespace') ? $this->option('controller-namespace') : 'Http\Controllers'); exit;
        //return $rootNamespace . '\\' . ($this->option('controller-namespace') ? $this->option('controller-namespace') : 'Http\Controllers');
        return $rootNamespace . '\\' . ($this->option('seeder-namespace') ? $this->option('seeder-namespace') : 'Http\Controllers');
        //echo $rootNamespace; exit;
        //$rootNamespace = '';
        //return 'Modules\test1' . '\\' . ($this->option('controller-namespace') ? $this->option('controller-namespace') : 'Http\Controllers');
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        if ($this->option('force')) {
            return false;
        }
        return parent::alreadyExists($rawName);
    }

    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($name)
    {

        $stub = $this->files->get($this->getStub());
        $modelName = $this->option('model-name');
        $seederNamespace = $this->option('seeder-namespace');
        $moduleName = $this->option('module-name');
        $modelName = $this->option('model-name');
        $modelNamespace = $this->option('model-namespace');
        $section_seeder_snippet = $this->option('section-seeder-snippet');


        //echo $name; exit;



        $this->replaceSeederNamespace($stub, $seederNamespace)
            ->replaceModelName($stub, $modelName)
            ->replaceModelNamespace($stub, $modelNamespace)
            ->replaceSeederSnippet($stub, $section_seeder_snippet)
            ->replaceClass($stub, $name);


    }


    protected function replaceSeederNamespace(&$stub, $name)
    {
        $stub = str_replace('DummyNamespace', $name, $stub);
        return $this;
    }


    protected function replaceModelName(&$stub, $modelName)
    {
        $stub = str_replace('{{modelName}}', $modelName, $stub);

        return $this;
    }

    protected function replaceModelNamespace(&$stub, $modelNamespace)
    {
        $modelNamespace = str_replace('..\\','' , $modelNamespace);
        $stub = str_replace('{{modelNamespace}}', $modelNamespace, $stub);

        return $this;
    }

    protected function replaceSeederSnippet(&$stub, $snippet)
    {
        $stub = str_replace('{{seeder_schema}}', $snippet, $stub);

        return $this;
    }




}
