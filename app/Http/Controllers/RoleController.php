<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::find()->where('id', '>', 1)->get();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'role_name' => 'required|max:50'
        ]);
        $data = Role::create([
            'role_name' => $req->input('role_name'),
        ]);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function findId($id)
    {
        $data = Role::find($id);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'role_name' => 'required|max:20',
        ]);

        $role = Role::find($id);

        if (empty($role)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $role->role_name = $req->input('role_name');
        $role->save();
        return response(costumResponse("success", "update Succesfuly", 200, 1));
    }

    public function delete($id)
    {
        $role = Role::find($id);

        if (empty($role)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $role->delete();
        return response(costumResponse("success", "delete Succesfuly", 200, 1));
    }
}
