<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;
use Auth;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Blade;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    // public function __construct(Router $router)
    // {
    //         $this->router = $router;
    //         $this->routes = $router->getRoutes();
    // }
    
    public function register()
    {
        //
        if ($this->app->environment() == 'local') {
            $this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        //
        Schema::defaultStringLength(191);

        $permission = getModuleBySlug();
        //dd($permission);

        //dd($permission->sectionComponentName);
        
        if(isset($permission->section)){
            $module =  $permission->module;
            $section =  $permission->section;
            view()->share('module', $module);
            view()->share('section', $section);
            view()->share('form_components', $permission->sectionComponentName);
            view()->share('form_component_positions', $permission->sectionComponentPosition);
        }
        //$prefix =  $this->app->request->route()->getPostfix();
        //echo $this->app->request->getRequestUri(); exit;
        //dd($parameters); exit;
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $url_section = request()->segment(2);
            $url_module_id = request()->segment(3);
            $event->menu->add('MAIN NAVIGATION');
            $modules = getModulesForMenu();
            //echo "<pre>"; print_r($modules); exit;
            if(isset($modules)){
                foreach($modules as $module){
                    if(isset($module->permission_name)){
                        if(Auth::guard('administrator')->user()->hasAnyPermission(explode(',',$module->permission_name)) || Auth::guard('administrator')->user()->hasPermissionTo('Super Admin')){
                        //if(Auth::guard('administrator')->user()->hasAnyPermission(explode(',',$module->permission_name))){                            
                            $module_sections = getModuleSectionsForMenu($module->id);
                            $arraySubMenu = [];
                            $active_menu = '';
                            if($module->category==1){
                                if($url_module_id==$module->id){
                                    $active_menu = urlStringConvert($module->name); 
                                }
                                $arraySubMenu[] = array(
                                    'key' => urlStringConvert('category'.$module_section->name),
                                    'text' => 'Category',
                                    'url'  => '/administrator/view-category/'.$module->id,
                                    'icon' => 'far fa fa-long-arrow-right',
                                    'href' => '/administrator/view-category/'.$module->id,
                                    'class' => '',
                                    'active' => $active_menu,
                                );
                                $active_menu = '';
                            }
                            
                        
                            if(count($module_sections)>0){
                                foreach($module_sections as $module_section){
                                    if($url_section == urlStringConvert($module_section->permission_name) && $module->id!=3){
                                        $active_menu = urlStringConvert($module->name); 
                                    }
                                }
                            }
                            
                            if(count($module_sections)>0){
                                foreach($module_sections as $module_section){
                                    if($module_section->permission_display==1){
                                        if(Auth::guard('administrator')->user()->hasAnyPermission($module_section->permission_name) || Auth::guard('administrator')->user()->hasPermissionTo('Super Admin')){
                                        //if(Auth::guard('administrator')->user()->hasAnyPermission($module_section->permission_name)){
                                            $arraySubMenu[] = array(
                                                'key' => urlStringConvert($module_section->permission_name),
                                                'text' => ucfirst($module_section->name),
                                                'url'  => route($module_section->permission_name),
                                                'icon' => 'fa fa-long-arrow-right',
                                                'href' => route($module_section->permission_name),
                                                'class' => '',
                                                'active' => $active_menu,
                                            );
                                        }
                                    }
                                }
                                $event->menu->add([
                                    'key' => urlStringConvert($module->name),
                                    'text' => $module->name,
                                    'icon' => 'fa fa-th',
                                    'href' => '',
                                    'class' => '',
                                    'submenu' => $arraySubMenu,
                                    ]);
                            }else{
                                $event->menu->add([
                                    'key' => urlStringConvert($module->name),
                                    'text' => $module->name,
                                    'href' => '',
                                    'class' => '',
                                    'icon' => 'fa fa-th',
                                    ]);
                            }
                        }
                    }
                }
            }
        });

    }
}
