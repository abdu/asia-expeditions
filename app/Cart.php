<?php
namespace App;
/**
* 
*/
class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldItem){
		if ($oldItem) {
			$this->items = $oldItem->items;
			$this->totalQty = $oldItem->totalQty;
			$this->totalPrice = $oldItem->totalPrice;
		}
	}

	public function addToCart($item, $id){

		$storedItem = ['qty' => 0, 'price' => $item->tour_price, 'itemId' => $item->tour_id, 'item' => $item];
		if ($this->items) {
			if (array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}
		$storedItem['qty']++;
		$storedItem['price'] = $item->tour_price * $storedItem['qty'];
		$this->items[$id] = $storedItem;
		$this->totalQty++;
		$this->totalPrice += $item->tour_price;
	}

	public function EditCart($item, $id, $req){
		$name = 'txtqty_'.$id;
		$txtqty = $req->$name;
		$storedItem = ['qty' => 0, 'price' => $item->tour_price, 'itemId' => $item->tour_id,'item' => $item];
		if ($this->items) {
			if (array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}

		$storedItem['qty'] = $txtqty;
		$storedItem['price'] = $item->tour_price * $storedItem['qty'];
		$this->items[$id] = $storedItem;
		$this->totalQty + $txtqty;
		$this->totalPrice += $item->tour_price;
	}

	public function Synchronize($item,$qty, $id){
    	
    	$storedItem = ['qty' => 0, 'price' => $item->tour_price, 'itemId' => $item->tour_id, 'item' => $item];
		if ($this->items) {
			if (array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}

		$storedItem['qty'] = $qty;
		$storedItem['price'] = $item->tour_price * $storedItem['qty'];
		$this->items[$id] = $storedItem;
		$this->totalQty + $qty;
		$this->totalPrice += $item->tour_price;
		
    }
}