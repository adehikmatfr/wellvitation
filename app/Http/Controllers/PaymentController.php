<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Midtrans\Notification;

use App\Order;
use App\PaymentOrders;

class PaymentController extends Controller
{
    public function notification(Request $req)
    {

        $this->validate($req, [
            'order_id' => 'required',
            'status_code' => 'required',
            'gross_amount' => 'required',
            'signature_key' => 'required'
        ]);

        $orderId = $req->input('order_id');
        $status = $req->input('status_code');
        $gAmount = $req->input('gross_amount');
        $signatureKey = $req->input('signature_key');

        $validSignatur = hash('sha512', $orderId . $status . $gAmount . env('MIDTRANS_TOKEN'));

        if ($signatureKey !== $validSignatur) {
            return response(costumResponse("failed", "invalid signature", 403, 0));
        }
        $this->initPaymentGetWay();

        $paymentNotif = new Notification();

        $transaction = $paymentNotif->transaction_status;
        $type = $paymentNotif->payment_type;
        $order_id = $paymentNotif->order_id;
        $fraud = $paymentNotif->fraud_status;

        $order = Order::where('order_code', $paymentNotif->order_id)->firstOrFail();
        $order->payment_method = $type;
        $order->save();

        $paymentStatus = "";
        $maskedCard = "";
        $eci = "";
        $channel_response_message = "";
        $channel_response_code = "";
        $card_type = "";
        $bank = "";

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $paymentStatus = PaymentOrders::CHALLENGE;
                } else {
                    $paymentStatus = PaymentOrders::SUCCESS;
                }
            }
        } else if ($transaction == 'settlement') {
            $paymentStatus = PaymentOrders::SETTLEMENT;
        } else if ($transaction == 'pending') {
            $paymentStatus = PaymentOrders::PENDING;
        } else if ($transaction == 'deny') {
            $paymentStatus = PaymentOrders::DENY;
        } else if ($transaction == 'expire') {
            $paymentStatus = PaymentOrders::EXPIRE;
        } else if ($transaction == 'cancel') {
            $paymentStatus = PaymentOrders::CANCEL;
        }

        $pay = [
            'order_id' => $order->id,
            'transaction_time' => $paymentNotif->transaction_time,
            'transaction_status' => $paymentStatus,
            'transaction_id' => $paymentNotif->transaction_id,
            'status_message' => $paymentNotif->status_message,
            'status_code' => $paymentNotif->status_code,
            'signature_key' => $paymentNotif->signature_key,
            'payment_type' => $paymentNotif->payment_type,
            'merchant_id' => $paymentNotif->merchant_id,
            'masked_card' => $maskedCard,
            'gross_amount' => $paymentNotif->gross_amount,
            'fraud_status' => $paymentNotif->fraud_status,
            'eci' => $eci,
            'currency' => $paymentNotif->currency,
            'channel_response_message' => $channel_response_message,
            'channel_response_code' => $channel_response_code,
            'card_type' => $card_type,
            'bank' => $bank
        ];
        $data = PaymentOrders::create($pay);
        if ($data) {
            return response(costumResponse("success", $data, 200, 1));
        } else {
            return response(costumResponse("failed", "notification failed", 500, 0));
        }
    }

    public function completed(Request $req)
    {
        if ($req->status_code === "200") {
            $transaction = $req->input("transaction_status");
            $order_id = $req->input("order_id");
            $order = Order::where('order_code', $order_id)->firstOrFail();
            $order->payment_status = 1;
            $order->status_order = 1;
            $order->save();
            return response(costumResponse("success", $order, 200, 1));
        }
        return response(costumResponse("failed", "transaction not complited", 204, 0));
    }

    public function failed(Request $req)
    {
        return $req;
    }
}
