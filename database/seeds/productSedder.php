<?php

use Illuminate\Database\Seeder;

class productSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=factory(\App\Product::class, 10)->create();
        print($data);
    }
}
