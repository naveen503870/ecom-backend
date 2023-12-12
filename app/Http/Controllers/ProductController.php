<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    function addProduct(Request $req){
        try{
        $product = new Product();
        $product->name=$req->input('name');
        $product->price=$req->input('price');
        $product->description=$req->input('description');
        if($req->file('file') == null){
            $product->file_path = " ";
        }else {
        $product->file_path=$req->file('file')->store('products');
        }
        $product->save();
        return $product;
        }catch(Exception $e){
            dd($e);
        }
    }
    function list(){
        return Product::all();
    }
    function delete($id){
        $data = Product::where('id', $id)->delete();
        if($data){
            return ["result"=>"products is deleted"];
        } else {
            return ["result"=>"NO id is present"];
        }
    }
    function product($id){
        return Product::where('id', $id)->first();
    }

    function updateProduct($id, Request  $req){
        $product = Product::find($id);
        $product->name=$req->input('name');
        $product->price=$req->input('price');
        $product->description=$req->input('description');
        if($req->file('file')){
            $product->file_path=$req->file('file')->store('products');
        }
        $product->save();
        return $product;

    }
}
