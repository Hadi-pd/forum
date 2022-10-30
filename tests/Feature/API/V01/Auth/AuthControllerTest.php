<?php

namespace Tests\Feature\API\V01\Auth;

use App\Models\User;
use Database\Factories\UserFactory;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Nette\Utils\Random;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    //  use RefreshDatabase;
    
    
    /**
     * Test Register
     */
    public function test_register_should_be_validate()
    {
        $response = $this->postJson(route('auth.register'));
        $response->assertStatus(422);
    }
    public function test_new_user_can_register()
    {
            // $test_code = random_int(10, 99).time();
            $test_code = 22;
            $response = $this->postJson(route('auth.register'), [
            'name' => "Hadi Poushedar".$test_code,
            'email' => $test_code."h7ad3i@gmail.com",
            'password'=> "12345678"
        ]);
        $response->assertStatus(201);
    }
    /**
     * Test Login
     */
    public function test_login_should_be_validate()
    {
        $response = $this->postJson(route('auth.login'));
        $response->assertStatus(422); 
    }

    public function test_user_can_login_with_true_credentials()
    {
        $test_code = 22;
        // $user = factory(User::class)->create();
        $response = $this->postJson(route('auth.login'),[
            'email' => $test_code."h7ad3i@gmail.com",
            'password'=> "12345678"
        ]);
        $response->assertStatus(200);
    }
}
