<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new \App\User();
        $user->username = 'mohsob';
        $user->first_name = 'Mohammed';
        $user->last_name = 'Abdualal';
//        $user->nickname = 'MohammedSobhei';
        $user->birth_date = '1991-02-13';
        $user->country_id = 1;
        $user->city_id = 1;
        $user->primer_position_id = 1;
        $user->height = 175;
        $user->weight = 65;
        $user->weight = 65;
        $user->verification_code = '1234';
        $user->is_confirm_code = 1;
        $user->favorite_leg = 'right';
        $user->email = 'api@api.com';
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->mobile = '999999999';
        $user->password = bcrypt('123456');
        $user->save();
    }
}
