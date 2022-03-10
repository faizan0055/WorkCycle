@extends('layouts.app')
@section('title','Property Info')
@section('user_nav', 'active')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.css')}}">
@endsection
@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Property info</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Property Info</h4>
                    </div>
                    <div class="card-body pt-0">

{{--                         <h1>Show Property</h1>--}}
{{--                        <h1>{{$property->name}}</h1>--}}
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-4">
                                <div class="testimonial-img">
                                    <img src="{{url('images/properties',$property->image)}}" alt="" class="img-fluid" style="height: 300px; width: 500px; border-radius: 5%">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div style="line-height: 10px">
                                    <h4> Property Information </h4>
                                    <p class="testimonial-text" ><span class="font-weight-bold">Name: </span>{{$property->name}}</p>
                                    <p class="testimonial-text"><span class="font-weight-bold">Category: </span>{{$property->category->name}}</p>
                                    <p class="testimonial-text"><span class="font-weight-bold">Price: </span>{{$property->price}}</p>
                                     <p class="testimonial-text"><span class="font-weight-bold">Detail: </span>{{$property->description}}</p>
                                    <p class="testimonial-text"><span class="font-weight-bold">Size: </span>{{$property->size}}</p>
                                    <p class="testimonial-text"><span class="font-weight-bold">Beds: </span>{{$property->bed}}</p>
                                    <p class="testimonial-text"><span class="font-weight-bold">Washrooms: </span>{{$property->washroom}}</p>
                                </div>
                                <div class="testimonial-author-box">
                                    <img src="{{url('images/user_profile',$property->users->image)}}" alt="" style="border-radius: 50%; height: 80px; width: 80px"><span class="ml-3 h4">Agent Info</span>
                                    <p class="testimonial-text mt-2" style="line-height: 10px"><span class="font-weight-bold">Name: </span>{{$property->users->name}}</p>
                                    <p class="testimonial-text" style="line-height: 10px"><span class="font-weight-bold">Email: </span>{{$property->users->email}}</p>
                                    <p class="testimonial-text" style="line-height: 10px"><span class="font-weight-bold">Phone: </span>{{$property->users->phone}}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')

    <!-- Internal form-elements js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/form-elements.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @endif
    </script>
    <script src="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            // Summernote
            $('.textarea1').summernote({
                placeholder: 'Description',
                tabsize: 4,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
            $('.textarea2').summernote({
                placeholder: 'CONTACT US',
                tabsize: 4,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
            $('.textarea3').summernote({
                placeholder: 'PRIVACY POLICY ',
                tabsize: 4,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
@endsection
