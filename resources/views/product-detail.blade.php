@extends('layout.master')

@section('content')

<div class="w-80 mt-5">

    <div class="row">

        <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
            <div class="card">
                <div class="card-header bg-dark text-white">All Category</div>
                @foreach ($category as $c)
                <li class="list-group-item">
                    <img src="{{$c->image_url}}" width="30" alt="">
                    {{$c->mm_name}}
                    <small class="float-right badge badge-dark">{{$c->product_count}}</small>
                </li>
                @endforeach

            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            {{-- react component --}}
            <div class="card p-4" id="root">

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const product_slug = "{{$slug}}";
</script>
<script src="{{asset('/js/product-detail.js')}}"></script>
@endsection
