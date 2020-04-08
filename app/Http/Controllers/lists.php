<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
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
        $listData = DB::table("lists")->where("slug",$slug)->get()->toArray();
		if($listData[0]->user === Auth::id() || $listData[0]->active === 1 && $listData[0]->is_public === 1){
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
        $listData = DB::table("lists")->where("slug",$slug)->get()->toArray();
		
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
        $listData = DB::table("lists")->where("slug",$request->slug)->where("user",Auth::id())->update([
			"name"=>$request->name,
			"list"=>serialize((array)$request->list),
			"is_public"=>$request->is_public === "on",
			"active"=>$request->active === "on",
			"tags"=>serialize(explode(",",$request->tags)),
			"updated_at"=>Carbon::now()->toDateTimeString()
		]);
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
		$delete = DB::table("lists")->where("slug",$request->slug)->where("user",Auth::id())->delete();
        //echo json_encode(array("status"=>($store > 0 ? 200:400),"message"=>($store > 0 ? "Record created successfully.":"Record failed to create.")));
		return redirect("/home");
    }
}
