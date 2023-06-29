<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\Subject;
use App\Models\YearLevel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TenantTestCase;

class ExamTest extends TenantTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index_exam()
    {
      $domain = app('currentTenant')->domain;
      $response = $this->get('http://'.$domain.'/exam');

      $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_create_exam()
    {
      $this->withoutExceptionHandling();

      $domain = app('currentTenant')->domain;

      $school = School::where('tenant_id', app('currentTenant')->id)->first();
      $yearLevel = YearLevel::first();
      $subject = Subject::where([
        'school_id' => $school->id,
        'year_level_id' => $yearLevel->id
      ])->first();

      $requestData = [
        'year_level' => $yearLevel->id,
        'subject_list' => $subject->id,
        'title' => fake()->sentence()
      ];

      $response = $this->post('http://'.$domain.'/exam', $requestData);
      $this->assertEquals(302, $response->getStatusCode());
      $response->assertRedirect();

      $this->assertDatabaseHas('exams', [
        'year_level_id' => $requestData['year_level'],
        'subject_id' => $requestData['subject_list'],
        'title' => $requestData['title']
      ]);
    }
}
