@extends('layouts.app')

@section('title', 'Search Product')

@section('content')

<div class="py-5 ">
  <div class="container">
    <div class="row justify content-center">
      <div class="col-md-12">
            <h4>Search Reasult</h4>
            <div class="underline mb-4"></div>
      </div>
      
      

            @forelse($searchProducts as $productItem)

        <div class="col-md-10">
            <div class="product-card">
                <div class="row ">
                    <div class="col-md-3">
                    <div class="product-card-img">
                           <label class="stock bg-success">New</label>

                           @if($productItem->productImages->count()>0)
                           <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                            <img src="{{asset($productItem->productImages[0]->image) }}" alt="{{$productItem->name}}">
                           </a>
                           @endif
                        </div>
                    </div>
                    <div class="col-md-9">
                    <div class="product-card-body">
                            <!-- <p class="product-brand">HP</p> -->
                            <h5 class="product-name">
                               <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                   {{$productItem->name}}
                               </a>
                            </h5>
                            <div>
                                <span class="selling-price">${{$productItem->selling_price}}</span>
                                <span class="original-price">${{$productItem->orignal_price}}</span>
                            </div>
                            <p style="height: 45px; overflow:hidden">
                                <b>description: </b>{{$productItem->description}}
                            </p>
                            <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}"
                             class="btn btn-outline-primary">
                             View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         @empty
            <div class="col-md-12 p-2">
                <h4>No Product found</h4>
            </div>
        @endforelse         
    </div>
  </div>
</div>

@endsection