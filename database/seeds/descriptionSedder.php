<?php

use Illuminate\Database\Seeder;

class descriptionSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=factory(\App\Description::class, 10)->create();
        print($data);
    } 
}
