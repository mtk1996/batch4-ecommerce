@extends('admin.layout.master')

@section('content')
<h2>Edit Supplier</h2>
<div>
    <a href="{{route('supplier.index')}}" class="btn btn-dark">All Supplier</a>
</div>
<hr>
<form action="{{route('supplier.update',$data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Enter Name</label>
        <input type="text" name="name" value="{{$data->name}}" class="form-control">
    </div>
    <div class="form-group">
        <label>Enter Phone</label>
        <input type="number" name="phone" value="{{$data->phone}}" class="form-control">
    </div>
    <div class="form-group">
        <label>Choose Image</label>
        <input type="file" name="image" class="form-control">
        <img src="{{asset('/images/'.$data->image)}}" width="200" class="img-thumbnail">
    </div>
    <div class="form-group">
        <label>Enter Description</label>
        <textarea name="description" class="form-control">{{$data->description}}</textarea>
    </div>
    <input type="submit" value="Update" class="btn btn-dark">
</form>
@endsection
