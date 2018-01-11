<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        
        $items = $this->paginate($req);
        $countries = \App\Country::all();
        return view('home')->with(['items'=>$items, 'countries' => $countries, 'sort'=>$req->get('sort_price')]);
    }

    public function paginate(Request $req){
        
        return \App\Item::with('country_object')->orderBy('price',$req->get('sort_price'))->paginate(2);
    }
}
