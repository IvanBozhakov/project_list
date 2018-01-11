<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

class ItemController extends Controller
{
    public function add(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'description' => 'required',
            'price'=>'numeric|min:0',
            'country'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $item = new \App\Item();
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->country = $request->input('country');
        $item->save();

        return redirect()->back()->with('success',"Продукта бе добавен успешно!");
    	
    }

    public function edit($id)
    {
    	$item = \App\Item::find($id);
    	$countries = \App\Country::all();
    	return view('edit')->with(['item'=>$item,'countries'=>$countries]);
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'description' => 'required',
            'price'=>'numeric|min:0',
            'country'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $item = \App\Item::find($request->input('id'));
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->country = $request->input('country');
        $item->save();

        return redirect()->back()->with('success',"Продукта бе редактиран успешно!");
    	
    }

    public function delete(Request $request)
    {
    	try{
    		$item  = \App\Item::find($request->input('id'));
    		$item->delete();
    		return ['success'=>200];
    	}catch(\Exception $ex){
    		return ['error'=>$ex->getMessage()];
    	}
    	
    }
}
