@extends('layouts.app')

@section('title', 'thank you')

@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="p-4 shadow bg-white">
                    <h2>you</h2>
                    <h4>Thank You for shopping with us</h4>
                    <a href="{{url('collections')}}" class="btn btn-primary">Shop more</a>
                </div>
                </div>
        </div>
    </div>
</div>


@endsection