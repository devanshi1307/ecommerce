@extends('layouts.app')

@section('title', 'All Categories')

@section('content')

<div>
    <livewire:frontend.product.view :category="$category" :product="$product" />
</div>

@endsection