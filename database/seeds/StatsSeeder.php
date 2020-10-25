<?php

use Illuminate\Database\Seeder;

class StatsSeeder extends Seeder
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
            'Stamina %',
            'Shot power %',
            'Shoot accuracy %',
            'Long pass %',
            'Short pass %',
            'Dribbling %',
            'Ball control %',
            'Defense %',
            'Physical %',
            'Skills ( by 5 stars )',

        ];

        foreach ($arr as $ar) {
            $stats = new \App\Stats();
            $stats->name = $ar;
            $stats->save();
        }
    }
}
