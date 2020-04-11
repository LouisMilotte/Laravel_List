<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use App\Lists as ListsModel;
use App\User as UsersModel;
class lists extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("lists.recent",["listsData"=>DB::table("lists")->where("active",1)->where("is_public",1)->orderBy("create_by")->paginate(15)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("lists.new_list");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {$this->middleware('auth');
	$data = 
		array(
			"user"=>Auth::id(),
			"list"=>serialize($request->list),
			"is_public"=>$request->is_public === "on",
			"active"=>$request->active === "on",
			"tags"=>serialize(explode(",",$request->tags)),
			"slug"=>md5(Auth::id()).md5(time()),
			"name"=>$request->name,
			"created_at"=>Carbon::now()->toDateTimeString(),
			"updated_at"=>Carbon::now()->toDateTimeString()
		);
        $store = DB::table("lists")->insert(
		$data
		);
		
		//echo json_encode(array("status"=>($store > 0 ? 200:400),"message"=>($store > 0 ? "Record created successfully.":"Record failed to create.")));
		return redirect('/list/show/'.$data['slug']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {$this->middleware('auth');
        $listData = DB::table("lists")->select("users.name as username","users.id as uid","lists.*")->where("lists.slug",$slug)->join("users","users.id","=","lists.user_id")->get()->toArray();
		//$listData = ListsModel::where("lists.slug",$slug)->get();
		if($listData[0]->user_id === Auth::id() || $listData[0]->active === 1 && $listData[0]->is_public === 1){
			//$userData = UsersModel::find($listData[0]->user);
			return view("lists.single",["listData"=>$listData]);
		}else{
			return view("lists.missing");
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {$this->middleware('auth');
        //$listData = DB::table("lists")->where("slug",$slug)->get()->toArray();
		$listData = ListsModel::where("slug",$slug)->get();
		if(count($listData) && $listData[0]->user === Auth::id()){
			return view("lists.edit",["listData"=>$listData]);
		}else{
			return view("lists.missing");
		}
		
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		$this->middleware('auth');
		/*
        $listData = DB::table("lists")->where("slug",$request->slug)->where("user",Auth::id())->update([
			"name"=>$request->name,
			"list"=>serialize((array)$request->list),
			"is_public"=>$request->is_public === "on",
			"active"=>$request->active === "on",
			"tags"=>serialize(explode(",",$request->tags)),
			"updated_at"=>Carbon::now()->toDateTimeString()
		]);
		*/
		//$listData = Lists
		$list = ListsModel::find($request->id);
		$list->name = $request->name;
		$list->list = serialize((array)$request->list);
		$list->is_public = $request->is_public === "on";
		$list->active = $request->active === "on";
		$list->tags = serialize(explode(",",$request->tags));
		$list->updated_at = Carbon::now()->toDateTimeString();
		$list->save();
		
		return redirect("/list/show/".$request->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {$this->middleware('auth');
		//$delete = DB::table("lists")->where("slug",$request->slug)->where("user",Auth::id())->delete();
		ListsModel::destroy($request->id);
        //echo json_encode(array("status"=>($store > 0 ? 200:400),"message"=>($store > 0 ? "Record created successfully.":"Record failed to create.")));
		return redirect("/home");
    }
}
