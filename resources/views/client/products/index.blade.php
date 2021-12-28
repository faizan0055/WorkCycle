@extends('layouts.app')
@section('title','Products')
@section('style')

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
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Products</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
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
        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body p-2">
                        <form method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" placeholder="Search ...">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </span>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="row row-sm">
                    @if($products->count()>0)
                    @foreach($products as $index => $product)
                    <div class="col-md-6 col-lg-4 col-xl-3  col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="pro-img-box">
                                    <div class="d-flex product-sale">
                                        <div class="badge bg-pink">Discount {{$product->discount}}%</div>
                                    </div>
                                    <img class="w-100" src="{{url('images/products/',$product->image)}}" alt="product-image" width="300">
                                    <a href="#" class="adtocart" @if($product->stocks->where('in_stock','1')->count()>0) data-target="#modaldemo2" data-toggle="modal" onclick="VIEWPRODUCT({{$product->id}});" @else @endif> <i class="las la-shopping-cart "></i></a>
                                </div>
                                <div class="text-center pt-3">
                                    <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">{{$product->name}}</h3>
                                    <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">${{$product->price-($product->price*$product->discount/100)}} <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">${{$product->price}}</span></h4>
                                    <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">@if($product->stocks->where('in_stock','1')->count()>0){{'Available'}}@else{{'Out of stock'}}@endif</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="row row-sm">
                        <div class="col-md-12 col-lg-12 col-xl-12  col-sm-6">
                    <h3 class="h6 mb-2 mt-4 font-weight-bold text-center text-uppercase">No Product found!</h3>
                    </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- /row -->

    </div>
    <!-- Container closed -->
    <div class="modal" id="modaldemo2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="invoice">MY WALLET (${{number_format(auth()->user()->credit,2)}})</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="AppendProInfo">

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-danger-gradient" type="button" onclick="orderNow();">Buy Now</button>
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
    <script src="{{ asset(env('ASSET_URL') .'assets/js/table-data.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <script>
        function VIEWPRODUCT(Id) {
            $.ajax({
                type: "POST",
                url: "{{url('client/view_product')}}"+"/"+Id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    //console.log(data);
                    document.getElementById('AppendProInfo').innerHTML=data;
                }
            });
        }
        $(document).on('change','#qty',function(){
            const qty=this.value;
            const price=$('#price').html();
            var total=Number(price)*Number(qty);
            //alert(total);
            document.getElementById('total').innerHTML=total;
        });
        function orderNow() {
            const price=$('#price').html();
            const total=$('#total').html();
            const product_id=$('#product_id').val();
            var qty =$('#qty option:selected').val();
            $('#modaldemo2').modal('hide');
                $.ajax({
                    type: "POST",
                    url: "{{route('order.store')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        price:price,
                        total:total,
                        qty:qty,
                        product_id:product_id,
                    },
                    success: function (data) {
                        $('#modaldemo2').modal('hide');
                        //console.log(data);
                        if(data.status==true){
                            $('#modaldemo2').modal('hide');
                            toastr.success(data.message,'Good Job!');
                            var timer = setTimeout(function() {
                                window.location='{{route('order.index')}}';
                            }, 3000);
                        }else{
                            $('#modaldemo2').modal('hide');
                            toastr.error(data.message,'Oops!');
                            var timer = setTimeout(function() {
                                window.location.reload();
                                }, 3000);
                        }

                    }
                });
            }
    </script>

@endsection
