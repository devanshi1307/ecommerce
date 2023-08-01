@extends('layouts.admin')

@section('content')


<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="mb-4">My Orders</h4>
                   <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Filter By Date</label>
                            <input type="date" name="date" id="{{Request::get('date') ?? date('y-m-d') }}" class="form-control"/>
                        </div>
                        <div class="col-md-3">
                            <label>Filter By status</label>
                            <select name="status" class= "form-select">
                                <option value="">Select All Status</option>
                                <option value="in progress">In Progress</option>
                                <option value="completed">completed</option>
                                <option value="pending">pending</option>
                                <option value="cancled">cancled</option>
                                <option value="out-for-delevery">Out for delevery</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br/>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                        
                    </div>
                   </form>
                   <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-stripe ">
                                <thead>
                                    <tr>
                                    <th>Order ID</th>
                                    <th>Tracking No</th>
                                    <th>Username</th>
                                    <th>Payment Mode</th>
                                    <th>Ordered Date</th>
                                    <th>Status Message</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->tracking_no}}</td>
                                            <td>{{$item->fullname}}</td>
                                            <td>{{$item->payment_mode}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>{{$item->status_message}}</td>
                                            <td><a href="{{url('/admin/orders/'.$item->id)}}" class="btn btn-primary btn-sm">View</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Orders Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                        </table>
                        <div>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection