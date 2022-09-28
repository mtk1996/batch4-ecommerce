@extends('admin.layout.master')

@section('content')
<h2>All Income List</h2>
<div>
    <a href="{{route('income.create')}}" class="btn btn-dark">Create New</a>
</div>
<hr>

<form action="{{route('income.index')}}" method="GET">
    <input type="number" value="{{request()->page}}" name="page">
    <input type="submit" value="Go" id="">
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($income as $d)
        <tr>
            <td>{{$d->title}}</td>
            <td>
                <b class="badge badge-success">{{$d->price}} ks</b>
            </td>
            <td>{{$d->description}}</td>
            <td>
                <a href="{{route('income.edit',$d->id)}}" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                </a>
                <form method="POST" onsubmit="return confirm('Sure?')" action="{{route('income.destroy',$d->id)}}"
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

{{$income->links()}}
@endsection
