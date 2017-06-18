@extends('layouts.master')

@section('content')
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Results <small></small></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('main') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Results</li>
        <li class="breadcrumb-item active">Users</li>
    </ol>

    <!-- Blog Post -->
    <div class="row">

    @foreach($users as $result)
    @continue($result->userType==10)
    <div class="col-lg-4 col-sm-6 portfolio-item" style="margin-bottom:25px;">
        <div class="card h-100">
                    <a href="{{route('profile',[$result->id])}}">
                        <!--{$result->mainImgpath}}-->
                      <img class="img-fluid rounded all-news-img" src="{{ URL::to('/') }}/pp/{{$result->picture}}" alt="">
                  </a>
                    <div class="card-block">
                      <a href="{{route('profile',[$result->id])}}"><h2 class="card-title">{{$result->name}}</h2></a>
                <p class="card-text">
                  @if($result->userType==0)
                  Volunteer
                  @elseif($result->userType==1)
                  Institute
                  @elseif($result->userType==2)
                  Resercher
                  @else
                  ADMIN
                  @endif

                </p>
            </div>
        </div>
    </div>

@endforeach
</div>

<!-- Pagination -->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  {{$users->links('vendor.pagination.custom')}}
</ul>
</nav>
{{-- events earch results --}}
 <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('main') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Results</li>
        <li class="breadcrumb-item active">Events</li>
    </ol>

    <!-- Blog Post -->
    @foreach($events as $result)
    <div class="card mb-4">
        <div class="card-block">
            <div class="row">
                <div class="col-lg-6">
                    <a href="event/{{$result->id}}">
                      <img class="img-fluid rounded all-news-img" src="{{ URL::to('/') }}/events/{{$result->cover}}" alt="">
                  </a>

              </div>
              <div class="col-lg-6">
                <a href="event/{{$result->id}}"><h2 class="card-title">{{$result->title}}</h2></a>
                <p class="card-text">
                </p>
                d
            </div>
        </div>
    </div>
        <div class="card-footer text-muted">
        @if(date('Y-m-d') > $result->endDate)
         This event has Ended
        @elseif(date('Y-m-d') <= $result->endDate)
            Starts on :{{$result->startDate}}
            <br>
            Ends on:{{$result->endDate}}
        @endif
        </div>
    </div>
    @endforeach

<!-- Pagination -->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  {{$events->links()}}
</ul>
</nav>


</div>

<!-- /.container -->

@endsection('content')
