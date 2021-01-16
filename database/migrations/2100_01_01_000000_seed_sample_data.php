<?php

class SeedSampleData extends \Illuminate\Database\Migrations\Migration {

    public function up() {
        $u = new \App\Models\User(['name' => 'test admin', 'email' => 'a@a.com', 'password' => 'abc']);
        $u->email_verified_at = now();
        $u->password =  'abc';
        $u->save();

        $t1 = \App\Models\Tenant::create([
            'tenancy_db_username' => 'tenant_' . 'dev',
            'tenancy_db_password' => 'tenant_pass_dev',
        ]);
        $t1->domains()->create(['domain' => 'test']);
    }

    public function down() {

    }
}