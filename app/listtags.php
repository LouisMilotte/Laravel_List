<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listtags extends Model
{
    protected $table = "listtags";
	
	public function lists(){
		$this->hasMany("App\Lists");
	}
}
