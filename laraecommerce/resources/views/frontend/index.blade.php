@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide">
 
<div id="carouselExampleCaptions" class="carousel slide">
  
  <div class="carousel-inner">
  
  @foreach($sliders as $key => $sliderItem)
 
    <div class=" carousel-item {{$key == 0 ? 'active': ''}} ">
    @if($sliderItem->image)
        <img src="{{asset("$sliderItem->image")}}" width="100%"  height="400px"  alt="...">
    @endif
                <div class="carousel-caption d-none d-md-block"> 
                    <div class="custom-carousel-content">
                        <h1>
                        {!!$sliderItem->title!!}
                        </h1>
                        <p>{!!$sliderItem->description!!}</p>
                        <div>
                            <a href="#" class="btn btn-slider">
                                Get Now
                            </a>
                        </div>
                    </div>
                </div>
    </div>
  
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="py-5 bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <h4>Welcome to Shopzieeee</h4>
        <div class="underline mx-auto"></div>
        <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elita quis enenenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper lc sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus n
        </p>
      </div>
    </div>
  </div>
</div>



<div class="py-5 ">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>Trending Products</h4>
        <div class="underline mb-4">

        </div>
      </div>
      @if($trendingProducts)
      <div class="col-md-12">

          <div class="owl-carousel owl-theme trending-product">
               @foreach($trendingProducts as $productItem)
                <div class="item">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if($productItem->quantity > 0)
                            <label class="stock bg-success">In Stock</label>
                           @else
                           <label class="stock bg-success">Out Of Stock</label>
                           @endif

                           @if($productItem->productImages->count()>0)
                           <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                            <img src="{{asset($productItem->productImages[0]->image) }}" alt="{{$productItem->name}}">
                           </a>
                           @endif
                        </div>
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
                        </div>
                    </div>
                </div>
               @endforeach
          </div>
              </div>
              @else
              <div class="col-md-12">
                    <div class="p-2">
                        <h4>No Product avaliable</h4>
                    </div>
              </div>
              @endif
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $('.trending-product').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
@endsection

