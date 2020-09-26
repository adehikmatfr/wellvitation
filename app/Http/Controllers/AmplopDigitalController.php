<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Order;
use App\User;
use App\AmplopDigital;


class AmplopDigitalController extends Controller
{
    public function index(Request $req)
    {
        $data = AmplopDigital::all();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function findId($id)
    {
        $data = AmplopDigital::find($id);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'user_id' => 'required',
            'order_id' => 'required',
            'nominal' => 'required',
        ]);
        $userId = $req->input("user_id");
        $orderId = $req->input("order_id");
        $nominal = $req->input("nominal");

        $user = User::where("id", $userId)->first();
        if (!$user) {
            return response(costumResponse("failed", "user not found", 401, 0));
        }
        $order = Order::where("id", $orderId)->first();
        if (!$order) {
            return response(costumResponse("failed", "bride not found", 401, 0));
        }

        $trx_code = generateCode(6);

        $data = AmplopDigital::create([
            "trx_id" => $trx_code,
            "user_id" => $user->id,
            "order_id" => $order->id,
            "nominal" => $nominal,
            "payment_method" => "",
        ]);
        if ($data) {
            $userDetail = [
                $user->name,
                $user->email,
                $user->phone,
            ];
            $paymentDetail = [
                $data->trx_id,
                $data->nominal,
            ];
            $params = $this->generatePaymentToken(
                $userDetail,
                $paymentDetail
            );
            $snapUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            $result = [
                'trx_id' => $data->trx_id,
                'redirect_url' => $snapUrl
            ];
            return response(costumResponse("success", $result, 200, 1));
        } else {
            return response(costumResponse("failed", "internal server error", 500, 0));
        }
    }

    private function generatePaymentToken($user, $order)
    {
        $this->initPaymentGetWay();

        $costumerDetails = [
            'first_name' => $user[0],
            'last_name' => '',
            'email' => $user[1],
            'phone' => $user[2],
        ];
        $params = [
            'enabled_payments' => \App\PaymentOrders::PAYMENT_CHANEL,
            'transaction_details' => [
                'order_id' => $order[0],
                'gross_amount' => $order[1],
            ],
            'customer_details' => $costumerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => \App\PaymentOrders::EXPIRY_UNIT,
                'duration' => \App\PaymentOrders::EXPIRY_DURATION
            ]
        ];

        return $params;
    }
}
