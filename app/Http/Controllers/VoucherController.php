<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Voucher;

class VoucherController extends Controller
{
    public function index()
    {
        $data = Voucher::all();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'name_voucher' => 'required|max:50',
            'code_voucher' => 'required|max:100',
            'discount' => 'required|numeric',
            'mix_discount' => 'required|numeric',
            'mix_usage' => 'required|numeric',
        ]);
        $count = 0;
        $status = 0;
        $time = date("y-m-d h:i:s");
        $data = Voucher::create([
            'name_voucher' => $req->input('name_voucher'),
            'code_voucher' => $req->input('code_voucher'),
            'discount' => $req->input('discount'),
            'mix_discount' => $req->input('mix_discount'),
            'mix_usage' => $req->input('mix_usage'),
            'count' => $count,
            'status' => $status,
            'expired_date' => $time
        ]);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function findId($id)
    {
        $data = Voucher::find($id);

        if (empty($data)) {
            return response(costumResponse("success", "id not pound", 200, 0));
        }
        return response(costumResponse("success", $data, 200, 1));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'name_voucher' => 'required|max:50',
            'code_voucher' => 'required|max:100',
            'discount' => 'required|numeric',
            'mix_discount' => 'required|numeric',
            'mix_usage' => 'required|numeric',
        ]);
        $count = 0;
        $status = 1;
        $time = date("y-m-d h:i:s");

        $voucher = Voucher::find($id);

        if (empty($voucher)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $voucher->name_voucher = $req->input('name_voucher');
        $voucher->code_voucher = $req->input('code_voucher');
        $voucher->discount = $req->input('discount');
        $voucher->mix_discount = $req->input('mix_discount');
        $voucher->mix_usage = $req->input('mix_usage');
        $voucher->count = $count;
        $voucher->status = $status;
        $voucher->expired_date = $time;


        $voucher->save();
        return response(costumResponse("success", "update Succesfuly", 200, 1));
    }

    public function delete($id)
    {
        $voucher = Voucher::find($id);

        if (empty($voucher)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $voucher->delete();
        return response(costumResponse("success", "delete Succesfuly", 200, 1));
    }
}
