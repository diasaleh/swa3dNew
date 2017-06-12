@extends('layouts.master')

@section('content')

<div class="news">
  <div class="card card-inverse">
    <img class="card-img" src="uploads/{{$news->mainImgpath}}" alt="Card image">
    <div class="card-img-overlay">
      <h2 class="card-title">{{$news->title}}</h2>
    </div>
  </div>
  <div class="container">
    <div class="row">

        <div class="col-lg-9">

            <hr>

            <!-- Date/Time -->
            <p style="color:#777"> created at: {{$news->created_at}}</p>

            <hr>

            <!-- Post Content -->
            <p class="lead"> <?php  echo"".$news->textarea ;?> </p>

            <hr>

          </div>
        </div>
      </div>
</div>


@endsection('content')
