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
        $tenant1 = Tenant::firstOrCreate([
            'id' => 't1', 
        ]);
        $tenant1->update([
            'plan' => 'free',
            'name' => 'Tenant 1',
        ]);
        $tenant1->domains()->firstOrCreate(['domain' => 't1.application.test']);

        // Tenant 2
        $tenant2 = Tenant::firstOrCreate([
            'id' => 't2', 
        ]);
        $tenant2->update([
            'plan' => 'free',
            'name' => 'Tenant 2',
        ]);
        $tenant2->domains()->firstOrCreate(['domain' => 't2.application.test']);
    }
}
