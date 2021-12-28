@extends('layouts.app')
@section('title','Wallet History')
@section('style')

    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('content')
    <!-- container -->
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Wallet History</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="mb-3 mb-xl-0">
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Wallet Histories</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-10p border-bottom-0">Name</th>
                                    <th class="wd-10p border-bottom-0">Payment Method</th>
                                    <th class="wd-10p border-bottom-0">Amount</th>
                                    <th class="wd-10p border-bottom-0">Give/Take</th>
                                    <th class="wd-15p border-bottom-0">Reason</th>
                                    <th class="wd-10p border-bottom-0">Created at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $index => $transaction)
                                    <tr>
                                        <td>{{++$index}}</td>
                                        <td>{{$transaction->users->name}}</td>
                                        <td>{{$transaction->payment_types->name}}</td>
                                        <td>{{number_format($transaction->amount,2)}}</td>
                                        <td><span class="@if($transaction->give_take=='give') badge-success @else badge-info @endif badge">{{ucfirst($transaction->give_take)}}</span></td>
                                        <td>{{$transaction->reason}}</td>
                                        <td>{{$transaction->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->
        </div>
        <!-- /row -->
    </div>
@endsection
@section('script')
    <!-- Internal Data tables -->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/table-data.js')}}"></script>
@endsection
