<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Order;
use App\User;
use App\Bride;
use App\Description;
use App\Voucher;
use App\Product;

class OrderController extends Controller
{
    public function index(Request $req)
    {
        $data = Order::all();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'user_id' => 'required',
            'bride_id' => 'required',
            'product_id' => 'required',
            'voucher_id' => 'required',
            'desc_id' => 'required',
        ]);
        $userId = $req->input("user_id");
        $brideId = $req->input("bride_id");
        $productId = $req->input("product_id");
        $voucherId = $req->input("voucher_id");
        $descId = $req->input("desc_id");

        $user = User::where("id", $userId)->first();
        if (!$user) {
            return response(costumResponse("failed", "user not found", 401, 0));
        }
        $bride = Bride::where("id", $brideId)->first();
        if (!$bride) {
            return response(costumResponse("failed", "bride not found", 401, 0));
        }
        $product = Product::where("id", $productId)->first();
        if (!$product) {
            return response(costumResponse("failed", "product not found", 401, 0));
        }
        $voucher = Voucher::where("id", $voucherId)->first();
        if (!$voucher) {
            return response(costumResponse("failed", "voucher not found", 401, 0));
        }
        $desc = Description::where("id", $descId)->first();
        if (!$desc) {
            return response(costumResponse("failed", "description not found", 401, 0));
        }
        $order_code = generateCode();
        $price_total = 2000;

        $data = Order::create([
            "order_code" => $order_code,
            "user_id" => $user->id,
            "bride_id" => $bride->id,
            "product_id" => $product->id,
            "voucher_id" => $voucher->id,
            "desc_id" => $desc->id,
            "price_total" => $price_total,
            "payment_method" => "",
            "payment_status" => 0,
            "status_order" => 0
        ]);
        if ($data) {
            $userDetail = [
                $user->name,
                $user->email,
                $user->phone,
            ];
            $itemDetail = [
                $product->id,
                $product->price,
                $product->name_products,
                1
            ];
            $orderDetail = [
                $data->order_code,
                $data->price_total,
            ];
            $params = $this->generatePaymentToken(
                $userDetail,
                $orderDetail,
                $itemDetail
            );
            $snapUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            $result = [
                'order_code' => $data->order_code,
                'redirect_url' => $snapUrl
            ];
            return response(costumResponse("success", $result, 200, 1));
        } else {
            return response(costumResponse("failed", "internal server error", 500, 0));
        }
    }

    private function generatePaymentToken($user, $order, $item)
    {
        $this->initPaymentGetWay();

        $costumerDetails = [
            'first_name' => $user[0],
            'last_name' => '',
            'email' => $user[1],
            'phone' => $user[2],
        ];
        $items = [
            [
                'id' => $item[0],
                'price' => $item[1],
                'name' => $item[2],
                'quantity' => $item[3]
            ]
        ];
        $params = [
            'enable_payments' => \App\AmplopDigital::PAYMENT_CHANEL,
            'transaction_details' => [
                'order_id' => $order[0],
                'gross_amount' => $order[1],
            ],
            'item_details' => $items,
            'customer_details' => $costumerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => \App\AmplopDigital::EXPIRY_UNIT,
                'duration' => \App\AmplopDigital::EXPIRY_DURATION
            ]
        ];

        return $params;
    }
}
