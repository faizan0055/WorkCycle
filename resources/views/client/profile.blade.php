    @extends('layouts.app')
@section('title','Profile')
@section('profile_nav', 'active')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row  justify-content-center">
                <div class="col-md-12 mt-5">
                    <div class="row py-5" style="background-image: url({{asset('images/restaurant_images/').'/'.$restaurant->cover_image}}); background-size: cover; background-repeat: no-repeat; background-position: center; ">
                        <div class="col-md-1">
                            <img src="{{asset('images/restaurant_images/').'/'.$restaurant->logo}}" class="w-100 rounded" alt="logo">
                        </div>
                        <div class="col-md-8 text-white">
                            <h3>{{$restaurant->name}}</h3>
                            <h5>{{$restaurant->slogan}}</h5>
                            <p>{{$restaurant->address}}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-8 pl-0">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4>Order Management</h4>
                                    <hr>
                                    <h5>Delivery Settings</h5>
                                    <h6><b>Estimated Time</b></h6>
                                    <p>{{$restaurant->avg_delivery_time}} mins</p>
                                    <h6><b>Estimated Charges</b></h6>
                                    <p>$ {{$restaurant->delivery_charges}}</p>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <h4>Min Order</h4>
                                    <hr>
                                    <h6><b>Min Order Limit</b></h6>
                                    <p>{{$restaurant->min_order}} orders</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pr-0">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4>Public Profile</h4>
                                    <a href="{{route('client.edit_profile',$restaurant->id)}}"><p><i class="fa fa-pencil-alt"></i> Edit Profile</p></a>
                                    <h5>About us</h5>
                                    @if($restaurant->description)
                                    <p>{{$restaurant->description}}</p>
                                    @else
                                    <p>You have not provided a descrription about your client</p>
                                    @endif
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4>Contact</h4>
                                    <p class="text-muted">This contact is used for contacting client.</p>
                                    <p><i class="fa fa-phone-alt"></i> {{$restaurant->phone}}</p>
                                    <p><i class="fa fa-envelope"></i> {{$restaurant->email}}</p>
                                    <p><i class="fa fa-map-marker-alt"></i> {{$restaurant->address}}</p>
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4>Account Details</h4>
                                    <p class="text-muted">This is your account details.</p>
                                    <h6><b>Account Name</b></h6>
                                    <p>{{$restaurant->account_name}}</p>
                                    <h6><b>Account Number</b></h6>
                                    <p>{{$restaurant->account_number}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
