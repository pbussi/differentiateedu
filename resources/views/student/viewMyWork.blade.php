@extends('layout')
@section('content')
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row align-items-center">
      <div class="col-12">
        <h4 class="page-title">{{$question->title}}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url("myactivities/questionList/{$question->course_id}")}}">Questions List</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$myanswerChoice->title}}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <img src={{asset("assets/images/final_paper.png")}} width="80px" >
            <h4 class="page-title" align="center">{{$question->title}}</h4>
            
            <label class="label label-info">Your Answer  </label><h4 class="card-title"><b>{{$myanswerChoice->title}}</b></h4>
            <h5 class="card-subtitle" style="text-align: justify;">{{$myanswerChoice->description}}</h5>
            <label class="label label-info">Presentation date  </label>
            <h6 class="card-subtitle" style="margin-top:3px;">{{date('Y-m-d H:i',strtotime($answer->completed_at))}}</h6>
            
            <h6 class="card-title" style="margin-top:15px;">Work Status: </h6>
            @if ($answer->review_date)
            <label class="label label-success">CORRECTED</label>
            <h6 class="card-title" style="margin-top:15px;">Review date: </h6>
            <h6 class="card-subtitle" style="margin-top:3px;">{{date('Y-m-d H:i',strtotime($answer->review_date))}}</h6>
            
            @else
            <label class="label label-danger">WAITING FOR CORRECTION</label>
            @endif
          </div>
        </div>
      </div>
      
    </div>
    
    <div class="row">
      <!-- column -->
      <div class="col-12 col-sm-6" >
        
        <form id="formmywork">
          <div class="card">
            <div class="card-body">
              @csrf
              <h4 class="card-title"> <img class="rounded-circle" width=50px src={{asset("assets/images/notes2_icon.png")}} style="margin-right: 15px;">My notes</h4>
              <textarea rows="5" name=notes class="form-control form-control-line" >{{$answer->notes}}</textarea>
            </div>
          </div>
        </form>
        
      </div>
      <div class="col-12 col-sm-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"> <img class="rounded-circle" width=50px style="margin-right: 15px;"src={{asset("assets/images/my-files.png")}}>My briefcase </h4>
            
            <table class="table no-border mini-table m-t-20">
              @foreach ($answer->files as $file)
              <tr >
                <td class="text-muted"><img src={{asset("assets/images/fileIcons/")}}/{{pathinfo($file->filename,PATHINFO_EXTENSION)}}-icon-24x24.png style="margin-right:10px;" />{{$file->original_filename}}</td>
                <td style="padding:0px;vertical-align: middle;"><div class="m-icon" align=top><a href={{url("answerActivities/deleteWork/{$answer->id}/{$file->id}")}}><i class="m-r-10 mdi mdi-window-close"></i></a></div>
              </td>
              
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- column -->
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Content / Material </h4>
          <h6 class="card-subtitle">Here you will find all content and activities to do.  Please read, complete and upload your work if it necessary.</h6>
          <div class="form-group row">
            <div class="col-md-12">
              <div>
                <table class="table" no-border>
                  <tbody>
                    @foreach ($myanswerChoice->files as $file)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          
                          <div class="">
                            <h4 class="m-b-0 font-16"><a href="{{url("file/download/{$file->hash}")}}">{{$file->pivot->description}}</a></h4>
                          </div>
                        </div>
                      </td>
                      <td style="align-content:center;">
                        @if (substr($file->type,0,5)=="image")
                        <img src="{{url("file/download/{$file->hash}")}}" width="200px">
                        @else
                        <img src={{asset("assets/images/fileIcons/")}}/{{pathinfo($file->filename,PATHINFO_EXTENSION)}}-icon-48x48.png />
                        @endif
                      </td>
                      <td>
                        
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
    <div class="row">
      <!-- column -->
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"> <img width=50px style="margin-right: 15px;"src={{asset("assets/images/test.png")}}>Teacher Review </h4>
            <h6 class="card-subtitle">Here you will find teacher notes and marks for your presented work</h6>
            <div class="form-group row">
              <div class="col-md-12">
                <span class="label label-info label-rounded" >Correction date  </span>
                <h6 class="card-title" style="padding-top:15px; padding-left:50px;">
                @if ($answer->review_date)
                {{date('Y-m-d H:i',strtotime($answer->review_date))}}</h6>
                @else
                </h6>
                @endif
                <span class="label label-info label-rounded">Your mark </span>
                <h2 class="card-title" style="padding-top:10px;  padding-left:50px;">{{$answer->mark}}</h2>
                <span class="label label-info  label-rounded">Feedback </span>
                <h6 class="card-title" style="padding-top:15px; padding-left:50px;">{{$answer->teacher_notes}}</h6>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Really want to send your work?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="$('#confirmModal').modal('toggle')" >
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Sending your work, you will not be able to make changes or add more files
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#confirmModal').modal('toggle')">Close</button>
          <button type="button" class="btn btn-primary" onclick="$('#formmywork').submit()">Confirm</button>
        </div>
      </div>
    </div>
  </div>
  @endsection