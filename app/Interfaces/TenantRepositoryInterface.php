<?php

namespace App\Interfaces;

interface TenantRepositoryInterface
{
  public function createTenant(array $tenantDetails);
  public function getTenantById($tenantId);
}
