<?php

namespace App\Http\Livewire\Frontend\Product;
use App\Models\Cart;
use Livewire\Component;
use App\Models\ProductColor;
use App\Models\Wishlist;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class View extends Component
{

    public $category, $product, $prodColorSelectQuantity, $quantityCount=1, $productColorId;
    public function addToWishlist($productId)
    {
        if(Auth::check())
        {
            if(Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists())
            {
                session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', 
                [
                    'text' => 'Already added to wishlist',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            }
            else
            {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message','wishlist Added successfully');
                $this->dispatchBrowserEvent('message', 
                [
                    'text' => 'wishlist Added successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        }
        else
        {
            session()->flash('message','Please login to continue');
            $this->dispatchBrowserEvent('message', 
            [
                'text' => 'Plesase login to continue',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }




    public function colorSelected($productColorId)
    { //dd('product'); 
       $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        $this->prodColorSelectQuantity = $productColor->quantity ;

        if( $this->prodColorSelectQuantity == 0){
            $this->prodColorSelectQuantity = 'outOfStock';
        }

    }              




        public function decrementQuantity()
        {
            if( $this->quantityCount > 1){
                $this->quantityCount--;
            }
           
        }

        public function incrementQuantity()
        {
            if( $this->quantityCount < 10){
                $this->quantityCount++;
            }
           
        }

        public function addToCart(int $productId)
        {
            if(Auth::check())
            {
                if($this->product->where('id', $productId)->where('status',0)->exists())
                {
                    if($this->product->productColors()->count()>1)
                    {
                       if($this->prodColorSelectQuantity !=NULL)
                       {
                            if(Cart::where('user_id', auth()->user()->id)
                                    ->where('product_id', $productId)
                                    ->where('product_color_id', $this->productColorId)

                                    ->exists() )
                                    {
                                        $this->dispatchBrowserEvent('message',[
                                            'text' => 'product already added to cart',
                                            'type' => 'warning',
                                            'status' => 200
                                        ]);
                                    }
                                    else{
                                         $productColor = $this->product->productColors()->where('id',$this->productColorId)->first();
                                    if( $productColor->quantity > 0)
                                        {
                                        if($productColor->quantity > $this->quantityCount)
                                        {
                                            Cart::create([
                                             'user_id'=>auth()->user()->id,
                                             'product_id'=> $productId,
                                             'product_color_id'=> $this->productColorId,
                                             'quantity'=> $this->quantityCount
                                            ]);
                                            $this->emit('CartAddedUpdated');
                                            $this->dispatchBrowserEvent('message',[
                                             'text' => 'product added to cart',
                                             'type' => 'success',
                                             'status' => 200
                                            ]);

                                        }
                                    else
                                    {
                                $this->dispatchBrowserEvent('message',[
                                    'text' => 'only'.$productColor->quantity . 'quantity avaliable',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
    
                                    }

                                }
                            else
                                {
                                $this->dispatchBrowserEvent('message',[
                                'text' => 'Out of stock',
                                'type' => 'warning',
                                'status' => 404
                                ]);
                                }
                            }
                        }
                       else
                       {
                        $this->dispatchBrowserEvent('message',[
                            'text' => 'select your product color',
                            'type' => 'info',
                            'status' => 404
                        ]);
                       }
                    }
                    else
                    {
                        if(Cart::where('user_id',auth()->user()->id)->where('product_id', $productId    )->exists())
                        {
                            $this->dispatchBrowserEvent('message',[
                                'text' => 'product already added to cart',
                                'type' => 'warning',
                                'status' => 200
                            ]);
                        }
                        else
                        {
                            if($this->product->quantity > 0)
                            {
                            if($this->product->quantity > $this->quantityCount)
                            {
                                Cart::create([
                                    'user_id'=>auth()->user()->id,
                                    'product_id'=> $productId,
                                    'quantity'=> $this->quantityCount
                                ]);
                                $this->emit('CartAddedUpdated');
                                $this->dispatchBrowserEvent('message',[
                                    'text' => 'product added to cart',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            }
                            else
                            {
                                $this->dispatchBrowserEvent('message',[
                                    'text' => 'only'.$this->product->quantity . 'quantity avaliable',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
    
                            }
                            }
                            else
                            {
                            $this->dispatchBrowserEvent('message',[
                                'text' => 'Out of stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                             }

                        }
                        
                    }

                
                }
                else
                {
                    
                    $this->dispatchBrowserEvent('message',[
                        'text' => 'Product does not exists',
                        'type' => 'warning',
                        'status' => 404
                    ]);
                }
            }
            else
            {
                $this->dispatchBrowserEvent('message',[
                    'text' => 'please login to add to cart',
                    'type' => 'info',
                    'status' => 401
                ]);
            }
        }




    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }




    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' =>$this->category,
            'product' =>$this->product
        ]);
    }
}
