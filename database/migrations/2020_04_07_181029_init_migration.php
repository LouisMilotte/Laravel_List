<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('userRoles', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
			$table->integer('role');
            $table->timestamps();
        });
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
			$table->text('list');
			$table->boolean("active")->default(0);
			$table->boolean("public")->default(1);
			$table->text("tags");
            $table->timestamps();
        });
		
		Schema::create("listTags",function(Blueprint $table){
			$table->id();
			$table->string("name");
			$table->boolean("active");
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('userRoles');
        Schema::dropIfExists('lists');
        Schema::dropIfExists('listTags');
    }
}
