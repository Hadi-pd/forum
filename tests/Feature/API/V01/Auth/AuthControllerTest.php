<?php

namespace Tests\Feature\API\V01\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Nette\Utils\Random;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_register_should_be_validate()
    {
        $response = $this->post('api/v1/auth/register');
        $response->assertStatus(302);
    }
    public function test_new_user_can_register()
    {
            $test_code = random_int(10, 99).time();
            $response = $this->post('api/v1/auth/register', [
            'name' => "Hadi Poushedar".$test_code,
            'email' => $test_code."h7ad3i@gmail.com",
            'password'=> "12345678"
        ]);
        $response->assertStatus(201);
    }
}
