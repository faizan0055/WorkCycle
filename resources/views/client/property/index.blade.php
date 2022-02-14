@extends('layouts.app')

@section('profile_nav', 'active')
@section('title','Profile')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Property</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Property</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach($props as $index => $prop)
                <div class="col-md-3">
                    <!-- Profile Image -->

                    <div class="card card-primary card-outline">

                        <div class="card-body box-profile">

                            <div class="text-center" >
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{url('images/properties',$prop->image)}}"
                                     alt="User profile picture">
                            </div>
                            <h5 class=" text-left"><b>Name: </b>{{$prop->name}}</h5>
                            <h5 class="profile-username text-left"><b>Price: </b>{{$prop->price}}</h5>
                            <h5 class="profile-username text-left"><b>Detail: </b>{{$prop->description}}</h5>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script>
        function logo1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
