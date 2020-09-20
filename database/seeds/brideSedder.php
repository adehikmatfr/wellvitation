<?php

use Illuminate\Database\Seeder;

class brideSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=factory(\App\Bride::class, 10)->create();
        print($data);
    }
}
