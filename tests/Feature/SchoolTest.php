<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchoolTest extends TestCase
{
  public function test_create_school_successful()
  {
    $this->withoutExceptionHandling();

      $requestData = [
          'name' => fake()->firstName(),
          'email' => fake()->email(),
          'password' => 'password123',
      ];

      $response = $this->post('/schools', $requestData);

      $this->assertEquals(302, $response->getStatusCode());
      $response->assertRedirect();

      $this->assertDatabaseHas('users', [
          'email' => $requestData['email'],
      ]);

      $this->assertDatabaseHas('tenants', [
          'name' => $requestData['name'],
          'domain' => strtolower(str_replace(' ', '', $requestData['name'])).'.localhost',
      ]);

      $this->assertDatabaseHas('schools', [
          'name' => $requestData['name'],
      ]);

      $this->assertDatabaseHas('school_users', [
          'school_id' => School::where('name', $requestData['name'])->first()->id,
          'user_id' => User::where('email', $requestData['email'])->first()->id,
      ]);
  }
}
