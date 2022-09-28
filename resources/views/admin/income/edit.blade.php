@extends('admin.layout.master')

@section('content')
<h2>Update Income</h2>
<div>
    <a href="{{route('income.index')}}" class="btn btn-dark">All Income List</a>
</div>
<hr>
<form action="{{route('income.update',$income->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Enter Title</label>
        <input type="text" name="title" value="{{$income->title}}" class="form-control">
    </div>
    <div class="form-group">
        <label>Enter Price</label>
        <input type="number" name="price" value="{{$income->price}}" class="form-control">
    </div>
    <div class="form-group">
        <label>Enter Description</label>
        <textarea name="description" class="form-control">{{$income->description}}</textarea>
    </div>
    <input type="submit" value="Update" class="btn btn-dark">
</form>
@endsection
