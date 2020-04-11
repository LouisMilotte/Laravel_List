<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EloquentUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->integer("role")->default(1);
        });
		
		Schema::table('roles',function (Blueprint $table){
			$table->boolean("can_login")->default(0);
			$table->boolean("is_admin")->default(0);
			$table->boolean("can_create_list")->default(0);
			$table->boolean("can_view_others_lists")->default(0);
			$table->boolean("can_view_own_lists")->default(0);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
