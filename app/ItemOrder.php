<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    //
    protected $table = 'tbl_order_item';

    public function tour(){ 
        return $this->belongsTo(Tour::class);
    }
   
}
