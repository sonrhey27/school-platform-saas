<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\Tenant;
use App\Models\YearLevel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TenantTestCase;

class SubjectTest extends TenantTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index_subject()
    {
      $domain = app('currentTenant')->domain;
      $response = $this->get('http://'.$domain.'/subject');

      $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_create_subject()
    {
      $this->withoutExceptionHandling();

      $domain = app('currentTenant')->domain;

      $subjectDetails = [
        'name' => fake()->firstName(),
        'year_level_id' => YearLevel::first()->id,
      ];

      $response = $this->post('http://'.$domain.'/subject', $subjectDetails);

      $this->assertEquals(302, $response->getStatusCode());

      $response->assertRedirect();

      $this->assertDatabaseHas('subjects', [
        'name' => $subjectDetails['name'],
        'year_level_id' => YearLevel::first()->id,
        'school_id' => School::where('tenant_id', app('currentTenant')->id)->first()->id
      ]);
    }
}
