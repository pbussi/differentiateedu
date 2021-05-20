@extends('layout')
@section('content')
<div class="page-wrapper">
  <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">{{$question->title}}</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("myactivities/questionList/{$question->course_id}")}}">Questions List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$choice->title}}</li>
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
                   
                         <img src={{asset("assets/images/answer.gif")}}>
                         <h6>Your Answer:  </h6><h4 class="card-title"><b>{{$choice->title}}</b></h4>
                         <h5 class="card-subtitle" style="text-align: justify;">{{$choice->description}}</h5>
                           
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
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="border-top-0">Title</th>
                                                 <th class="border-top-0">Type</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($choice->files as $file)
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
                            <h4 class="card-title">Upload your work </h4>
                            <h6 class="card-subtitle">aqui va una descripcion</h6>
                         <div class="form-group row">   
                            <div class="col-md-12">
                            	  <form class="form-horizontal form-material mx-2"  method="post" action="{{url("answerActivities/uploadWork/{$choice->id}")}}"  enctype="multipart/form-data">
                            <div class="form-group row" align="top">
                                 @csrf
                            
                                <div class="col-sm-3" >
                                    <label  >Title</label>
                                    <input type="text" name=title
                                    class="form-control form-control-line" maxlength="100" required>
                                    
                                </div>
                                
                               
                                 <div class="col-sm-4" >
                                    <label>Filename</label>
                                    <input type="file" name=file
                                    class="form-control form-control-line">
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success text-white" style="position:absolute; bottom: 5px;" type="submit">Upload!</button>
                                </div>
                                
                            </div>
                            </form>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


 </div>

 @endsection