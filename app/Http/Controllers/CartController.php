<?php

namespace App\Http\Controllers;


use App\Cart;
use Illuminate\Http\Request;
use App\User;
use App\Tour;
use Session;
use Validator;
use App\ItemOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterCustomer;
use App\Mail\CustomerPaid;
use App\Customer;
use App\Invoice;
use App\Wishlist;



class CartController extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function addTocart(Request $request, $id)
    {
        $tour    = Tour::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->addToCart($tour, $id);
        $request->session()->put('cart', $cart);
        Auth::check()? Wishlist::addWishlist($id):'';        
        return back()->with(['message'=>'has been added to your cart...!','get'=>'success']);
    }

    public function updateCart(Request $request, $id)
    {
        $tour    = Tour::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->EditCart($tour, $id, $request);
        $request->session()->put('cart', $cart);
        \Auth::check() ? Wishlist::updateWishlist($id, $request) : '';
        return redirect()->back()->with(['message'=>'your cart is has been update...!','get'=>'success']);
        
    }

    public function getCart(Request $reqest)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;     
        $cart    = new Cart($oldCart);        
        return view('cart.shopping-cart', ['tours_cart' => $cart->items]);
    }

    public function removeCart(Request $request, $id)
    {
        // return $id;
        if (Session::has('cart') ) {
            $session = Session::get('cart');
            unset($session->items[$id]);
            \Auth::check() ? Wishlist::delWishlist($id) : '';
        }
        return redirect()->back();
    }

    public function getChechout(Request $req)
    {
        if (Auth::check()) {
          return redirect()->route('index');
        } else if(isset($req->key) && !empty($req->key)){
            $user = User::where("md5", $req->key)->first();
            $user->banned = 0;
            $user->save();
        }
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);
        return view('cart.checkout', ['tours' => $cart->items]);
    }

    public function getCheckAccount(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'passport_number' => 'required',
            'address_street'  => 'required',
            'first_name'      => 'required',
            'last_name'       => 'required',
            'nationality'     => 'required',
            'town_city'       => 'required',
            'expiry_date'     => 'required',
            'country_state'   => 'required',
            'phone_number'    => 'required',
            'email'           => 'required',
            'password'        => 'required',
        ]);
        if (!$validator->fails()) {
            if (User::getExitEmail($req->email)) {
                return back()->withErrors($validator)->withInput()->with('message', 'Your email is already exists');
            } else {
                $cus = new User;
                $cus->name          = $req->first_name;
                $cus->last          = $req->last_name;
                $cus->fullname      = $req->first_name." ".$req->last_name;                
                $cus->passport      = $req->passport_number;
                $cus->md5           = md5($req->email);
                $cus->expiry_date   = $req->expiry_date;
                $cus->address       = $req->address_street;
                $cus->province_id   = $req->town_city;
                $cus->country_id    = $req->country_state;
                $cus->nationality   = $req->nationality;
                $cus->phone         = $req->phone_number;
                $cus->email         = $req->email;
                $cus->postal        = $req->zip_code;
                $cus->role_id       = 7;
                $cus->banned        = 1; //= 1 = inactive, 0 = active;
                $cus->password      = bcrypt($req->password);
                $cus->password_text = $req->password;
                $cus->picture       = 'me.png';
                $cus->save();
                Mail::to($req->email)->send(new RegisterCustomer());
                return back()->with(['get'=> 'success',  'message'=> "Link has been sent to your email: ". $req->email]);
            }
        }else{
            return back()->withErrors($validator)->withInput();
        }
    }

    public function Login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email_log'    => 'required|email',
            'password_log' => 'required|min:6'
        ]);

        if (!$validator->fails() ) {
            if (\Auth::attempt(['email'=>$req->email_log, 'password'=>$req->password_log, 'banned'=>0])) {
                $itemWish = Wishlist::where('user_id', \Auth::user()->id)->get();
                $oldCart  = Session::has('cart') ? Session::get('cart') : null;
                if ($itemWish->count() > 0) {
                    foreach ($itemWish as $key => $data) {
                        $synData = Tour::find($data['tour_id']);                   
                        $cart    = new Cart($oldCart);
                        $cart->Synchronize($synData, $data->item_qty, $synData->id);
                        $req->session()->put('cart', $cart);
                    }
                } else {
                    if (Session::has('cart')) {
                        foreach (Session::get('cart')->items as $key => $cart) {
                            $addWish           = new Wishlist;
                            $addWish->user_id  = Auth::user()->id;
                            $addWish->tour_id  = $cart['item']['id'];
                            $addWish->item_qty = $cart['qty'];
                            $addWish->save();
                        }
                    }                    
                }

                if( Cart::totalCartQty() > 0){
                    return redirect()->route('getCart');
                }else{
                    return redirect()->route('index');
                }
            }else{
                return "Fdsafdsafd";        
            }
            

        } else {
            return back()->withErrors($validator)->withInput()->with('loginError', 'Your email is not exists');
        }
    }

    public function getPayment() {
        if (empty(Session::get('cart')->items)) {
            return redirect('shopping-cart');
        } else {
            $userId  = Auth::user()->id;
            $oldcart = Session::get('cart');
            $cart    = new Cart($oldcart);
            return view('checkout.payment', ['carts' => $cart->items, 'userId' => $userId]);
        }
    }

    public function linkPayment()
    {
        return view('payment.php_vpc_party_do');
    }

    public function getReturn(Request $req)
    {
        if ($req->vpc_TxnResponseCode == '0') {
            $amount                     = substr($req->vpc_Amount, 0, -2);
            $inv                        = new Invoice;
            $inv->merchant_transaction  = $req->vpc_MerchTxnRef;
            $inv->merchant_id           = $req->vpc_Merchant;
            $inv->order_info            = $req->vpc_OrderInfo;
            $inv->amount                = $amount;
            $inv->locale                = $req->vpc_Locale;
            $inv->invoice_number        = $req->vpc_MerchTxnRef;
            $inv->transaction_number    = $req->vpc_TransactionNo;
            $inv->bank_authorization_id = $req->vpc_MerchTxnRef;
            $inv->batch_number          = $req->vpc_BatchNo;
            $inv->card_type             = $req->vpc_Card;
            $inv->customer_id           = $req->vpc_OrderInfo; //get customer Id when customer login
            if ($inv->save()){ 
                $oldcart = Session::get('cart');
                $cart    = new Cart($oldcart);
                foreach ($cart->items as $key => $item) {
                    $ord                 = new ItemOrder;
                    $ord->item_id        = $item['item']['tour_id'];
                    $ord->item_qty       = $item['qty'];
                    $ord->price          = $item['item']['tour_price'];
                    $ord->invoice_number = $req->vpc_MerchTxnRef;
                    $ord->customer_id    = $req->vpc_OrderInfo;
                    $ord->created_at     = date('Y-m-d H:m:s');
                    $ord->updated_at     = date('Y-m-d H:m:s');
                    if ($ord->save()) {
                        Mail::to(config('app.email'))->send(new CustomerPaid());
                        Session::forget('cart');
                        Wishlist::clearWishlist($req->vpc_OrderInfo);
                    }
                }
            }
            return redirect()->route('check.invoice', ['inv_id' => $req->vpc_MerchTxnRef]);
        } else if ($req->vpc_TxnResponseCode == '3') {
            return view('payment.transaction_fails', ['message' => '! No Reply from Bank']);
        } else if ($req->vpc_TxnResponseCode == '4') {
            return view('payment.transaction_fails', ['message' => '! Your Credit card is has expired ']);
        } else if ($req->vpc_TxnResponseCode == 'U') {
            return view('payment.transaction_fails', ['message' => '! Please verification your card security code']);
        } else if ($req->vpc_TxnResponseCode == 'I') {
            return view('payment.transaction_fails', ['message' => '! Your card security code verification failed']);
        } else {
            return view('payment.transaction_fails', ['message' => '! Your payment transaction is fails']);
        }
    }

    public function getInvoice(Request $req)
    {
        return view('payment.invoice');
    }

    public function getReturnFails()
    {
        return view('payment.transaction_fails');
    }
}
