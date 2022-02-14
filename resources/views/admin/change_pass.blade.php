@extends('layouts.app')

@section('profile_nav', 'active')
@section('title','Profile')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <section class="content" >
        <div class="container-fluid">
            <div class="row justify-content-center ">
                <div class="card col-md-4 mt-5">
                    <div class="card-header">
                        <h3>Admin Profile</h3>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{route('admin.update.password')}}" method="POST">
                            @csrf
                            <div class="form-group col-md-12">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name=" pwd_current" id="pwd_current"/>
                            </div>
                            <div class="form-group col-md-12">
                                <label>New password</label>
                                <input type="password" class="form-control" name="pwd_new" id="pwd_new"/>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Confirm password</label>
                                <input type="password" class="form-control" name="pwdnew_confirm" id="pwdnew_confirm"/>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function logo1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @elseif(Session::has('error'))
        toastr.error("{{Session::get('error')}}");
        @endif
    </script>
@endsection
