<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Bride;

class BrideController extends Controller
{
    public function index()
    {
        $data = Bride::all();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'bridegroom_name' => 'required|max:100',
            'bridegroom_religion' => 'required|max:100',
            'bridegroom_guardian' => 'required|max:100',
            'bridegroom_bio' => 'required',
            'bridegroom_social' => 'required',
            'bride_name' => 'required|max:100',
            'bride_religion' => 'required|max:100',
            'bride_guardian' => 'required|max:100',
            'bride_bio' => 'required',
            'bride_social' => 'required'
        ]);
        $data = Bride::create([
            'bridegroom_name' => $req->input('bridegroom_name'),
            'bridegroom_religion' => $req->input('bridegroom_religion'),
            'bridegroom_guardian' => $req->input('bridegroom_guardian'),
            'bridegroom_bio' => $req->input('bridegroom_bio'),
            'bridegroom_social' => $req->input('bridegroom_social'),
            'bride_name' => $req->input('bride_name'),
            'bride_religion' => $req->input('bride_religion'),
            'bride_guardian' => $req->input('bride_guardian'),
            'bride_bio' => $req->input('bride_bio'),
            'bride_social' => $req->input('bride_social')
        ]);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function findId($id)
    {
        $data = Bride::find($id);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'bridegroom_name' => 'required|max:100',
            'bridegroom_religion' => 'required|max:100',
            'bridegroom_guardian' => 'required|max:100',
            'bridegroom_bio' => 'required',
            'bridegroom_social' => 'required',
            'bride_name' => 'required|max:100',
            'bride_religion' => 'required|max:100',
            'bride_guardian' => 'required|max:100',
            'bride_bio' => 'required',
            'bride_social' => 'required'
        ]);

        $bride = Bride::find($id);

        if (empty($bride)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $bride->bridegroom_name = $req->input('bridegroom_name');
        $bride->bridegroom_religion = $req->input('bridegroom_religion');
        $bride->bridegroom_guardian = $req->input('bridegroom_guardian');
        $bride->bridegroom_bio = $req->input('bridegroom_bio');
        $bride->bridegroom_social = $req->input('bridegroom_social');
        $bride->bride_name = $req->input('bride_name');
        $bride->bride_religion = $req->input('bride_religion');
        $bride->bride_guardian = $req->input('bride_guardian');
        $bride->bride_bio = $req->input('bride_bio');
        $bride->bride_social = $req->input('bride_social');

        $bride->save();
        return response(costumResponse("success", "update Succesfuly", 200, 1));
    }

    public function delete($id)
    {
        $bride = Bride::find($id);

        if (empty($bride)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $bride->delete();
        return response(costumResponse("success", "delete Succesfuly", 200, 1));
    }
}
