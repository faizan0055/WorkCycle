@extends('layouts.app')
@section('title','Tickets')
@section('style')

    <!-- Internal Data table css -->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />

@endsection
@section('content')


    <!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ All Tickets</span>
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
                            <h4 class="card-title mg-b-0">View All Tickets List</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-10p border-bottom-0">NO.</th>
                                    <th class="wd-10p border-bottom-0">NAME</th>
                                    <th class="wd-15p border-bottom-0">TITLE</th>
                                    <th class="wd-15p border-bottom-0">TICKET</th>
                                    <th class="wd-25p border-bottom-0">ANSWER</th>
                                    <th class="wd-10p border-bottom-0">CREATED AT</th>
                                    <th class="wd-10p border-bottom-0">UPDATED</th>
                                    <th class="wd-10p border-bottom-0">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $index=> $ticket)
                                    <tr>
                                        <td>{{++$index}}</td>
                                        <td><span class="badge badge-success p-2">Ticket-{{$ticket->id}}</span></td>
                                        <td>{{$ticket->users->name}}</td>
                                        <td>{{$ticket->title}}</td>
                                        <td>{{$ticket->description}}</td>
                                        <td><textarea class="w-100" id="answer{{$ticket->id}}">{{$ticket->answer}}</textarea></td>
                                        <td>{{$ticket->created_at}}</td>
                                        <td>{{$ticket->updated_at}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="stockUpdate({{$ticket->id}})"><i class="fa fa-recycle"></i></button>
                                            <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>
                                                <form action="{{ route('tickets.destroy', $ticket->id) }}"
                                                      method="post"
                                                      onsubmit="return confirm('Do you really want to delete this user?');">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </a>
                                        </td>
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
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

    <!--Internal  Datatable js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/table-data.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>

    <script>
        function stockUpdate(id)
        {
            var answer = document.getElementById('answer'+id).value;
            var _token = $('#_token').attr('value');
            var send_data = {id:id, answer:answer, _token:_token};
            // console.log(send_data);
            $.ajax({
                type: "POST",
                url: "{{url('/')}}/merchant/ticket_update",
                dataType:'json',
                data:send_data,
                success: function(data){
                    // console.log(data);
                    toastr.success("Updated Successfully.","Well done!");
                }

            });
        }
    </script>
@endsection
