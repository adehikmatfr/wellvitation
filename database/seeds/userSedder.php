<?php

use Illuminate\Database\Seeder;

class userSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=factory(\App\User::class, 10)->create();
    }
}
