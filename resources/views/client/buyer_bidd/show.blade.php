@extends('layouts.app')
@section('title','Bidd')
@section('user_nav', 'active')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.css')}}">
@endsection
@section('content')
    @php
        $dt = new DateTime();

    @endphp

    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Bidd/ Now Date @php echo $dt->format('Y-m-d H:i:s'); @endphp</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Bidd</h4>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-4">
                                <div class="testimonial-img">
                                    <img src="{{url('images/bidds',$bidd->image)}}" alt="" class="img-fluid" style="height: 300px; width: 500px; border-radius: 5%">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div >
                                    <h4> Property Information </h4>
                                    <table>
                                        <tr>
                                            <th>Name:</th>
                                            <td>{{$bidd->name}}</td>
                                            <th>Price:</th>
                                            <td>{{$bidd->price}}</td>
                                        </tr>
                                        <tr>
                                            <th>Detail:</th>
                                            <td>{{$bidd->description}}</td>
                                            <th>Size:</th>
                                            <td>{{$bidd->size}}</td>
                                        </tr>
                                        <tr>
                                            <th>Beds:</th>
                                            <td>{{$bidd->bed}}</td>
                                            <th>Washrooms:</th>
                                            <td>{{$bidd->washroom}}</td>
                                        </tr>
                                        <tr>
                                            <th>Start Date:</th>
                                            <td>{{date('M j,Y | H:i:s' ,strtotime($bidd->start_datetime))}}</td>
                                            <th>End Date:</th>
                                            <td>{{date('M j,Y | H:i:s' ,strtotime($bidd->end_datetime))}}</td>
                                        </tr>
                                        @if(\App\BiddParticipate::where('bidproperty_id',$bidd->id)->exists())

                                            <tr class="mt-4">
                                                <th>Top Bid:</th>
                                                <td>{{$bidprice->price}}</td>
                                            </tr>
                                        @else
                                            <tr class="mt-4">
                                                <th>Top Bid:</th>
                                                <td>No one participate yet</td>
                                            </tr>

                                            @endif
                                    </table>
                                </div>
{{--                                <div class="testimonial-author-box">--}}
{{--                                    <img src="{{url('images/user_profile',$property->users->image)}}" alt="" style="border-radius: 50%; height: 80px; width: 80px"><span class="ml-3 h4">Agent Info</span>--}}
{{--                                    <p class="testimonial-text mt-2" style="line-height: 10px"><span class="font-weight-bold">Name: </span>{{$property->users->name}}</p>--}}
{{--                                    <p class="testimonial-text" style="line-height: 10px"><span class="font-weight-bold">Email: </span>{{$property->users->email}}</p>--}}
{{--                                    <p class="testimonial-text" style="line-height: 10px"><span class="font-weight-bold">Phone: </span>{{$property->users->phone}}</p>--}}

{{--                                </div>--}}
                                @if(($st) )

                                <form class="form-horizontal needs-validation" method="post" action="{{route('buyer_bidd.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $bidd->id }}" name="bidproperty_id">
                                    <div class="row mt-5">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <p class="mg-b-10">Bidd Participate</p>
                                                <input type="number" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="" id="price" placeholder="bidd price">
                                                @if($errors->has('price'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    <div class="form-group mb-0 mt-4 justify-content-end">
                                        <div>
                                            <button type="submit" class="btn btn-danger">{{ 'Send Now' }}</button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                                    @elseif($closed)
                                        <span class="badge badge-danger mt-5">closed</span>
                                @else
{{--                                    <h6 class="mt-5">Just Wait Comming Soon At</h6>--}}
                                    <span class="badge badge-danger mt-5">Just Wait Comming Soon At</span>
                                    <table>
                                        <tr>
                                            <th>Start Date:</th>
                                            <td>{{date('M j,Y | H:i:s' ,strtotime($bidd->start_datetime))}}</td>
                                            <th>End Date:</th>
                                            <td>{{date('M j,Y | H:i:s' ,strtotime($bidd->end_datetime))}}</td>
                                        </tr>
                                    </table>
                                @endif

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
