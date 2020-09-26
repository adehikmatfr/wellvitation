<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Config;

class ConfigController extends Controller
{
    public function index()
    {
        $data = Config::all();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'type' => 'required',
            'html_content' => 'required',
        ]);

        $data = Config::create([
            'type' => $req->input('type'),
            'html_content' => $req->input('html_content'),
        ]);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function findId($id)
    {
        $data = Config::find($id);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'type' => 'required',
            'html_content' => 'required',
        ]);

        $config = Config::find($id);

        if (empty($config)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $config->order_id = $req->input('type');
        $config->title = $req->input('html_content');

        $config->save();
        return response(costumResponse("success", "update Succesfuly", 200, 1));
    }

    public function delete($id)
    {
        $config = Config::find($id);
        if (empty($config)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }
        $config->delete();
        return response(costumResponse("success", "delete Succesfuly", 200, 1));
    }
}
