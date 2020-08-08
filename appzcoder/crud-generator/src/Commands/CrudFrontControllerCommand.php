<?php

namespace Appzcoder\CrudGenerator\Commands;

use Illuminate\Console\GeneratorCommand;

class CrudFrontControllerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:frontcontroller
                            {name : The name of the controler.}
                            {--module-name= : Module name for set view path.}
                            {--section-name= : Section name for set config path.}
                            {--crud-name= : The name of the Crud.}
                            {--model-name= : The name of the Model.}
                            {--model-namespace= : The namespace of the Model.}
                            {--controller-namespace= : Namespace of the controller.}
                            {--view-path= : The name of the view path.}
                            {--fields= : Field names for the form & migration.}
                            {--route-group= : Prefix of the route group.}
                            {--pagination=25 : The a    mount of models per page for index pages.}
                            {--viewUrlName= : view URL Name.}
                            {--force : Overwrite already existing controller.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new resource controller.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        //echo config('crudgenerator.custom_template'); exit;
        return config('crudgenerator.custom_template')
        ? config('crudgenerator.path') . '/front-controller.stub'
        : __DIR__ . '/../stubs/front-controller.stub';
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
        return $rootNamespace . '\\' . ($this->option('controller-namespace') ? $this->option('controller-namespace') : 'Http\Controllers');
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
        $viewPath = $this->option('view-path') ? $this->option('view-path') . '.' : '';
        $crudName = strtolower($this->option('crud-name'));
        //echo $crudName = strtolower($name); exit;
        $crudNameSingular = str_singular($crudName);
        $modelName = $this->option('model-name');
        $modelNamespace = $this->option('model-namespace');
        $moduleName = $this->option('module-name');
        $sectionName = $this->option('section-name');
        $routeGroup = ($this->option('route-group')) ? $this->option('route-group') . '/' : '';
        $routePrefix = ($this->option('route-group')) ? $this->option('route-group') : '';
        $routePrefixCap = ucfirst($routePrefix);
        $perPage = intval($this->option('pagination'));
        $viewName = snake_case($crudName, '-');
        $fields = $this->option('fields');
        //$validations = rtrim($this->option('validations'), ';');
        //$validationRules = '';
        $viewUrlName = $this->option('viewUrlName');
        //echo "<pre>"; print_r($this->option()); exit;
        //echo $name; exit;

        $fieldsArray = explode(';', $fields);
        $whereSnippet = '';

        if ($fields) {
        $x = 0;
        foreach ($fieldsArray as $index => $item) {
            $itemArray = explode('#', $item);

            $fieldName = trim($itemArray[0]);

            $whereSnippet .= ($index == 0) ? "where('$fieldName', 'LIKE', \"%\$keyword%\")" . "\n                " : "->orWhere('$fieldName', 'LIKE', \"%\$keyword%\")" . "\n                ";
        }

        $whereSnippet .= "->";
    }


        return $this->replaceControllerNamespace($stub, $name)
            ->replaceNamespace($stub, $name)
            ->replaceViewModulePath($stub, $moduleName)
            ->replaceModuleName($stub, $moduleName)
            ->replaceConfigSectionPath($stub, $sectionName)
            //->replaceViewPath($stub, $viewPath)
            ->replaceViewName($stub, $viewName)
            ->replaceViewUrlName($stub, $viewUrlName)
            ->replaceCrudName($stub, $crudName)
            ->replaceCrudNameSingular($stub, $crudNameSingular)
            ->replaceModelName($stub, $modelName)
            ->replaceModelNamespace($stub, $modelNamespace)
            ->replaceModelNamespaceSegments($stub, $modelNamespace)
            ->replaceRouteGroup($stub, $routeGroup)
            ->replaceRoutePrefix($stub, $routePrefix)
            ->replaceRoutePrefixCap($stub, $routePrefixCap)
            ->replacePaginationNumber($stub, $perPage)
            ->replaceWhereSnippet($stub, $whereSnippet)
            ->replaceClass($stub, $name);
    }


    protected function replaceControllerNamespace(&$stub, $name)
    {
        $name = str_replace('App\Http\Controllers\..\..\..\\','' , $name);
        //$name = str_replace('\\'.$this->option('crud-name').'Controller','' , $name);
        //$name = str_replace('\\'.$name.'Controller','' , $name);
        $name = str_replace('\\'.$this->option('crud-name').'Controller','' , $name);
        $stub = str_replace('DummyNamespace', $name, $stub);
        return $this;
    }

    protected function replaceViewUrlName(&$stub, $viewUrlName)
    {
        $stub = str_replace('{{viewUrlName}}', str_singular($viewUrlName), $stub);

        return $this;
    }

    /**
     * Replace the viewName fo the given stub.
     *
     * @param string $stub
     * @param string $viewName
     *
     * @return $this
     */
    protected function replaceViewName(&$stub, $viewName)
    {
        $stub = str_replace('{{viewName}}', str_singular($viewName), $stub);

        return $this;
    }

    /**
     * Replace the viewPath for the given stub.
     *
     * @param  string  $stub
     * @param  string  $viewPath
     *
     * @return $this
     */
    protected function replaceViewModulePath(&$stub, $viewPath)
    {
        $stub = str_replace('{{viewModulePath}}', strtolower($viewPath).'::', $stub);

        return $this;
    }

    protected function replaceModuleName(&$stub, $viewPath)
    {
        $stub = str_replace('{{moduleName}}', strtolower($viewPath), $stub);

        return $this;
    }


    protected function replaceConfigSectionPath(&$stub, $section)
    {
        $stub = str_replace('{{sectionName}}', strtolower($section), $stub);

        return $this;
    }


    protected function replaceViewPath(&$stub, $viewPath)
    {
        $stub = str_replace('{{viewPath}}', $viewPath, $stub);

        return $this;
    }

    /**
     * Replace the crudName for the given stub.
     *
     * @param  string  $stub
     * @param  string  $crudName
     *
     * @return $this
     */
    protected function replaceCrudName(&$stub, $crudName)
    {
        $stub = str_replace('{{crudName}}', $crudName, $stub);

        return $this;
    }

    /**
     * Replace the crudNameSingular for the given stub.
     *
     * @param  string  $stub
     * @param  string  $crudNameSingular
     *
     * @return $this
     */
    protected function replaceCrudNameSingular(&$stub, $crudNameSingular)
    {
        $stub = str_replace('{{crudNameSingular}}', $crudNameSingular, $stub);

        return $this;
    }

    /**
     * Replace the modelName for the given stub.
     *
     * @param  string  $stub
     * @param  string  $modelName
     *
     * @return $this
     */
    protected function replaceModelName(&$stub, $modelName)
    {
        $stub = str_replace('{{modelName}}', $modelName, $stub);

        return $this;
    }

    /**
     * Replace the modelNamespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $modelNamespace
     *
     * @return $this
     */
    protected function replaceModelNamespace(&$stub, $modelNamespace)
    {
        $modelNamespace = str_replace('..\\','' , $modelNamespace);
        $stub = str_replace('{{modelNamespace}}', $modelNamespace, $stub);

        return $this;
    }

    /**
     * Replace the modelNamespace segments for the given stub
     *
     * @param $stub
     * @param $modelNamespace
     *
     * @return $this
     */
    protected function replaceModelNamespaceSegments(&$stub, $modelNamespace)
    {
        $modelSegments = explode('\\', $modelNamespace);
        foreach ($modelSegments as $key => $segment) {
            $stub = str_replace('{{modelNamespace[' . $key . ']}}', $segment, $stub);
        }

        $stub = preg_replace('{{modelNamespace\[\d*\]}}', '', $stub);

        return $this;
    }

    /**
     * Replace the routePrefix for the given stub.
     *
     * @param  string  $stub
     * @param  string  $routePrefix
     *
     * @return $this
     */
    protected function replaceRoutePrefix(&$stub, $routePrefix)
    {
        $stub = str_replace('{{routePrefix}}', $routePrefix, $stub);

        return $this;
    }

    /**
     * Replace the routePrefixCap for the given stub.
     *
     * @param  string  $stub
     * @param  string  $routePrefixCap
     *
     * @return $this
     */
    protected function replaceRoutePrefixCap(&$stub, $routePrefixCap)
    {
        $stub = str_replace('{{routePrefixCap}}', $routePrefixCap, $stub);

        return $this;
    }

    /**
     * Replace the routeGroup for the given stub.
     *
     * @param  string  $stub
     * @param  string  $routeGroup
     *
     * @return $this
     */
    protected function replaceRouteGroup(&$stub, $routeGroup)
    {
        $stub = str_replace('{{routeGroup}}', $routeGroup, $stub);

        return $this;
    }

    /**
     * Replace the validationRules for the given stub.
     *
     * @param  string  $stub
     * @param  string  $validationRules
     *
     * @return $this
     */
    protected function replaceValidationRules(&$stub, $validationRules)
    {
        $stub = str_replace('{{validationRules}}', $validationRules, $stub);

        return $this;
    }

    /**
     * Replace the pagination placeholder for the given stub
     *
     * @param $stub
     * @param $perPage
     *
     * @return $this
     */
    protected function replacePaginationNumber(&$stub, $perPage)
    {
        $stub = str_replace('{{pagination}}', $perPage, $stub);

        return $this;
    }

    /**
     * Replace the file snippet for the given stub
     *
     * @param $stub
     * @param $fileSnippet
     *
     * @return $this
     */
    protected function replaceFileSnippet(&$stub, $fileSnippet)
    {
        $stub = str_replace('{{fileSnippet}}', $fileSnippet, $stub);

        return $this;
    }

    /**
     * Replace the where snippet for the given stub
     *
     * @param $stub
     * @param $whereSnippet
     *
     * @return $this
     */
    protected function replaceWhereSnippet(&$stub, $whereSnippet)
    {
        $stub = str_replace('{{whereSnippet}}', $whereSnippet, $stub);

        return $this;
    }

    protected function replaceForeignKeyGetRecordsSnippet(&$stub, $foreignKeyGetRecords)
    {
        $stub = str_replace('{{foreign_key_records}}', $foreignKeyGetRecords, $stub);

        return $this;
    }

    protected function replaceForeignKeyGetFieldsSnippet(&$stub, $foreignKeyFields)
    {
        $stub = str_replace('{{foreign_key_record_variables}}', ', compact('.$foreignKeyFields.')', $stub);

        return $this;
    }

    protected function replaceForeignKeyGetFieldsSnippetEdit(&$stub, $foreignKeyFields)
    {
        $stub = str_replace('{{foreign_key_record_variables_edit}}', ', '.$foreignKeyFields, $stub);

        return $this;
    }

    protected function replaceForeignKeyTableInitSnippet(&$stub, $foreignKeyTableInit)
    {
        $stub = str_replace('{{foreign_key_table_init}}', $foreignKeyTableInit, $stub);

        return $this;
    }

}
