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
    <div class="row" style="margin-bottom: -40;">
          <div class="col-12">
             <div class="card">
                   <div class="card-body">
                         <img src={{asset("assets/images/answer.gif")}} width=120px>
                         <h6>Your Answer:  </h6><h4 class="card-title"><b>{{strtoupper($myanswerChoice->title)}}</b></h4>
                        
                          <div class="form-group row">
                                <div class="col-md-12">
                                    Description: <h6>{{$myanswerChoice->description}}</h6>
                                </div>
                        </div>
                   </div>
             </div>
          </div>
    </div>
    <div class="row" style="margin-bottom: -30;">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            <h4 class="card-title">Content / Material </h4>
                            <h6 class="card-subtitle">Here you will find all content and activities to do.  Please read, complete and upload your work if it necessary.</h6>


                            <div class="form-group row">   
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                       
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
                                                		<img src="{{url("file/download/{$file->hash}")}}" width="250px">
                                                	@else

                                                    <img src={{asset("assets/images/fileIcons/")}}/{{pathinfo($file->filename,PATHINFO_EXTENSION)}}-icon-48x48.png />
                                                    @endif
                                                    </td>
                                                 <td> 
                                            </tr>
                                            @endforeach
                                            @foreach ($myanswerChoice->links as $link)
                                               <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                        <h4 class="m-b-0 font-16">
                                                            @if ($link->type=='link')
                                                                <a href="{{$link->url}}">{{$link->url}}</a></h4>
                                                            @endif

                                                            @if ($link->type=='youtube')
                                                                <iframe width="300" height="150" src="//www.youtube.com/embed/{{$link->url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="align-content:center;"> 
                                                           @if ($link->type=='link')
                                                                <img src={{asset("assets/images/fileIcons/urlicon.png")}} width="48" height="48">
                                                            @endif
                                                            @if ($link->type=='youtube')
                                                                <img src={{asset("assets/images/fileIcons/youtube.png")}} width="60" height="48">
                                                            @endif
                                                   
                                                  </td>
                                               
                                                 
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
            <div class="col-sm-6 col-12">
                  <div class="card">
                    <div class="card-body">
                            <h4 class="card-title"><img class="rounded-circle" width=50px style="margin-right: 15px;"src={{asset("assets/images/upload-icon.png")}}>My work </h4>
                            <h6 class="card-subtitle">Here you can attach your work, complete all the activities and upload them.  Finally, send your work to teacher for correction</h6>
                 
                         <div class="form-group row">   
                            <div class="col-md-12 col-12">
                            	  <form class="form-horizontal form-material mx-2"  method="post" action="{{url("answerActivities/uploadWork/{$answer->id}")}}"  enctype="multipart/form-data">

                                <div class="form-group row" align="top">
                                 @csrf
                            	   <input type="hidden" name="question_id" value={{$answer->question_id}}>
                              
                                 <div class="col-sm-9 col-8" >
                                    <label>Filename</label>
                                    <input type="file" name=file
                                    class="form-control form-control-line">
                                </div>
                                <div class="col-sm-2 col-4" >
                                    <button class="btn btn-light " style="position:absolute; bottom: 5px;" type="submit"><i class="mdi mdi-upload"></i>Upload</button>
                                </div>
                                
                              </div>
                              </form>
                                
                            </div>
                        </div>
						      
                          
                      </div>  

                    </div>
                    
                </div>
     

            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-body">
                    	   <h4 class="card-title"> <img class="rounded-circle" width=50px style="margin-right: 15px;"src={{asset("assets/images/my-files.png")}}>My Backpack </h4>
                    	  
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                      <form class="form-horizontal form-material mx-2"  method="post" action="" id="formmywork">
                         <div class="form-group row">   
  
                                 @csrf
                               <div class="col-12 col-sm-12 col-md-12">
                                    <label class="">My Notes</label>
                                    <textarea rows="3" name=notes class="form-control form-control-line" >{{$answer->notes}}</textarea>
                               </div>
                                <div class="col-sm-10 col-md-10" style="padding-top:10px;" >
                                    <a class="btn btn-warning text-white" onclick="window.location='{{url("myactivities/saveDraft/{$answer->id}")}}'">Save my Draft</a>
                                    </div>

                               <div class="col-12 col-sm-2 col-md-2" style="padding-top:10px;" >
                                    <a class="btn btn-success text-white" onclick="$('#confirmModal').modal('toggle')">Submit my work</a>
                                </div>
                        </div>
                      </form>
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

