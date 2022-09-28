@extends('layout.master')

@section('content')
<div class="w-80 mt-5">

    <div class="row">

        <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
            <div class="card">
                <div class="card-header bg-dark text-white">All Category</div>
                @foreach ($category as $c)
                <li class="list-group-item">
                    <a href="{{url('/products?category='.$c->slug)}}">
                        <img src="{{$c->image_url}}" width="30" alt="">
                        {{$c->en_name}}
                        <small class="float-right badge badge-dark">{{$c->product_count}}</small>
                    </a>

                </li>
                @endforeach
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card w-100 p-4">
                        <form action="">
                            <select name="category" class="btn btn-dark" id="">
                                <option value="">Choose Category</option>
                                @foreach ($category as $d)
                                <option value="{{$d->slug}}">{{$d->en_name}}</option>
                                @endforeach
                            </select>
                            <select name="brand" class="btn  btn-dark" id="">
                                <option value="">Choose Brand</option>
                                @foreach ($brand as $d)
                                <option value="{{$d->slug}}">{{$d->name}}</option>
                                @endforeach
                            </select>
                            <select name="color" class="btn  btn-dark" id="">
                                <option value="">Choose Color</option>
                                @foreach ($color as $d)
                                <option value="{{$d->slug}}">{{$d->name}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="name" class="btn  btn-white" placeholder="enter search" name=""
                                id="">
                            <input type="submit" class="btn  bg-primary" value="search" name="" id="">
                            @if(request()->has('category'))
                            <a href="{{url('/products')}}" class="btn  btn-danger">Clear</a>
                            @endif

                        </form>
                    </div>
                </div>


                <!-- products -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 product">
                    <div class="row">
                        <!-- loop product -->
                        @foreach ($product as $p)
                        <div class="col-12 col-md-4 text-center mt-2">
                            <a href="">
                                <div class="card p-2">
                                    <img src="{{$p->image_url}}" alt="" class="w-100">
                                    <b>{{$p->name}}</b>
                                    <div>
                                        <small class=" badge badge-danger"> <strike>{{$p->discount_price}}ks</strike>
                                        </small>
                                        <small class="badge bg-primary">{{$p->sell_price}}ks</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 product">
                    {{$product->links()}}
                </div>

            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{asset('/js/home.js')}}"></script>
@endsection
