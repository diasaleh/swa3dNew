@extends('layouts.app')
 @section('content')
<div class="container" style="margin:100px auto">
    <div class="row">
        <div class="col-lg-10 offset-md-1">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-block">
                    <form class="" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="form-control-label">Name</label>
                                    <div class="">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                required="required" autofocus="autofocus" />
                                @if ($errors->has('name')) 
                                        <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('name') }}
                                        </div>

                                @endif

<<<<<<< HEAD
</div>
                        </div>

                        <!-- <div class="form-group">
                            <label  class="col-lg-4 form-control-label" for="exampleSelect1">Your account type</label>
                            <div class="col-lg-6">
                            <select name="userType" class="form-control" id="exampleSelect1">
                            <option value="1">Individual</option>
                            <option value="2">Institute</option>
                            <option value="3">Researcher</option>
                            </select>
                        </div>
                        </div> -->

                        <div class="class has('userType') ? ' has->error' : '' }}">
                            <label for="name" class="col-lg-4 form-control-label">User Type</label>
                            <div class="col-lg-6">
                                <input id="name" type="text" class="form-control" name="userType" value="{{ old('userType') }}"
                                required="required" />
                                @if ($errors->has('userType'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('userType') }}
                                    </div>

@endif
</div>
                        </div>

                        <div class="class has('email') ? ' has->error' : '' }}">
                            <label for="email" class="col-lg-4 form-control-label">E-Mail Address</label>
                            <div class="col-lg-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                required="required" />
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('email') }}
                                    </div>
=======
>>>>>>> bc185b41571661d551ebe8cc379accee47ca5fdf

                                </div>
                        </div>
                             <div class="form-group class has('name') ? ' has->error' : '' }}">
                                 <label for="password" class=" form-control-label">Password</label>
                                    <div class="">
                                        <input id="password" type="password" class="form-control" name="password"required="required" />
                                            @if ($errors->has('password')) 
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Warning!</strong> {{ $errors->first('password') }}
                                                </div>

                                      
                            @endif
                            </div>
                        </div>
<<<<<<< HEAD

                        <div class="form-group">
                            <div class="col-lg-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Register</button>
=======
                          <div class="form-group">
                            <label  class=" form-control-label" for="exampleSelect1">Where are you from</label>
                            <div class="">
                            <select name="livingPlace" class="form-control" id="exampleSelect1">
                            <option value="0">city</option>
                            <option value="1">camp</option>
                            <option value="2">vilage</option>
                            </select>
                        </div>
                        </div>
                             <div class="form-group class has('country') ? ' has->error' : '' }}">
                            <label for="cc" class=" form-control-label">Your country name</label>
                            <div class="">
                                <input id="cc" type="text" class="form-control" name="country" value="{{ old('country') }}"
                                required="required" />
                                @if ($errors->has('country'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('country') }}
                                    </div>

                            @endif
                            </div>
                        </div>
                            <div class="form-group class has('currentWork') ? ' has->error' : '' }}">
                            <label for="cw" class=" form-control-label">Your current Work</label>
                            <div class="">
                                <input id="cw" type="text" class="form-control" name="currentWork" value="{{ old('currentWork') }}"
                                required="required" />
                                @if ($errors->has('currentWork'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('currentWork') }}
                                    </div>

                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class=" form-control-label" for="exampleSelect1">Your educational level</label>
                            <div class="">
                            <select name="educationalLevel" class="form-control" id="exampleSelect1">
                            <option value="0">school</option>
                            <option value="1">colage</option>
                            </select>
                        </div>
                        </div>
                            </div><!--- Col-->
                            <div class="col-lg-6">
                                      <div class="form-group class has('email') ? ' has->error' : '' }}">
                                        <label for="email" class=" form-control-label">E-Mail Address</label>
                                            <div class="">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"required="required" />
                                                    @if ($errors->has('email'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <strong>Warning!</strong> {{ $errors->first('email') }}
                                                        </div>
                                                @endif
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="password-confirm" class=" form-control-label">Confirm Password</label>
                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required="required" />
                            </div>
                        </div>
                              <div class=" form-group class has('cityName') ? ' has->error' : '' }}">
                            <label for="email" class=" form-control-label">Your city name</label>
                            <div class="">
                                <input id="name" type="text" class="form-control" name="cityName" value="{{ old('cityName') }}"
                                required="required" />
                                @if ($errors->has('cityName'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('cityName') }}
                                    </div>

@endif
</div>
                        </div>
                         <div class="form-group">
                            <label  class=" form-control-label" for="exampleSelect1">Gender</label>
                            <div class="">
                            <select name="gender" class="form-control" id="exampleSelect1">
                            <option value="0">male</option>
                            <option value="1">female</option>
                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                            <label  class=" form-control-label" for="exampleSelect1">Do you have any expriments on Voluntary</label>
                            <div class="">
                            <select name="preVoluntary" class="form-control" id="exampleSelect1">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                            </select>
                        </div>
                        </div>

                        <div class="form-group class has('voluntaryYears') ? ' has->error' : '' }}">
                            <label for="name" class=" form-control-label">Voluntary Years</label>
                            <div class="">
                                <input id="name" type="text" class="form-control" name="voluntaryYears" value="{{ old('voluntaryYears') }}"
                                required="required" />
                                @if ($errors->has('voluntaryYears'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('voluntaryYears') }}
                                    </div>

                            @endif
                            </div>
                            </div><!--- Col-->
                        </div><!--- Row-->
             
                        <!-- <div class="form-group">
                            <label  class="col-lg-4 form-control-label" for="exampleSelect1">Your account type</label>
                            <div class="col-lg-6">
                            <select name="userType" class="form-control" id="exampleSelect1">
                            <option value="1">Individual</option>
                            <option value="2">Institute</option>
                            <option value="3">Researcher</option>
                            </select>
                        </div>
                        </div> -->

                        </div>
                        <div class="form-group">
                            <div class="col-lg-4 offset-md-4">
                                <button type="submit" class="btn btn-success btn-block">Register</button>
>>>>>>> bc185b41571661d551ebe8cc379accee47ca5fdf
                            </div>
                        </div>
                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>@endsection