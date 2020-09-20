<?php

use Illuminate\Database\Seeder;

class voucherSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=factory(\App\Voucher::class, 10)->create();
        print($data);
    }
}
