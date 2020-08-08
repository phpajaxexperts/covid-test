<?php

namespace Appzcoder\CrudGenerator\Commands;

use File;
use Illuminate\Console\Command;

class CrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate
                            {name : The name of the Crud.}
                            {--module-name= : Module name for set view path.}
                            {--section-name= : Section name for set view path.}
                            {--fields= : Field names for the form & migration.}
                            {--fields_from_file= : Fields from a json file.}
                            {--validations= : Validation rules for the fields.}
                            {--controller-namespace= : Namespace of the controller.}
                            {--section-seeder-snippet= : section seeder snippet "app" dir.}
                            {--model-namespace= : Namespace of the model inside "app" dir.}
                            {--seeder-namespace= : Namespace of the seeder inside "app" dir.}
                            {--table= : Name of the database table.}
                            {--front-end-needed= : Front end controller and view needed or not.}
                            {--pk=ID : The name of the primary key.}
                            {--pagination=25 : The amount of models per page for index pages.}
                            {--indexes= : The fields to add an index to.}
                            {--foreign-keys= : The foreign keys for the table.}
                            {--relationships= : The relationships for the model.}
                            {--route=yes : Include Crud route to routes.php? yes|no.}
                            {--route-group= : Prefix of the route group.}
                            {--view-path= : The name of the view path.}
                            {--form-helper=html : Helper for generating the form.}
                            {--localize=no : Allow to localize? yes|no.}
                            {--locales=en : Locales language type.}
                            {--soft-deletes=no : Include soft deletes fields.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Crud including controller, model, views & migrations.';

    /** @var string  */
    protected $routeName = '';

    /** @var string  */
    protected $controller = '';

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
        $name = $this->argument('name');
        $viewUrlName = str_singular(strtolower(str_replace(' ','-',$this->argument('name'))));
        $modelNameSmall = strtolower(str_singular($name));
        $modelName = str_singular($name);
        $migrationName = str_plural(snake_case($name));
        $tableName = $this->option('table');

        $routeGroup = $this->option('route-group');
        $this->routeName = ($routeGroup) ? $routeGroup . '/' . snake_case($name, '-') : snake_case($name, '-');
        $perPage = intval($this->option('pagination'));

        $controllerNamespace = ($this->option('controller-namespace')) ? $this->option('controller-namespace') . '\\' : '';
        $modelNamespace = ($this->option('model-namespace')) ? trim($this->option('model-namespace')) . '\\' : '';
        $moduleName = ($this->option('module-name')) ? trim($this->option('module-name'))  : '';
        $sectionName = ($this->option('section-name')) ? trim($this->option('section-name'))  : '';

        $section_seeder_snippet = ($this->option('section-seeder-snippet')) ? trim($this->option('section-seeder-snippet'))  : '';

        $fields = rtrim($this->option('fields'), ';');

        if ($this->option('fields_from_file')) {
            $fields = $this->processJSONFields($this->option('fields_from_file'));
        }

        $primaryKey = $this->option('pk');
        $viewPath = $this->option('view-path');
        $front_end_needed = $this->option('front-end-needed');

        $foreignKeys = $this->option('foreign-keys');

        if ($this->option('fields_from_file')) {
            $foreignKeys = $this->processJSONForeignKeys($this->option('fields_from_file'));
        }

        $validations = trim($this->option('validations'));
        if ($this->option('fields_from_file')) {
            $validations = $this->processJSONValidations($this->option('fields_from_file'));
        }

        $fieldsArray = explode(';', $fields);
        $fillableArray = [];
        $migrationFields = '';

        //echo "<pre>"; print_r($fieldsArray); exit;
        foreach ($fieldsArray as $item) {
            $spareParts = explode('#', trim($item));
            $fillableArray[] = $spareParts[0];
            $modifier = !empty($spareParts[2]) ? $spareParts[2] : 'nullable';
            $db_option = !empty($spareParts[3]) ? $spareParts[3] : 'nullable';

            // Process migration fields
            $migrationFields .= $spareParts[0] . '#' . $spareParts[1];
            $migrationFields .= '#' . $modifier;
            $migrationFields .= ';';
        }

        $commaSeparetedString = implode("', '", $fillableArray);
        $fillable = "['" . $commaSeparetedString . "']";

        $localize = $this->option('localize');
        $locales = $this->option('locales');

        $indexes = $this->option('indexes');
        $relationships = $this->option('relationships');
        if ($this->option('fields_from_file')) {
            $relationships = $this->processJSONRelationships($this->option('fields_from_file'));
        }

        $formHelper = $this->option('form-helper');
        $softDeletes = $this->option('soft-deletes');

        $this->call('crud:controller', ['name' => $controllerNamespace .'Backend\\'. str_replace(' ','',$name) . 'Controller', '--module-name' => $moduleName,  '--crud-name' => str_replace(' ','',$name), '--model-name' => str_replace(' ','',$modelName), '--model-namespace' => $modelNamespace, '--view-path' => $viewPath, '--route-group' => $routeGroup, '--pagination' => $perPage, '--fields' => $fields, '--validations' => $validations,'--viewUrlName'=>$viewUrlName,]);

        if($front_end_needed=='yes')
        $this->call('crud:frontcontroller', ['name' => $controllerNamespace .'Frontend\\'. str_replace(' ','',$name) . 'Controller', '--module-name' => $moduleName, '--section-name' => $sectionName,  '--crud-name' => str_replace(' ','',$name),  '--model-name' => str_replace(' ','',$modelName), '--model-namespace' => $modelNamespace, '--view-path' => $viewPath, '--route-group' => $routeGroup, '--fields' => $fields, '--pagination' => $perPage,'--viewUrlName'=>$viewUrlName,]);

        $this->call('crud:seeder', ['name' => $migrationName, '--section-seeder-snippet' => $section_seeder_snippet, '--module-name' => $moduleName, '--seeder-namespace' => $modelNamespace,  '--model-name' => str_replace(' ','',$modelName), '--model-namespace' => $modelNamespace]);

        $this->call('crud:model', ['name' => $modelNamespace . str_replace(' ','',$modelName),'--modelname' => $modelName, '--fillable' => $fillable, '--table' => $tableName, '--pk' => $primaryKey, '--relationships' => $relationships, '--soft-deletes' => $softDeletes]);
        $this->call('crud:migration', ['name' => $migrationName, '--schema' => $migrationFields, '--pk' => $primaryKey, '--indexes' => $indexes, '--foreign-keys' => $foreignKeys, '--soft-deletes' => $softDeletes, '--module-name' => $moduleName]);
        $this->call('crud:view', ['name' => $name, '--fields' => $fields, '--validations' => $validations, '--view-path' => $viewPath.'\\backend', '--route-group' => $routeGroup, '--localize' => $localize, '--pk' => $primaryKey, '--form-helper' => $formHelper,'--viewUrlName'=>$viewUrlName, '--module-name' => $moduleName,]);

        if($front_end_needed=='yes')
        $this->call('crud:frontview', ['name' => $name, '--fields' => $fields, '--validations' => $validations, '--view-path' => $viewPath.'\\frontend', '--route-group' => $routeGroup, '--localize' => $localize, '--pk' => $primaryKey, '--form-helper' => $formHelper,'--viewUrlName'=>$viewUrlName, '--module-name' => $moduleName,]);

        if ($localize == 'yes') {
            $this->call('crud:lang', ['name' => $name, '--fields' => $fields, '--locales' => $locales]);
        }

        $this->call('migrate', ['--path' => '/Modules/'.$moduleName.'/database/migrations', '--force' => true]);

        // For optimizing the class loader
        if (\App::VERSION() < '5.6') {
            $this->callSilent('optimize');
        }

        // Updating the Http/routes.php file

        $routeFile = app_path('Http/routes.php');


        if (\App::VERSION() >= '5.3') {
            $routeFile = base_path('Routes/web.php');
        }

        if (file_exists($routeFile) && (strtolower($this->option('route')) === 'yes')) {
            $this->controller = ($controllerNamespace != '') ? $controllerNamespace . '\\' . $name . 'Controller' : $name . 'Controller';

            $isAdded = File::append($routeFile, "\n" . implode("\n", $this->addRoutes()));

            if ($isAdded) {
                $this->info('Crud/Resource route added to ' . $routeFile);
            } else {
                $this->info('Unable to add the route to ' . $routeFile);
            }
        }
    }

    /**
     * Add routes.
     *
     * @return  array
     */


    protected function addRoutes()
    {
        return ["Route::resource('" . $this->routeName . "', '" . $this->controller . "');"];
    }

    /**
     * Process the JSON Fields.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONFields($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        $fieldsString = '';
        foreach ($fields->fields as $field) {
            //$fieldsString .= $field->name . '#' . $field->type . ';';
            if ($field->type == 'select') {
                if($field->options=='db')
                    $fieldsString .= $field->name . '#' . $field->type . '#options=' . $field->options . '#table=' . $field->table . ';';
                else
                    $fieldsString .= $field->name . '#' . $field->type . '#options=' . json_encode($field->options) . ';';
            } else {
                $fieldsString .= $field->name . '#' . $field->type . ';';
            }
        }

        $fieldsString = rtrim($fieldsString, ';');

        return $fieldsString;
    }

    /**
     * Process the JSON Foreign keys.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONForeignKeys($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        if (! property_exists($fields, 'foreign_keys')) {
            return '';
        }

        $foreignKeysString = '';
        foreach ($fields->foreign_keys as $foreign_key) {
            $foreignKeysString .= $foreign_key->column . '#' . $foreign_key->references . '#' . $foreign_key->on;

            if (property_exists($foreign_key, 'onDelete')) {
                $foreignKeysString .= '#' . $foreign_key->onDelete;
            }

            if (property_exists($foreign_key, 'onUpdate')) {
                $foreignKeysString .= '#' . $foreign_key->onUpdate;
            }

            $foreignKeysString .= ',';
        }

        $foreignKeysString = rtrim($foreignKeysString, ',');

        return $foreignKeysString;
    }

    /**
     * Process the JSON Relationships.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONRelationships($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        if (!property_exists($fields, 'relationships')) {
            return '';
        }

        $relationsString = '';
        foreach ($fields->relationships as $relation) {
            $relationsString .= $relation->name . '#' . $relation->type . '#' . $relation->class . ';';
        }

        $relationsString = rtrim($relationsString, ';');

        return $relationsString;
    }

    /**
     * Process the JSON Validations.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONValidations($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        if (!property_exists($fields, 'validations')) {
            return '';
        }

        $validationsString = '';
        foreach ($fields->validations as $validation) {
            $validationsString .= $validation->field . '#' . $validation->rules . ';';
        }

        $validationsString = rtrim($validationsString, ';');

        return $validationsString;
    }
}
