<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Passport\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default = Client::find("98d38829-6f47-4882-94f0-f53127e32a00");
        if (!$default) {
            $default = new Client();
            $default->id = "98d38829-6f47-4882-94f0-f53127e32a00";
        }
        $default->name = "Base Application";
        $default->redirect = "http://application.test/passport/callback";
        $default->secret = "FnJV8nN3iM0FYcbPcOTNnKECFDqJAEpv6M351mAZ";
        $default->personal_access_client = false;
        $default->password_client = false;
        $default->revoked = false;
        $default->custom = [
            'logo' => '',
            'theme' => 'default',
        ];
        $default->save();
        
        $tenant1 = Client::find("98e47a60-d82a-4702-8782-80e6ae58ec6f");
        if (!$tenant1) {
            $tenant1 = new Client();
            $tenant1->id = "98e47a60-d82a-4702-8782-80e6ae58ec6f";
        }
        $tenant1->name = "Tenant 1";
        $tenant1->redirect = "http://t1.application.test/passport/callback";
        $tenant1->secret = "aDrllRPAc1aPYmAWWBOIcVC9a6JCEvX984uvBBCt";
        $tenant1->personal_access_client = false;
        $tenant1->password_client = false;
        $tenant1->revoked = false;
        $tenant1->custom = [
            'logo' => '',
            'theme' => 'tenant-one',
        ];
        $tenant1->save();

        $tenant2 = Client::find("98e47bd6-c097-45b8-901d-c61e5c34d5a0");
        if (!$tenant2) {
            $tenant2 = new Client();
            $tenant2->id = "98e47bd6-c097-45b8-901d-c61e5c34d5a0";
        }
        $tenant2->name = "Tenant 2";
        $tenant2->redirect = "http://t2.application.test/passport/callback";
        $tenant2->secret = "cMFUfdIPpf2Y0Mnea125mo2bGip7YYqYGncWF18Q";
        $tenant2->personal_access_client = false;
        $tenant2->password_client = false;
        $tenant2->revoked = false;
        $tenant2->custom = [
            'logo' => '',
            'theme' => 'tenant-two',
        ];
        $tenant2->save();
    }
}
