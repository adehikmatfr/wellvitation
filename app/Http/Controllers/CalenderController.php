<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Calendars;
use App\Order;

class CalenderController extends Controller
{
    public function index()
    {
        $data = Calendars::all();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'order_id' => 'required',
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'allday' => 'required',
            'colors' => 'required',
        ]);
        $order = Order::where("id", $req->input('order_id'))->first();
        if (!$order) {
            return response(costumResponse("failed", "Order not found", 401, 0));
        }
        $data = Calendars::create([
            'order_id' => $req->input('order_id'),
            'title' => $req->input('title'),
            'start' => $req->input('start'),
            'total' => $req->input('total'),
            'end' => $req->input('end'),
            'allday' => $req->input('allday'),
            'colors' => $req->input('colors')
        ]);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function findId($id)
    {
        $data = Calendars::find($id);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'order_id' => 'required',
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'allday' => 'required',
            'colors' => 'required',
        ]);

        $calender = Calendars::find($id);

        if (empty($calender)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $calender->order_id = $req->input('order_id');
        $calender->title = $req->input('title');
        $calender->start = $req->input('start');
        $calender->end = $req->input('end');
        $calender->allday = $req->input('allday');
        $calender->colors = $req->input('colors');

        $calender->save();
        return response(costumResponse("success", "update Succesfuly", 200, 1));
    }

    public function delete($id)
    {
        $calender = Calendars::find($id);
        if (empty($calender)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }
        $calender->delete();
        return response(costumResponse("success", "delete Succesfuly", 200, 1));
    }
}
