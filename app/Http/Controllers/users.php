<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
class users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.register");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
		
		//$user = User::create(Request(['name','email','password']));
		$user = DB::table("users")->insert([
			"name"=>$request->input("name"),
			"email"=>$request->input("email"),
			"password"=>Hash::make($request->input("password"))
		]);
		
		//auth()->login($user);
		//return redirect()->to('/');
		
		return view("users.pending_validation",["email"=>$request->input("email")]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
		$userData = DB::table("users")->where("id",$id)->where("active",1)->get();
		
		if(count((array)$userData) == 1){
			return view("users.profile",["userData"=>$userData]);
		}else{
			abort(404);
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
		$this->middleware('auth');
		return view("users.account",["userData"=>DB::table("users")->select('name','email','active')->where("id",Auth::id())->where("active",1)->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {$this->middleware('auth');
        DB::table("users")->where("id",Auth::id())->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {$this->middleware('auth');
        if($id === Auth::id()){
			DB::table("users")->where("id",$id)->update(["active"=>0]);
		}else{
			abort(404);
		}
    }
	/**
	*Begin custom method section
	*/
}
