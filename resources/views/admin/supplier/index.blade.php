@extends('admin.layout.master')

@section('content')
<h2>All Supplier</h2>
<div>
    <a href="{{route('supplier.create')}}" class="btn btn-dark">Create New</a>
</div>
<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Image</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>{{$d->name}}</td>
            <td>{{$d->phone}}</td>
            <td>
                <img src="{{asset('images/'.$d->image)}}" class="img-thumbnail" width="90" alt="{{$d->name}}">
            </td>
            <td>{{$d->description}}</td>
            <td>
                <a href="{{route('supplier.edit',$d->id)}}" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                </a>
                <form method="POST" onsubmit="return confirm('Sure?')" action="{{route('supplier.destroy',$d->id)}}"
                    class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection
