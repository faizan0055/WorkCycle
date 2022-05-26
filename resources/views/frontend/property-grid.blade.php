@extends('frontend.layouts.app')
@section('content')

  <main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single">Our Amazing Properties</h1>
              <span class="color-text-a">Grid Properties</span>
            </div>
          </div>
          <div class="col-md-12 col-lg-4">
            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Properties Grid
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section><!-- End Intro Single-->

    <!-- ======= Property Grid ======= -->
    <section class="property-grid grid">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="grid-option">
{{--              <form>--}}
{{--                <select class="custom-select">--}}
{{--                  <option selected>All</option>--}}
{{--                  <option value="1">New to Old</option>--}}
{{--                  <option value="2">For Rent</option>--}}
{{--                  <option value="3">For Sale</option>--}}
{{--                </select>--}}
{{--              </form>--}}
            </div>
          </div>
            @foreach($properties as $pro)
          <div class="col-md-4">
            <div class="card-box-a card-shadow">
              <div class="img-box-a">
                <img src="{{asset('images/properties/'.$pro->image)}}" alt="" class="img-a img-fluid">
              </div>
                <div class="card-overlay">
                    <div class="card-overlay-a-content">
                        <div class="card-header-a">
                            <h2 class="card-title-a">
                                <a href="{{route('property.single')}}">{{$pro->name}}
                                </a>
                            </h2>
                            <p class="text-white">{{$pro->description}}</p>
                        </div>
                        <div class="card-body-a">
                            <div class="price-box d-flex">
                                <span class="price-a">{{$pro->type}} | {{$pro->price}} PK</span>
                            </div>
                        </div>
                        <div class="card-footer-a">
                            <ul class="card-info d-flex justify-content-around">
                                <li>
                                    <h4 class="card-info-title">Area</h4>
                                    <span>{{$pro->size}}
                            <sup>2</sup>
                          </span>
                                </li>
                                <li>
                                    <h4 class="card-info-title">Beds</h4>
                                    <span>{{$pro->bed}}</span>
                                </li>
                                <li>
                                    <h4 class="card-info-title">Baths</h4>
                                    <span>{{$pro->washroom}}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </div>
            @endforeach

        </div>

      </div>
    </section><!-- End Property Grid Single-->

  </main><!-- End #main -->
@endsection

