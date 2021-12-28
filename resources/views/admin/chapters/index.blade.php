@extends('layouts.app')
@section('title','Create User')
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
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Business Type</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">ADD CHAPTER</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal needs-validation" method="post" action="{{ isset($chapter) ? route('chapters.update',$chapter->id) : route('chapters.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($chapter))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <p class="mg-b-10">Name</p>
                                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($chapter) ? $chapter->name : '' }}" id="name" placeholder="Name">
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-0 justify-content-end">
                                        <p class="mg-b-10">Image</p>
                                        <div class="input-group file-browser">
                                            <input type="file" name="image"  class="form-control browse-file {{ $errors->has('image') ? ' is-invalid' : '' }}" placeholder="choose" readonly>
                                        </div>
                                        <span class="text-danger">{{$errors->first('image')}}</span>
                                    </div>
                                </div>
                                
                                <div class="col-4">
                                    @if(isset($chapter))
                                        <div class="form-group mb-0 justify-content-center mt-2">
                                            <p class="mg-b-10">Image</p>
                                            <div class="input-group">
                                                <img src="{{url('images/chapters',$chapter->image)}}" width="100">
                                            </div>
                                            <span class="text-danger">{{$errors->first('image')}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end mt-2">
                                <p class="mg-b-10">Description</p>
                                <textarea class="form-control textarea1 {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ isset($chapter) ? $chapter->description : '' }}</textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-0 justify-content-end mt-2">
                                <div class="ml-4">
                                <input class="form-check-input" class="mg-b-10 mr-3" type="checkbox" value="" id="check">
                                </div>
                                    <label class="form-check-label ml-4" for="flexCheckDefault">
                                        Show Description
                                    </label>
                                
                                @if($errors->has('check'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('check') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-danger">{{ isset($chapter) ? 'Update Now' : 'Save Now' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">CHAPTERS TYPE LIST</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        
                                        <th>NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($chapters as $index => $char)
                                        <tr>
                                            <th scope="row">{{++$index}}</th>
                                            <td><img src="{{url('images/chapters',$char->image)}}" width="50"></td>
                                            
                                            <td>{{$char->name}}</td>
                                            <td>{{$char->description}}</td>
                                            <td><a class="btn btn-sm btn-info" href="{{route('chapters.edit',$char->id)}}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>
                                                <form action="{{ route('chapters.destroy', $char->id) }}"
                                                      method="post"
                                                      onsubmit="return confirm('Do you really want to delete this?');">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
