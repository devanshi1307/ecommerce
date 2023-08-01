<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
public $carts, $totalProductAmount = 0;

public $fullname, $email, $phone, $pincode, $address, $payment_id=NULL, $payment_mode = NULL;

    protected $listeners =[
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];


    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = "Paid by paypal";

        $codOrder = $this->placeOrder();
      if($codOrder)
      {
        Cart::where('user_id', auth()->user()->id)->delete();
        $this->dispatchBrowserEvent('message',[
            'text'=> 'order placed successfully',
            'type'=> 'success',
            'status'=>200,
        ]);
        return redirect()->to('thank-you');
      }
      else
      {
        $this->dispatchBrowserEvent('message',[
            'text'=> 'something went wrong',
            'type'=> 'error',
            'status'=>500,
        ]);

      }

    }

    public function validationForAll()
    {
        $this->validate();
    }




    public function rules()
    {
        return[

            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|min:10|max:11',
            'pincode' => 'required|string|min:6|max:6',
            'address' => 'required|string|max:500',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' =>'shopi-'.Str::random(10),
            'fullname'=> $this->fullname,
            'email'=> $this->email,
            'phone'=> $this->phone,
            'pincode'=> $this->pincode,
            'address'=> $this->address,
            'status_message'=> 'in progress',
            'payment_mode'=> $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);
        foreach($this->carts as $cartItem){
              Orderitem::create([
                'order_id' =>$order->id,
                'product_id' =>$cartItem->product_id,
                'product_color_id'=>$cartItem->product_color_id,
                'quantity'=>$cartItem->quantity,
                'price'=>$cartItem->product->selling_price,
            ]);
            $this->totalProductAmount +=$cartItem->product->selling_price*$cartItem->quantity;
        }
        return  $order;
       
    }



    public function codOrder()
    {
      $this->payment_mode = 'Cash On Delivery';
      $codOrder = $this->placeOrder();
      if($codOrder)
      {
        Cart::where('user_id', auth()->user()->id)->delete();
        $this->dispatchBrowserEvent('message',[
            'text'=> 'order placed successfully',
            'type'=> 'success',
            'status'=>200,
        ]);
        return redirect()->to('thank-you');
      }
      else
      {
        $this->dispatchBrowserEvent('message',[
            'text'=> 'something went wrong',
            'type'=> 'error',
            'status'=>500,
        ]);

      }

    }
    public function totalProductAmount()
    {
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach($this->carts as $cartItem){
            $this->totalProductAmount +=$cartItem->product->selling_price*$cartItem->quantity;
        }
        return $this->totalProductAmount;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
