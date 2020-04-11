<?php

use Illuminate\Database\Seeder;
use App\Roles as Rolesmodel;
class rolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		RolesModel::create([
			"name"=>"Banned"
		]);
		RolesModel::create([
			"name"=>"Pending"
		]);
		RolesModel::create([
			"name"=>"User",
			"can_login"=>true,
			"can_view_others_lists"=>true,
			"can_view_own_lists"=>true,
			"can_create_list"=>true
		]);
		
		RolesModel::create([
			"name"=>"Administrator",
			"can_login"=>true,
			"can_view_others_lists"=>true,
			"can_view_own_lists"=>true,
			"can_create_list"=>true,
			"is_admin"=>true
		]);
    }
}
