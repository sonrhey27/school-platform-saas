<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\Tenant;
use Tests\TenantTestCase;

class YearLevelTest extends TenantTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index_year_level()
    {
      $domain = Tenant::first()->domain;

      $response = $this->get('http://'.$domain.'/year-level');

      $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_create_year_level()
    {
      $this->withoutExceptionHandling();

      $requestData = [
        'name' => fake()->firstName(),
        'adviser' => fake()->name()
      ];

      $domain = Tenant::first()->domain;

      $response = $this->post('http://'.$domain.'/year-level', $requestData);

      $this->assertEquals(302, $response->getStatusCode());

      $response->assertRedirect();

      $this->assertDatabaseHas('year_levels', [
        'name' => $requestData['name'],
        'adviser' => $requestData['adviser'],
        'school_id' => School::where('tenant_id', app('currentTenant')->id)->first()->id
      ]);
    }
}
