<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User as UsersModel;
use App\Lists as ListsModel;
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
		abort(404);
		/*
		*placeholder, the auth system handles this request
		*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
		$userData = UsersModel::find($id)->where("active",1)->get();
		$listsData = ListsModel::where("user_id",$id)->where("active",1)->where("is_public",1)->get();
		
		//$userData = UsersModel::select("users.name as username","lists.name as listsName")->join("lists","lists.user_id","=","users.id")->where("users.id",$id)->where("lists.is_public",true)->where("users.active",1)->get();
		if(count((array)$userData) == 1){
			return view("users.profile",["userData"=>$userData,"listsData"=>$listsData]);
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
		$userData = UsersModel::select("name","email","active")->where("id",Auth::id())->where("active",1)->get();
		//return view("users.account",["userData"=>DB::table("users")->select('name','email','active')->where("id",Auth::id())->where("active",1)->get()]);
		return view("users.account",["userData"=>$userData]);
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
       // DB::table("users")->where("id",Auth::id())->update($request->all());
	   $user = UsersModel::find(Auth::id());
	   $user->name = $request->name;
	   $user->email = $request->email;
	   if($request->password !== "" && $request->password === $request->password_confirm){
		$user->password = Hash::make($request->password);
	   }
	   $user->save();
	   
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
			//DB::table("users")->where("id",$id)->update(["active"=>0]);
			//UsersModel::destroy(Auth::id());
			$user = UsersModel::find(Auth::id());
			$user->active = 0;
			$user->save();
		}else{
			abort(404);
		}
    }
	/**
	*Begin custom method section
	*/
}
