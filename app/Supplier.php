<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table = 'suppliers';
	public function tour(){
    	return $this->belongsToMany(Tour::class, 'tour_suppliers');
    }

}
