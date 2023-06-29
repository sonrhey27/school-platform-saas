<?php

namespace App\Repositories;
use App\Interfaces\TenantRepositoryInterface;
use App\Models\Tenant;

class TenantRepository implements TenantRepositoryInterface
{
  public function createTenant($tenantDetails)
  {
    return Tenant::create($tenantDetails);
  }

  public function getTenantById($tenantId) {
    return Tenant::find($tenantId);
  }
}
