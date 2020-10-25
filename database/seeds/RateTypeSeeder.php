<?php

use Illuminate\Database\Seeder;

class RateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr = [
            'Speed',
            'Shooting',
            'Power-accuracy',
            'Dribbling',
            'Defending interception',
            'Heading',
            'Physical'
        ];

        foreach ($arr as $ar) {
            $rate_type = new \App\RateType();
            $rate_type->name = $ar;
            $rate_type->save();
        }
    }
}
