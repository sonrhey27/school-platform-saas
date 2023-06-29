<?php

namespace Tests\Feature;

use App\Models\YearLevel;
use Tests\TenantTestCase;

class StudentTest extends TenantTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_student_index()
    {
      $domain = app('currentTenant')->domain;
      $response = $this->get('http://'.$domain.'/register-student');

      $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_create_student()
    {
      $domain = app('currentTenant')->domain;

      $requestData = [
        'name' => fake()->firstName(),
        'initial' => fake()->randomLetter(),
        'email' => fake()->email(),
        'password' => fake()->password(),
        'year_level_id' => YearLevel::first()->id
      ];

      $studentNameLower = str_replace(' ', '', $requestData['name']);
      $domainStudent = strtolower($requestData['name']).'.'.$domain;

      $response = $this->post('http://'.$domain.'/student', $requestData);
      $this->assertEquals(302, $response->getStatusCode());

      $response->assertRedirect();

      $this->assertDatabaseHas('users', [
        'email' => $requestData['email']
      ]);

      $this->assertDatabaseHas('tenants', [
        'name' => $requestData['name'],
        'domain' => $domainStudent,
        'database' => $studentNameLower
      ]);

      $this->assertDatabaseHas('students', [
        'name' => $requestData['name'],
        'initial' => $requestData['initial']
      ]);

    }
}
