<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User as UsersModel;
class userSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new UsersModel;
		$user->name = "admin";
		$user->email = "admin@localhost.com";
		$user->active = 1;
		$user->email_verified_at = date("d/m/Y h:i:s",time());
		$user->password = Hash::make("admin");
		$user->created_at = date("d/m/Y h:i:s",time());
		$user->updated_at = date("d/m/Y h:i:s",time());
		$user->role = 1;
		$user->save();
		
    }
}
