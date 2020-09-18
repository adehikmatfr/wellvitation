<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return response(costumResponse("success", $data, 200, 1));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'name_products' => 'required|max:50',
            'price' => 'required|numeric',
            'detail' => 'required',
            'domain' => 'required',
            'fitur' => 'required',
        ]);
        $data = Product::create([
            'name_products' => $req->input('name_products'),
            'price' => $req->input('price'),
            'detail' => $req->input('detail'),
            'domain' => $req->input('domain'),
            'fitur' => $req->input('fitur'),
        ]);
        return response(costumResponse("success", $data, 200, 1));
    }

    public function findId($id)
    {
        $data = Product::find($id);

        if (empty($data)) {
            return response(costumResponse("success", "id not pound", 200, 0));
        }
        return response(costumResponse("success", $data, 200, 1));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'name_products' => 'required|max:50',
            'price' => 'required|numeric',
            'detail' => 'required',
            'domain' => 'required',
            'fitur' => 'required',
        ]);

        $product = Product::find($id);

        if (empty($product)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $product->name_products = $req->input('name_products');
        $product->price = $req->input('price');
        $product->detail = $req->input('detail');
        $product->domain = $req->input('domain');
        $product->fitur = $req->input('fitur');

        $product->save();
        return response(costumResponse("success", "update Succesfuly", 200, 1));
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            return response(costumResponse("failed", "id not pound", 201, 0));
        }

        $product->delete();
        return response(costumResponse("success", "delete Succesfuly", 200, 1));
    }
}
