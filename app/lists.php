<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lists extends Model
{
    protected $table = "lists";
	
	
	public function tags(){
		return $this->hasMany("App\Listtags");
	}
}
