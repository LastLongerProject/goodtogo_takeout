<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Container_type extends Model
{
	protected $table = 'container_types';
	protected $fillable = ['id','type','decoration','status'];


	        public function container()
    {
        return $this->hasMany('App\Vendor');
    }
}