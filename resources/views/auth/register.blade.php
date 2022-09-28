@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Register
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('/register')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Enter Your Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Enter Your Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Enter Your Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Choose Profile Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <input type="submit" value="Register" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
