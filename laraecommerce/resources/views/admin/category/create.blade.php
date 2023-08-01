@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col=md-12 ">
    <div class="card">
        <div class="card-header">
            <h3>Add Category
                <a href="{{url('admin/category/create')}}" class="btn btn-danger btn-sm text-light float-end">Back</a>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{url('admin/category')}} " method="POST"   enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control"/>
                    @error('name') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="form-control"/>
                    @error('slug') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" rows="3" class="form-control"></textarea>
                    @error('description') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control"/>
                    @error('image') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Status</label><br/>
                    <input type="checkbox" name="status"/>
                    @error('status') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"/>
                    @error('meta_title') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Keyword</label>
                    <textarea name="meta_keyword" rows="3" class="form-control"></textarea>
                    @error('meta_keyword') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Description</label>
                   <textarea name="meta_description" rows="3" class="form-control"></textarea>
                   @error('meta_description') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection