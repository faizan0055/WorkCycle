@extends('layouts.app')
@section('title','Drivers Wallet Recharge List')
@section('style')
    <!-- Internal Data table css -->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
@endsection
@section('content')

    <!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Driver's Wallet List</span>
                </div>
            </div>
            <div class="main-dashboard-header-right">
                <div class="text-center">
                    <label class="tx-13">CREDIT</label>
                    <h5>{{ number_format(\App\Admin::first()->balance,2) }}</h5>
                </div>
                <div class="text-center">
                    <label class="tx-13">WALLET</label>
                    <h5>{{ number_format(\App\Admin::first()->wallet,2) }}</h5>
                </div>
                <div class="text-center">
                    <label class="tx-13">E-WALLET RECHARGE</label>
                    <h5>{{ number_format(\App\Admin::first()->ewallet_recharge,2) }}</h5>
                </div>
                <div class="text-center">
                    <label class="tx-13">COUP0N</label>
                    <h5>563,25</h5>
                </div>
                <div class="text-center">
                    <label class="tx-13">MAIN/REMAINING CREDIT</label>
                    <h5>73,675</h5>
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
                            <h4 class="card-title mg-b-0">DRIVER'S WALLET RECHARGE LIST</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Request Date</th>
                                    <th class="wd-15p border-bottom-0">Update Date</th>
                                    <th class="wd-15p border-bottom-0">Shop</th>
                                    <th class="wd-20p border-bottom-0">Note</th>
                                    <th class="wd-10p border-bottom-0">Type</th>
                                    <th class="wd-20p border-bottom-0">Amount ({{env('CURRENCY')}})</th>
                                    <th class="wd-10p border-bottom-0">STATUS</th>
                                    <th class="wd-20p border-bottom-0">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdraws as $index => $withdraw)
                                    <tr>
                                        <td>{{++$index}}</td>
                                        <td>{{$withdraw->created_at}}</td>
                                        <td>{{$withdraw->updated_at}}</td>
                                        <td>{{$withdraw->users->name}}</td>
                                        <td>{{$withdraw->note}}</td>
                                        <td>{{$withdraw->ctype}}</td>
                                        <td>{{$withdraw->amount}}</td>
                                        <td><span class="badge badge-pill badge-success">{{ucfirst($withdraw->status)}}</span></td>
                                        <td>@if($withdraw->status=='pending')<a href="javascript:" rel="{{$withdraw->id}}"  class="btn btn-sm btn-success-gradient yesConfirmation">Approve</a>@else @endif</td>
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
    <!-- Container closed -->

    <!-- main-content closed -->


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
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>

    <!--Internal  Datatable js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/table-data.js')}}"></script>
    <script type="text/javascript">
        $(".yesConfirmation").click(function () {
            var id=$(this).attr('rel');
            var confirmFunction="{{url('admin/driver/wallet/approve/')}}/" + id;
            swal({
                title:'Are you sure?',
                text:"You won't be able to revert this!",
                type:'warning',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText:'Yes, Approve It!',
                cancelButtonText:'No, Cancel!',
                confirmButtonClass:'btn btn-success',
                cancelButtonClass:'btn btn-danger',
                buttonsStyling:false,
                reverseButtons:true
            },function () {
                window.location.href=confirmFunction;
            });
        });
    </script>
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @endif
    </script>
@endsection
