<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Order;

class OrderController extends Controller
{
    public function index(Request $req)
    {
        $user=[
            'ade',
            'email@gmail.com',
            '082121654396',
        ];
        $item=[
            '1',
            20000,
            'oakao',
            1
        ];
        $order=[
            generateOrderCode(),
            '20000',
        ];

        $params=$this->generatePaymentToken($user,$order,$item);
        $snapUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
        // $snapToken = \Midtrans\Snap::getSnapToken($params);
        // $data = array(
        //     'snapToken' => $snapToken,
        //     'redirect_url' => $snapUrl
        // );
        return $snapUrl;
    }

    public function store(Request $req)
    {

    }

    private function generatePaymentToken($user,$order,$item){
        $this->initPaymentGetWay();

        $costumerDetails=[
            'first_name'=>$user[0],
            'last_name'=>'',
            'email'=>$user[1],
            'phone'=>$user[2],
        ];
        $items=[
            [
            'id'=> $item[0],
            'price'=> $item[1],
            'name'=> $item[2],
            'quantity'=>$item[3]
            ]
        ];
        $params=[
            'enable_payments'=>\App\AmplopDigital::PAYMENT_CHANEL,
            'transaction_details'=>[
                'order_id'=>$order[0],
                'gross_amount'=>$order[1],
            ],
            'item_details'=> $items,
            'customer_details'=>$costumerDetails,
            'expiry'=>[
                'start_time'=>date('Y-m-d H:i:s T'),
                'unit'=>\App\AmplopDigital::EXPIRY_UNIT,
                'duration'=>\App\AmplopDigital::EXPIRY_DURATION
            ]
            ];

        return $params;
    }
}