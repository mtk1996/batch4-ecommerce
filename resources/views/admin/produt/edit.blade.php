@extends('admin.layout.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div>
    <h3>Create Project</h3>
    <a href="{{route('product.index')}}" class="btn btn-dark" href="{{route('product.index')}}">All Product</a>
</div>
<hr>
<form method="POST" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h3>Product Info</h3>
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" name="name" value="{{$product->name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{asset('/images/'.$product->image)}}" width="150" class="img-thumbnail" alt="">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Description</label>
                        <textarea id="description" name="description">{{$product->description}}</textarea>
                    </div>
                </div>
            </div>

            {{-- pricing --}}
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Enter Sale Price</label>
                        <input type="number" class="form-control" value="{{$product->sell_price}}" name="sale_price">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Discount Price</label>
                        <input type="number" class="form-control" value="{{$product->discount_price}}"
                            name="discount_price">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">choose Brand</label>
                        <select class="form-select" name="brand_id" id="brand">
                            @foreach ($brand as $d)
                            <option @if($d->id == $product->brand_id)
                                selected
                                @endif
                                value="{{$d->id}}">{{$d->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">choose Category</label>
                        <select name="category_id" id="category">
                            @foreach ($category as $d)
                            <option @if($d->id == $product->category_id)
                                selected
                                @endif

                                value="{{$d->id}}">{{$d->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">choose color</label>
                        <select name="color_id[]" multiple id="color">
                            @foreach ($color as $d)
                            <option @foreach ($product->color as $pc)
                                @if($pc->id == $d->id)
                                selected
                                @endif
                                @endforeach
                                value="{{$d->id}}">{{$d->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" value="Update" class="btn btn-danger">

                </div>
            </div>
        </div>
    </div>
</form>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function(){
        $('#description').summernote();
        $('#supplier').select2();
        $('#brand').select2();
        $('#category').select2();
        $('#color').select2();
    })
</script>
@endsection
