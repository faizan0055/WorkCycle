@extends('layouts.app')
@section('title','Question')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.css')}}">
    <!-- Internal Select2 css -->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ News</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">ADD QUESTIONS</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal needs-validation" method="post" action="{{ isset($question) ? route('questions.update',$question->id) : route('questions.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($question))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <p class="mg-b-10">Question</p>
                                        <input type="text" class="form-control {{ $errors->has('question') ? ' is-invalid' : old('question') }}" name="question" value="{{ isset($question) ? $question->question : '' }}" id="title" placeholder="Question">
                                        @if($errors->has('question'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <p class="mg-b-10">Chapter</p>
                                        <select class="form-control select2 {{ $errors->has('chapter_id') ? ' is-invalid' : '' }}" name="chapter_id">
                                            <option label="Choose one"></option>
                                            @foreach(\App\Chapter::get() as $index => $ch)
                                            <option value="{{$ch->id}}" @if($ch->id == isset($question) ? $question->chapter_id : ''){{'selected'}}@endif>{{$ch->name}}</option>
                                                @endforeach
                                        </select>
                                        @if($errors->has('chapter_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('chapter_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <p class="mg-b-10">Question Image</p>
                                        <div class="input-group file-browser">
                                            <input type="file" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" placeholder="choose" >
                                        </div>
                                        @if($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-0 justify-content-end">
                                        <p class="mg-b-10">Question Video</p>
                                        <div class="input-group file-browser">
                                            <input type="file" name="video"  class="form-control browse-file {{ $errors->has('video') ? ' is-invalid' : '' }}" placeholder="choose" readonly>
                                        </div>
                                        <span class="text-danger">{{$errors->first('video')}}</span>
                                    </div>
                                    
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <p class="mg-b-10">Option-1</p>
                                        
                                        <input type="text" class="form-control {{ $errors->has('option1') ? ' is-invalid' : '' }}" name="option1" value="{{ isset($question) ? $question->option1 : old('option1') }}" id="title" placeholder="Option 1">
                                      
                                        <input type="file" class="form-control {{ $errors->has('optionimage1') ? ' is-invalid' : '' }}" name="optionimage1" placeholder="choose" >
                                        
                                        @if($errors->has('option1'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('option1') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <p class="mg-b-10">Option-2</p>
                                        
                                        <input type="text" class="form-control {{ $errors->has('option2') ? ' is-invalid' : '' }}" name="option2" value="{{ isset($question) ? $question->option2 : old('option2') }}" id="option2" placeholder="Option 2">
                                        
                                            <input type="file" class="form-control {{ $errors->has('optionimage2') ? ' is-invalid' : '' }}" name="optionimage2" placeholder="choose" >
                                        
                                        @if($errors->has('option2'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('option2') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <p class="mg-b-10">Option-3</p>
                                        
                                        <input type="text" class="form-control {{ $errors->has('option3') ? ' is-invalid' : '' }}" name="option3" value="{{ isset($question) ? $question->option3 : old('option3') }}" id="title" placeholder="Option 3">
                                        <input type="file" class="form-control {{ $errors->has('optionimage3') ? ' is-invalid' : '' }}" name="optionimage3" placeholder="choose" >
                                        
                                        @if($errors->has('option3'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('option3') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <p class="mg-b-10">Option-4</p>
                                        
                                        <input type="text" class="form-control {{ $errors->has('option4') ? ' is-invalid' : '' }}" name="option4" value="{{ isset($question) ? $question->option4 : old('option4') }}" id="title" placeholder="Option 4">
                                        <input type="file" class="form-control {{ $errors->has('optionimage4') ? ' is-invalid' : '' }}" name="optionimage4" placeholder="choose" >
                                        
                                        @if($errors->has('option4'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('option4') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <p class="mg-b-10">Answer</p>
                                        
                                        <input type="text" class="form-control {{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" value="{{ isset($question) ? $question->answer : old('answer') }}" id="answer" placeholder="Answer">
                                        <input type="file" class="form-control {{ $errors->has('ansimage') ? ' is-invalid' : '' }}" name="ansimage" placeholder="choose" >
                                        
                                        @if($errors->has('answer'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    @if(isset($question))
                                        <div class="form-group mb-0 justify-content-center mt-2">
                                            <p class="mg-b-10">Old Image</p>
                                            <div class="input-group">
                                                <img src="{{url('images/questions',$question->image)}}" width="100">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-3">
                                    @if(isset($question))
                                        <div class="form-group mb-0 justify-content-center mt-2">
                                            <p class="mg-b-10">Old Video</p>
                                            <div class="input-group">
                                                <video width="100" controls><source src="{{url('images/questions/video',$question->video)}}"></video>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="mg-b-10">Description</p>
                                <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ isset($question) ? $question->description : old('description') }}</textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-danger">{{ isset($question) ? 'Update Now' : 'Save Now' }}</button>
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
                                <h4 class="card-title mg-b-0">QUESTIONS LIST</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>QUESTION</th>
                                        <th>CHAPTER</th>
                                        <th>OPTION-1</th>
                                        <th>OPTION-2</th>
                                        <th>OPTION-3</th>
                                        <th>OPTION-4</th>
                                        <th>ANSWER</th>
                                        <th>IMAGE</th>
                                        <th>VIDEO</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        
                                    @foreach($questions as $index => $char)
                                    
                                        <tr>
                                            <th scope="row">{{++$index}}</th>
                                            <td>{{$char->question}}</td>
                                            <td>{{$char->chapters->name}}</td>
                                            
                                            <td>{{$char->option1}}
                                            <img src="{{url('images/questions',$char->optionimage1)}}" width="50">
                                            </td>
                                            <td>{{$char->option2}}
                                            <img src="{{url('images/questions',$char->optionimage2)}}" width="50">
                                            </td>
                                            <td>{{$char->option3}}
                                            <img src="{{url('images/questions',$char->optionimage3)}}" width="50">
                                            </td>
                                            <td>{{$char->option4}}
                                            <img src="{{url('images/questions',$char->optionimage4)}}" width="50">
                                            </td>
                                            
                                            <td>{{$char->answer}}
                                            <img src="{{url('images/questions',$char->ansimage)}}" width="50">
                                            </td>
                                            <td><img src="{{url('images/questions',$char->image)}}" width="80"></td>
                                            <td><video width="100" controls><source src="{{url('images/questions/video',$char->video)}}"></video></td>
                                            <td><a class="btn btn-sm btn-info" href="{{route('questions.edit',$char->id)}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>
                                                    <form action="{{ route('questions.destroy', $char->id) }}"
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
    <!-- Internal Select2.min js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/custom.js')}}"></script>
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
