<?php

namespace Tests\Feature;

use App\Models\Exam;
use App\Models\ExamDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TenantTestCase;

class ExamDetailTest extends TenantTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index_exam_detail()
    {
      $domain = app('currentTenant')->domain;
      $exam = Exam::first();
      $response = $this->get('http://'.$domain.'/exam/'.$exam->id.'/details');

      $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_create_exam_detail()
    {
      $domain = app('currentTenant')->domain;
      $exam = Exam::first();

      $requestData = [
        'question' => fake()->sentence(),
        'choices' => [
          'choice-1' => fake()->sentence(),
          'choice-2' => fake()->sentence(),
          'choice-3' => fake()->sentence(),
          'choice-4' => fake()->sentence(),
        ],
        'choice' => [
          'choice-1' => 'choice-1',
          'choice-2' => 'choice-2',
          'choice-3' => 'choice-3',
          'choice-4' => 'choice-4'
        ]
      ];

      $response = $this->post('http://'.$domain.'/exam/'.$exam->id.'/details', $requestData);
      $this->assertEquals(302, $response->getStatusCode());
      $response->assertRedirect();

      $this->assertDatabaseHas('exam_details', [
        'exam_id' => $exam->id,
        'question' => $requestData['question']
      ]);

      $this->assertDatabaseHas('exam_choices', [
        'exam_detail_id' => ExamDetail::where('exam_id', $exam->id)->first()->id
      ]);
    }
}
