<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Description;

class DescriptionController extends Controller
{
    public function index()
    {
        $data = Description::all();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'web_name' => 'required|max:100',
            'event_name' => 'required|max:100',
            'event_desc' => 'required',
            'akad_place' => 'required|max:100',
            'akad_address' => 'required',
            'akad_date' => 'required',
            'marriage_place' => 'required',
            'marriage_address' => 'required',
            'marriage_date' => 'required',
            'description' => 'required',
            'message' => 'required',
            'youtube_link' => 'required|max:255',
            'asset_link' => 'required|max:255'
        ]);
        $data = Description::create([
            'web_name' => $req->input('web_name'),
            'event_name' => $req->input('event_name'),
            'event_desc' => $req->input('event_desc'),
            'akad_place' => $req->input('akad_place'),
            'akad_address' => $req->input('akad_address'),
            'akad_date' => $req->input('akad_date'),
            'marriage_place' => $req->input('marriage_place'),
            'marriage_address' => $req->input('marriage_address'),
            'marriage_date' => $req->input('marriage_date'),
            'description' => $req->input('description'),
            'message' => $req->input('message'),
            'youtube_link' => $req->input('youtube_link'),
            'asset_link' => $req->input('asset_link'),
        ]);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function findId($id)
    {
        $data = Description::find($id);

        if (empty($data)) {
            return response(costumResponse("success", "id not pound", 200, 0));
        }
        return response(costumResponse("success", $data, 200, 1));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'web_name' => 'required|max:100',
            'event_name' => 'required|max:100',
            'event_desc' => 'required',
            'akad_place' => 'required|max:100',
            'akad_address' => 'required',
            'akad_date' => 'required',
            'marriage_place' => 'required',
            'marriage_address' => 'required',
            'marriage_date' => 'required',
            'description' => 'required',
            'message' => 'required',
            'youtube_link' => 'required|max:255',
            'asset_link' => 'required|max:255'
        ]);

        $description = Description::find($id);

        if (empty($description)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $description->web_name = $req->input('web_name');
        $description->event_name = $req->input('event_name');
        $description->event_desc = $req->input('event_desc');
        $description->akad_place = $req->input('akad_place');
        $description->akad_address = $req->input('akad_address');
        $description->akad_date = $req->input('akad_date');
        $description->marriage_place = $req->input('marriage_place');
        $description->marriage_address = $req->input('marriage_address');
        $description->marriage_date = $req->input('marriage_date');
        $description->description = $req->input('description');
        $description->message = $req->input('message');
        $description->youtube_link = $req->input('youtube_link');
        $description->asset_link = $req->input('asset_link');

        $description->save();
        return response(costumResponse("success", "update Succesfuly", 200, 1));
    }

    public function delete($id)
    {
        $description = Description::find($id);

        if (empty($description)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $description->delete();
        return response(costumResponse("success", "delete Succesfuly", 200, 1));
    }
}
