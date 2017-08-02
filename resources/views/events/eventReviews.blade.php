@extends('layouts.master')

@section('content')
<div class="viewProfile" style="">
@include('events.includes.header')
<div class="container "style="margin-bottom:50px;margin-top:30px;">
  <div class="row ">
@include('events.includes.sidebar')
{{-- --}}

    <div class="col-sm-12 col-md-8" >
<div class="card" style="margin-top:10px;">
        <div class="card-header">
          Goals
        </div>
        <div class="card-block">
          <p class=" card-text"style="text-align:justify;">{{$lesson->goals}}</p> 
          <p class=" card-text"style="text-align:justify;">{{$lesson->noGoalsCounter}}</p> 
          <p class=" card-text"style="text-align:justify;">{{$lesson->yesGoalsCounter}}</p> 
        </div>

      </div>

      <div class="card" style="margin-top:10px;">
        <div class="card-header">
          Lessons
        </div>
        <div class="card-block">
        @if($lesson->lessons == null)
          <p class=" card-text"style="text-align:justify;"><a href="{{route('profile',$event->user_id)}}" class="green-link">{{$event->user->name}}</a> didn't add lessons</p> 
        @else
          <p class=" card-text"style="text-align:justify;">{{$lesson->lessons}}</p> 
        @endif
        </div>

      </div>

@if($archived != 1)
<h3 class="greencolor " >This event not finished yet</h3>
                <hr />
                @else
                  <h3 class="greencolor " style="margin-top:30px;">Event Reviews</h3>
                <hr />
                @foreach($reviews as $review)
                    <div class="card" style="margin-bottom:20px;">
                      <div class="card-block">
                        <h4 class="card-title greencolor" ><a href="{{route('profile',$review->user_id)}}">{{$review->name}}</a></h4>
                        <h5 class="card-title greencolor" >{{$review->positive}}</h4>
                        <h5 class="card-title greencolor" >{{$review->negative}}</h4>
                          {{$review->created_at}}
                      </div>
                    </div>
                @endforeach
@endif

{{-- --}}
              </div>


            </div>
          </div>
        </div>
@include('events.includes.postModal')
@include('events.includes.reviewModal')

@endsection('content')
@section('scripts')
<script src="{{URL::asset('vendor/js/jstarbox.js')}} "></script>

<script src="{{URL::asset('vendor/js/RateJS.js')}} "></script>

<script src="{{URL::asset('vendor/js/bootstrap-select.js')}} "></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.9/js/dataTables.checkboxes.min.js"></script>

<script src="{{URL::asset('vendor/js/event.js')}} "></script>

    <script src="{{URL::asset('vendor/js/event.js')}} "></script>

@endsection
