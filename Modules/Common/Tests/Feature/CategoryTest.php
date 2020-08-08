<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Administrator\Entities\Administrator;
use Modules\Common\Entities\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Session;

class CategoryTest extends TestCase
{
    //use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    // public function init()
    // {
    //     $this->loginWithFakeUser();
    // }

    
    public function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        $this->loginWithFakeUser();
        Session::start();
        // now re-register all the roles and permissions
        //$this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    public function testViewCategory()
    {
        //$user = factory(Administrator::class)->create();
        // $response = $this->actingAs($user, 'administrator')
        //             ->get('/administrator/view-category');

        //$this->loginWithFakeUser();
        $response = $this->get('/administrator/view-category');
        $response->assertStatus(200);
    }


    public function testaddCategory()
    {
        //$this->loginWithFakeUser();
        $response = $this->get('/administrator/create-category/1/0');
        $response->assertStatus(200);
    }

    public function testStoreCategory(){
        $data = [
            'name' => "New Category",
            'description' => "This is a category",
            'parent' => 0,
            'section' => 1,
            '_token' => csrf_token()
        ];
        //$response = $this->post('/administrator/store-category',$data,['_token' => csrf_token()]);
        $response = $this->call('POST','/administrator/store-category',$data);
        $response->assertStatus(302); // Redirection
    }

    public function testeditCategory()
    {
        //$this->loginWithFakeUser();
        $response = $this->get('/administrator/edit-category/1');
        $response->assertStatus(200);
    }

    public function testUpdateCategory(){
        $data = [
            'name' => "Test New Category",
            'description' => "This is a category",
            '_token' => csrf_token()
        ];
        $category = factory(Category::class)->create();

        //$response = $this->post('/administrator/store-category',$data,['_token' => csrf_token()]);
        $response = $this->call('patch','/administrator/update-category/'.$category->ID,$data);
        $response->assertStatus(302); // Redirection
    }

    public function testdetailCategory()
    {
        //$this->loginWithFakeUser();
        $response = $this->get('/administrator/detail-category/1');
        $response->assertStatus(200);
    }

    public function testdeleteCategory()
    {
        $this->withoutMiddleware();
        $category = factory(Category::class)->create();

        $response = $this->delete('/administrator/destroy-category/'.$category->ID);
        $response->assertStatus(302); // We can test with redirect code
        //$response->assertRedirect('administrator/view-category');
        
    }

    public function loginWithFakeUser()
    {
        $user = new Administrator([
            'id' => 1,
            'name' => 'admin'
        ]);

        $this->be($user, 'administrator');
    }

}
