<?php

use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
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
            'RW',
            'ST',
            'LW',
            'CAM',
            'RM',
            'CM',
            'LM',
            'CDM',
            'RB',
            'CB',
            'LB',
            'GK',
        ];

        foreach ($arr as $ar) {
            $position = new \App\Position();
            $position->name = $ar;
            $position->save();
        }
    }
}
