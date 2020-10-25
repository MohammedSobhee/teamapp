<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new \App\Admin();
        $admin->username = 'Administrator';
        $admin->email = 'admin@admin.com';
        $admin->mobile = '+970597234815';
        $admin->password = bcrypt('123456');
        $admin->save();
    }
}
