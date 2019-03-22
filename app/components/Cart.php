<?php
namespace App\components;
/**
* 
*/
class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	function __construct($oldItem){
		if ($oldItem) {
			$this->items = $oldItem->items;
			$this->totalQty = $oldItem->totalQty;
			$this->totalPrice = $oldItem->totalPrice;
		}
	}

	public function add($item, $id){
		$storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
		if ($this->items) {
			if (array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}
		$storedItem['qty']++;
		$storedItem['price'] = $item->price * $storedItem['qty'];
		$storedItem[$id] = $storedItem;
		$this->totalQty++;
		$this->totalPrice += $item->price;
	}


	public static function totalCartQty(){
        $carts = Session()->get('cart');
        $cartTotal = 0;  
        if ( empty($carts) ) {
            return null;
        }else{
            foreach ($carts->items as $cart) {  
                $cartTotal = isset($cartTotal) && $cartTotal > 0 ? $cartTotal + $cart['qty'] : 0;     
            }
            return $cartTotal;
        }
    }
}