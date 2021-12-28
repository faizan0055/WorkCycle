@extends('layouts.app')
@section('title','ContactUs')
@section('style')
    <!-- Internal Data table css -->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- container -->
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ All Users</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="mb-3 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{route('users.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New User</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row opened -->
        <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Histories</h3>
                        </div>
                        <div class="card-body">
                            @foreach($user->orders as $order)
                            <div id="accordion" class="w-100 br-2 overflow-hidden">
                                <div class="">
                                    <div class="accor  bg-primary" id="headingThree{{$order->id}}">
                                        <h4 class="m-0">
                                            <a href="#collapseThree{{$order->id}}" class="collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
                                                <i class="si si-cursor-move mr-2"></i>INV-MS-{{$order->id}} <small>({{$order->product->name}})</small> <small class="float-right">{{$order->created_at}}</small>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree{{$order->id}}" class="collapse b-b0 bg-white" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="border p-3">
                                            <table class="table mb-0 table-bordered border-top mb-0">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10%;">#</th>
                                                    <th style="width: 80%;">Key</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order->order_stocks as $in => $key)
                                                <tr>
                                                    <th scope="row">{{++$in}}</th>
                                                    <td>{{$key->license}}</td>
                                                </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    <!-- main-content closed -->
@endsection
@section('script')

@endsection
