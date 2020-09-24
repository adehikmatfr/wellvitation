<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Midtrans\Notification;

use App\Order;
use App\AmplopDigital;

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

        $vaNumber = null;

        if (!empty($paymentNotif->va_numbers[0])) {
            $vaNumber = $paymentNotif->va_numbers[0]->va_number;
        }

        $paymentStatus = null;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $paymentStatus = \App\AmplopDigital::CHALLENGE;
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $paymentStatus = \App\AmplopDigital::SUCCESS;
                    $order->payment_status = 1;
                    $order->payment_method = $type;
                    $order->save();
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $paymentStatus = \App\AmplopDigital::SETTLEMENT;
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $paymentStatus = \App\AmplopDigital::PENDING;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = \App\AmplopDigital::DENY;
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $paymentStatus = \App\AmplopDigital::EXPIRE;
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = \App\AmplopDigital::CANCEL;
        }

        $pay = [
            'trx_id' => generateCode(6), 'user_id' => $order->user_id, 'order_id' => $order->id,
            'nominal' => $gAmount, 'payment_method' => $type, 'payloads' => strval($req)
        ];
        $data = AmplopDigital::create($pay);
        if ($data) {
            return response(costumResponse("success", $data, 200, 1));
        } else {
            return response(costumResponse("failed", "notification failed", 500, 0));
        }
    }

    public function completed()
    {
    }

    public function failed()
    {
    }
}
