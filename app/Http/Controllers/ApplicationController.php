<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userapplication;
use App\Http\Requests;
use Validator;
use DB;

class ApplicationController extends Controller
{
    public function index(){
    	return view('application.welcome');
    }

    public function izvuci(){
        $random_user = Userapplication::orderBy(\DB::raw('RAND()'))->get();
            $randomusers = Userapplication::orderBy(DB::raw('RAND()'))->take(5)->get();
            $user  = Userapplication::all();
            $count = Userapplication::count();
        return view('application.spinner')->with(['prijave'=>$user,'ukupno'=>$count,'randomusers'=>$randomusers]);
    }
 
    public function apply(Request $request){
    		$name = $request->input('name');

    		$this->validate($request, [
        		'first_name'=> 'required|max:255',
        		'last_name' => 'required',
        		'email'     => 'required|unique:userapplications|max:255|email',
    		]);
    		/*
    		if ($validator->fails()) {
	            return redirect('/')
	                        ->withErrors($validator)
	                        ->withInput();
        	}else{
        		*/
        		$user = new Userapplication;
        		$user->first_name =  $request->input('first_name');
        		$user->last_name =  $request->input('last_name');
        		$user->email =  $request->input('email');
        		$user->save();
        		return redirect('/success');
        	//}

    }

    public function prijave(){
    	    $random_user = Userapplication::orderBy(\DB::raw('RAND()'))->get();
    	    $randomusers = Userapplication::orderBy(DB::raw('RAND()'))->take(5)->get();
    		$user  = Userapplication::all();
    		$count = Userapplication::count();
    		return view('application.prijave')->with(['prijave'=>$user,'ukupno'=>$count,'randomusers'=>$randomusers]);
    		return $user;
    }
}
