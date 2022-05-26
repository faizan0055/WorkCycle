@extends('frontend.layouts.app')
@section('content')
  <main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single">Our Amazing Posts</h1>
              <span class="color-text-a">Grid News</span>
            </div>
          </div>
          <div class="col-md-12 col-lg-4">
            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{route('index')}}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  News Grid
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section><!-- End Intro Single-->

    <!-- =======  Blog Grid ======= -->
    <section class="news-grid grid">
      <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
          <div class="col-md-4">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="{{asset('images/advertisement/'.$blog->image)}}" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-category-b">
                    <a href="#" class="category-b">{{$blog->name}}</a>
                  </div>
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="{{route('blog.single')}}">{{$blog->detail}}
                         </a>
                    </h2>
                      <p class="text-white">comming soon</p>
                  </div>
                  <div class="card-date">
                    <span class="date-b">{{date('M j,Y' ,strtotime($blog->created_at))}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
            @endforeach
        </div>

      </div>
    </section><!-- End Blog Grid-->

  </main><!-- End #main -->
@endsection

