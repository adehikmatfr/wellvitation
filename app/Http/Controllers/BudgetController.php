<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Budget;
use App\Order;

class BudgetController extends Controller
{
    public function index()
    {
        $data = Budget::all();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'order_id' => 'required',
            'nama_kebutuhan' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'vendor' => 'required',
            'contact_person' => 'required',
        ]);
        $order = Order::where("id", $req->input('order_id'))->first();
        if (!$order) {
            return response(costumResponse("failed", "Order not found", 401, 0));
        }
        $total = $req->input('harga') * $req->input('jumlah');
        $data = Budget::create([
            'order_id' => $req->input('order_id'),
            'nama_kebutuhan' => $req->input('nama_kebutuhan'),
            'jumlah' => $req->input('jumlah'),
            'total' => $total,
            'harga' => $req->input('harga'),
            'vendor' => $req->input('vendor'),
            'contact_person' => $req->input('contact_person')
        ]);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function findId($id)
    {
        $data = Budget::find($id);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'order_id' => 'required',
            'nama_kebutuhan' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'vendor' => 'required',
            'contact_person' => 'required',
        ]);

        $budget = Budget::find($id);

        if (empty($budget)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $budget->order_id = $req->input('order_id');
        $budget->nama_kebutuhan = $req->input('nama_kebutuhan');
        $budget->jumlah = $req->input('jumlah');
        $budget->harga = $req->input('harga');
        $budget->vendor = $req->input('vendor');
        $budget->contact_person = $req->input('contact_person');
        $budget->total = $req->input('jumlah') * $req->input('harga');

        $budget->save();
        return response(costumResponse("success", "update Succesfuly", 200, 1));
    }

    public function delete($id)
    {
        $budget = Budget::find($id);
        if (empty($budget)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }
        $budget->delete();
        return response(costumResponse("success", "delete Succesfuly", 200, 1));
    }
}
