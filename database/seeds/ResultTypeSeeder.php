<?php

use Illuminate\Database\Seeder;

class ResultTypeSeeder extends Seeder
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
            'Best player',
            'Clean tackles',
            'First level',
            'Second level',
            'Third level'
        ];

        foreach ($arr as $ar) {
            $result_type = new \App\ResultType();
            $result_type->name = $ar;
            $result_type->save();
        }
    }
}
