
@extends('individual/layouts.profileMaster')

@section('content')
<div class="container-fluid" style="margin:120px auto">
    <div class="row">
        @include('individual/includes.sidebar')
         <div class="col-sm-12  col-md-8  col-lg-9" style="color: #333">
         @if($success==1)
           <div class="alert alert-success alert-dismissible fade show" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
           <strong>Done!</strong> Your research has been submited successfully.
           </div>
         @endif
         <h3 class="greencolor ">Add new research</h3>
         <hr />
         <form method="post"   enctype="multipart/form-data" action="{{route('addResearch')}}">{{ csrf_field() }}

          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              <label for="title" class="col-lg-4 form-control-label">Title</label>
              <div class="col-lg-6">
                  <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"
                  required="required" />
                  @if ($errors->has('title'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('title') }}
                      </div>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('recommendations') ? ' has-error' : '' }}">
              <label for="recommendations" class="col-lg-4 form-control-label">Recommendations</label>
              <div class="col-lg-6">
                  <input id="recommendations" type="text" class="form-control" name="recommendations" value="{{ old('recommendations') }}"
                  required="required" />
                  @if ($errors->has('recommendations'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('recommendations') }}
                      </div>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('findings') ? ' has-error' : '' }}">
              <label for="findings" class="col-lg-4 form-control-label">Research Findings</label>
              <div class="col-lg-6">
                  <input id="findings" type="text" class="form-control" name="findings" value="{{ old('findings') }}"
                  required="required" />
                  @if ($errors->has('findings'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('findings') }}
                      </div>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
              <label for="tags" class="col-lg-4 form-control-label">Tags</label>
              <div class="col-lg-6">
                  <input id="tags" type="text" class="form-control" name="tags" value="{{ old('tags') }}"
                  required="required" />
                  @if ($errors->has('tags'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('tags') }}
                      </div>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('creation_date') ? ' has-error' : '' }}">
              <label for="name" class="col-lg-4 form-control-label">Creation Date</label>
              <div class="col-lg-6">
                  <input id="theDate" type="date" class="form-control" name="creation_date"  min="" value="{{ old('creation_date') }}"
                  required="required" />
                  @if ($errors->has('creation_date'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('creation_date') }}
                      </div>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('abstract') ? ' has-error' : '' }}">
              <label for="title" class="col-lg-4 form-control-label">Abstract</label>
              <div class="col-lg-6">
                  <textarea class="form-control" id="abstract" name="abstract" rows="3">{{ old('abstract') }}</textarea>
                  @if ($errors->has('abstract'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('abstract') }}
                      </div>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('filefield') ? ' has-error' : '' }}">
              <label for="filefield" class="col-lg-4 form-control-label">File Inpute</label>
              <div class="col-lg-6">
                  <input type="file" class="form-control-file" id="filefield" accept=".xls,.xlsx,.pdf,.docx" name="filefield">
                  @if ($errors->has('filefield'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('filefield') }}
                      </div>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('tool1') ? ' has-error' : '' }}">
              <div class="col-lg-6">
              <label for="tool" class="control-label">Tools</label>
                  <div class="form-check">
                  <label class="form-check-label"><input type="checkbox"  name ="tool1" value="tool1" class="form-check-input">tool1</label>
                  </div>
                  @if ($errors->has('tool1'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('tool1') }}
                      </div>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('tool2') ? ' has-error' : '' }}">
              <div class="col-lg-6">
                  <div class="form-check">
                  <label class="form-check-label"><input type="checkbox"  name ="tool2" value="tool2" class="form-check-input">tool2</label>
                  </div>
                  @if ($errors->has('tool2'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('tool2') }}
                      </div>
                  @endif
              </div>
          </div>

           <div class="form-group{{ $errors->has('credit') ? ' has-error' : '' }}">
              <div class="col-lg-6">
                  <div class="form-check">
                  <label class="form-check-label"><input type="checkbox"  name ="credit" value="1" class="form-check-input">credit</label>
                  </div>
                  @if ($errors->has('credit'))
                      <div class="alert alert-danger" role="alert">
                          <strong>Warning!</strong> {{ $errors->first('credit') }}
                      </div>
                  @endif
              </div>
          </div>

          <div class=" row justify-content-center">
            <div class="col-4">
              <button type="submit"  class="btn btn-green btn-block">Submit</button>
            </div>
          </div>

         </form>


         </div>
    </div>
</div>

@endsection
