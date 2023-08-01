@extends('layouts.admin')

@section('content')
<div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                    @if(session('message'))
                      <h2 class="alert-alert-success">{{session('message')}}</h2>
                    @endif
                    <p class="mb-md-0">Your analytics dashboard template.</p>
                    
                  </div>
                

                </div>
                
              </div>
              <hr>
              <div class="row">
                  <div class="col-md-3">
                  <div class="card card-body bg-primary text-white mb-3">
                    <label>Total Orders</label>
                    <h1>{{$totalOrder}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="card card-body bg-warning text-white mb-3">
                    <label>Today Orders</label>
                    <h1>{{$todayOrder}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="card card-body bg-danger text-white mb-3">
                    <label>This month Orders</label>
                    <h1>{{$thisMonthOrder}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="card card-body bg-success text-white mb-3">
                    <label>This year Orders</label>
                    <h1>{{$thisYearOrder}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                  </div>
                  </div>

                  <hr>
                  <div class="col-md-3">
                  <div class="card card-body bg-danger text-white mb-3">
                    <label>Total Products</label>
                    <h1>{{$totalProducts}}</h1>
                    <a href="{{url('admin/products')}}" class="text-white">View</a>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="card card-body bg-success text-white mb-3">
                    <label>Total Brands</label>
                    <h1>{{$totalBrands}}</h1>
                    <a href="{{url('admin/brands')}}" class="text-white">View</a>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="card card-body bg-primary text-white mb-3">
                    <label>Total Categories</label>
                    <h1>{{$totalCategories}}</h1>
                    <a href="{{url('admin/category')}}" class="text-white">View</a>
                  </div>
                  </div>

                  <hr>
                  <div class="col-md-3">
                  <div class="card card-body bg-success text-white mb-3">
                    <label>All Users</label>
                    <h1>{{$totalAllUsers}}</h1>
                    <a href="#" class="text-white">View</a>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="card card-body bg-primary text-white mb-3">
                    <label>Total users</label>
                    <h1>{{$totalUser}}</h1>
                    <a href="#" class="text-white">View</a>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="card card-body bg-warning text-white mb-3">
                    <label>Total admins</label>
                    <h1>{{$totalAdmin}}</h1>
                    <a href="#" class="text-white">View</a>
                  </div>
                  </div>
              </div>
              
    </div>
</div>
@endsection