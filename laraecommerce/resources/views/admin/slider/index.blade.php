@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col=md-12 ">
        @if(session('message'))
            <div class="alert alert success">{{session('message')}}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Sliders List
                <a href="{{url('admin/sliders/create')}}" class="btn btn-primary btn-sm text-light float-end">Add Slider</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Slider</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $slider)
                        <tr>
                            <td>{{$slider->id}}</td>
                            <td>{{$slider->title}}</td>
                            <td>{{$slider->description}}</td>
                            <td>
                                <img src="{{ asset("$slider->image")}}" style="width: 70px; height: 70px;" alt="slider">
                            </td>
                            <td>{{$slider->status == '0' ? 'visible':'hidden'}}</td>
                            <td>
                                <a href="{{url('admin/sliders/'.$slider->id. '/edit')}}" class="btn btn-success">Edit</a>
                                <a href="{{url('admin/sliders/'.$slider->id. '/delete')}}"
                                onclick="return confirm('Are you sure you want to delete?');"
                                 class="btn btn-danger">
                                 Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection