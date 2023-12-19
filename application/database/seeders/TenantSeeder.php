<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tenant 1
        $tenant1 = Tenant::create(['id' => 't1']);
        $tenant1->domains()->create(['domain' => 't1.application.test']);

        // Tenant 2
        $tenant2 = Tenant::create(['id' => 't2']);
        $tenant2->domains()->create(['domain' => 't2.application.test']);
    }
}
