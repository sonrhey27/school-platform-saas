<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Event;
use Spatie\Multitenancy\Concerns\UsesMultitenancyConfig;
use Spatie\Multitenancy\Events\MadeTenantCurrentEvent;
use Spatie\Multitenancy\Models\Tenant;

abstract class TenantTestCase extends BaseTestCase
{
  use CreatesApplication;

  protected function setUp(): void
  {
      parent::setUp();

      Tenant::first()->makeCurrent();
  }
}
