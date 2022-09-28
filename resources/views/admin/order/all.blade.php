@extends('admin.layout.master')

@section('content')
<h2>Your Order List</h2>
<div>
    <a href="{{url('/admin/order?status=pending')}}" class="btn btn-sm btn-warning">Pending</a>
    <a href="{{url('/admin/order?status=success')}}" class="btn btn-sm btn-success">Success</a>
    <a href="{{url('/admin/order?status=reject')}}" class="btn btn-sm btn-danger">Reject</a>
</div>


<table class="table table-striped mt-2">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Total Quantity</th>
            <th>Delivery Info</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order as $o)
        <tr>
            <td><img src="{{$o->product->image_url}}" width="70px" class="img-thumbnail"></td>
            <td>{{$o->product->name}}</td>
            <td>{{$o->total_quantity}}</td>
            <td>
                <table class="border border-dark">
                    <tr>
                        <td>Payment Address</td>
                        <td>Phone</td>
                        <td>Address</td>
                    </tr>
                    <tr>
                        <td>{{$o->payment}}</td>
                        <td>{{$o->phone}}</td>
                        <td>{{$o->address}}</td>
                    </tr>

                </table>
            </td>
            <td>
                <?php
                    if($o->status=='success'){
                        $status="success";
                    }
                    if($o->status=='reject'){
                        $status="danger";
                    }
                    if($o->status=='pending'){
                        $status="warning";
                    }

                ?>
                <span class="badge badge-{{$status}}">{{$o->status}}</span>
            </td>
            <td>
                <a href="{{url('/admin/change-order-status/success?id='.$o->id)}}" class="btn btn-sm btn-success">Set
                    Success</a>
                <a href="{{url('/admin/change-order-status/reject?id='.$o->id)}}" class="btn btn-sm btn-danger">Set
                    Reject</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

{{$order->links()}}
@endsection
