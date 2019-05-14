<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //
    protected $table = 'tbl_wishlist';


    public static function addWishlist($itemId){
    	$editWish = self::where('item_id', $itemId)->first();
    	$date = date('Y-m-d');
    	if ($editWish){
    		$editWish->item_qty++;  
    		$editWish->save();
    	}else{
	    	$wishlist = new self;
	    	$wishlist->user_id    = \Auth::user()->id;
	    	$wishlist->item_id    = $itemId;
	    	$wishlist->item_qty   = 1;
	    	$wishlist->created_at = $date;
	    	$wishlist->updated_at = $date;
	    	$wishlist->save();
	    }
    }

    public static function updateWishlist($itemId, $req){    	
    	$editWish = self::where('item_id', $itemId)->first();
    	$qty = 'txtqty_'.$itemId;
    	if ($editWish){
    		$editWish->item_qty = $req->$qty;
    		$editWish->save();
    	}
    }

    public static function delWishlist($itemId){

        self::where('item_id', $itemId)->delete();
    }

    public static function clearWishlist(){
        self::where('customer_id', User::getUser()->id)->delete();
    }






}
