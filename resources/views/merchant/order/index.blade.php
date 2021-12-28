@extends('layouts.app')
@section('title','Order History')
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
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Orders Histories</span>
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
                            <h4 class="card-title mg-b-0">Orders Histories</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Username</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">Price</th>
                                    <th class="wd-15p border-bottom-0">Qty</th>
                                    <th class="wd-15p border-bottom-0">Total</th>
                                    <th class="wd-10p border-bottom-0">Modification</th>
                                    <th class="wd-15p border-bottom-0">Created at</th>
                                    <th class="wd-5p border-bottom-0">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $index => $order)
                                    <tr>
                                        <td>{{++$index}}</td>
                                        <td>@if($order->user) {{$order->user->name}} @else @endif</td>
                                        <td>@if($order->product) {{$order->product->name}} @else @endif</td>
                                        <td>{{$order->price}}</td>
                                        <td>{{$order->qty}}</td>
                                        <td>{{number_format($order->total,2)}}</td>
                                        <td>@if($order->total<=0 || $order->total==null)<a class="btn btn-info-gradient btn-sm" data-target="#modaldemo2" data-toggle="modal" href="#" onclick="Modify({{$order->id}})">Modify</a>@else @endif</td>
                                        <td>{{$order->created_at}}</td>
                                        <td><a class="btn btn-sm btn-info" href="{{route('merchant_orders.show',$order->id)}}"><i class="fa fa-eye"></i></a></td>
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
    <div class="modal" id="modaldemo2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="invoice">Modify Order</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <p class="mg-b-10">Amount</p>
                                <input type="number" min="1" class="form-control" value="" name="amount" id="amount">
                                <input type="hidden" id="order_id" value="">
                                <span id="amount_error" class="text-danger text-sm"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn ripple btn-danger-gradient" type="button" onclick="sendAmount();">Modify Now</button>
                    <button class="btn ripple btn-success-gradient" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
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

    <script>
        function Modify(Id) {
            document.getElementById('order_id').value=Id;
        }
        function sendAmount() {
            const id = $('#order_id').val();
            var amount = $('#amount').val();
            if(amount >=0 && amount!=''){
                document.getElementById('amount_error').innerHTML='';
                $.ajax({
                    type: "POST",
                    url: "{{route('merchant_orders.store')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        order_id:id,
                        amount:amount,
                    },
                    success: function (data) {
                        //console.log(data);
                        $('#modaldemo2').modal().hide();
                        if(data.status==true){
                            toastr.success(data.message,'Good Job!!');
                            window.location.reload();
                        }else{
                            toastr.error(data.message,'Oops!!');
                            window.location.reload();
                        }
                    }
                });
            }
            else{
                document.getElementById('amount_error').innerHTML='Amount filed is required';
            }
        }
    </script>

@endsection
