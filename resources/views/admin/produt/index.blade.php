@extends('admin.layout.master')

@section('content')
<h2>All Product</h2>
<div>
    <a href="{{route('product.create')}}" class="btn btn-dark">Create New</a>
</div>
<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Remain Quantity</th>
            <th>Sale Price</th>
            <th>Buy Price</th>
            <th>is feature</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $d)
        <tr>
            <td>{{$d->name}}</td>
            <td><img src="{{asset('images/'.$d->image)}}" width="50" class="img-thumbnail" alt=""></td>
            <td>{{$d->total_quantity}}</td>
            <td>{{$d->sell_price}}</td>
            <td>{{$d->buy_price}}</td>
            <td>{{$d->is_feature}}</td>
            <td>
                <a href="{{url('/admin/set-feature/'.$d->id.'?feature=yes')}}" class="btn btn-outline-warning">
                    <i class="fas fa-heart"></i>
                </a>
                <a href="{{route('product.edit',$d->id)}}" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                </a>
                <form method="POST" class="d-inline" action="{{route('product.destroy',$d->id)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                    |
                    <a href="{{route('product-add.create').'?pid='.$d->id}}" class="btn btn-outline-success">Add
                        Product</a>
                    <a href="" class="btn btn-outline-danger">Remove Product</a>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$product->links()}}
@endsection
