@extends('layouts.app')
@section('title', 'Dashboard ')
@section('dashboard_nav', 'active')

@section('content')
    <!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
                </div>
            </div>
        </div>
        <!-- /breadcrumb -->
<style>
    .news {
        width: 160px
    }

    .news-scroll a {
        text-decoration: none
    }

    .dot {
        height: 6px;
        width: 6px;
        margin-left: 3px;
        margin-right: 3px;
        margin-top: 2px !important;
        background-color: rgb(207, 23, 23);
        border-radius: 50%;
        display: inline-block
    }
</style>
@if($news)
        <div class="row row-sm py-2">
            <div class="col-sm-12">
                <h6 class="card-title mb-1">News</h6>
            </div>
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center breaking-news bg-white">
                    <div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center bg-danger py-2 text-white px-1 news"><span class="d-flex align-items-center">&nbsp;LATEST News</span></div>
                    <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"><a href="#"><b>{{$news->title}}:</b> {{$news->description}}</a> </marquee>
                </div>
            </div>
        </div>
        @endif

        <!-- row -->
        <div class="row row-sm py-2">
            <div class="col-sm-12">
                <h6 class="card-title mb-1">SUMMERY</h6>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">Purchase Keys</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <span class="float-right my-auto ml-auto">
                                    <i class="fas fa-arrow-circle-right text-white"></i>
                                    <span class="text-white op-7"><a href="{{route('my-products.index')}}" class="text-white">More Info</a></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-info-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">ORDERS</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <span class="float-right my-auto ml-auto">
                                    <i class="fas fa-arrow-circle-right text-white"></i>
                                    <span class="text-white op-7"><a href="{{route('order.index')}}" class="text-white">More Info</a></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-danger-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">NOTIFICATION</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <span class="float-right my-auto ml-auto">
                                    <i class="fas fa-arrow-circle-right text-white"></i>
                                    <span class="text-white op-7"><a href="{{route('notification.index')}}" class="text-white">More Info</a></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-warning-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TICKETS</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <span class="float-right my-auto ml-auto">
                                    <i class="fas fa-arrow-circle-right text-white"></i>
                                    <span class="text-white op-7"><a href="{{route('ticket.index')}}" class="text-white">More Info</a></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>


@endsection
@section('script')
    <!--Internal  index js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/index.js')}}"></script>
@endsection
