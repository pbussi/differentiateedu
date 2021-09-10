@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-12">
                <h6 class="page-title">Add Content to Choice</h6><br>





                <h4 class="page-subtitle">{{strtoupper($choice->title)}}</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("teacherQuestion/list/{$choice->question->course->id}")}}">{{$choice->question->course->name}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url("teacherQuestion/show/{$choice->question->id}")}}">{{$choice->question->title}}</a></li>
                          
                        </ol>
                    </nav>
                </div>
            </div>
            
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->

         <div class="row">
            <!-- column -->
            <div class="col-12">
                @if ($choice->description)
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <h5 class="card-title">Description: </h5><h6>{{$choice->description}}</h6>
                                </div>
                            </div>
                        @endif
                <div class="card">

                    <div class="card-body">
                        

                        <div class="form-group row">
                            <h4 class="card-title">Content / Material </h4>
                           
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table v-middle table-hover">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="border-top-0">Title</th>
                                                 <th class="border-top-0">Type</th>
                                                <th class="border-top-0" >Actions</th>
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
                                                     @if (substr($file->type,0,5)=='image')
                                                         <img src={{url("file/download/{$file->hash}")}} width="250px" />
                                                     @else
                                                         <img src={{asset("assets/images/fileIcons/")}}/{{pathinfo($file->filename,PATHINFO_EXTENSION)}}-icon-48x48.png />
                                                    @endif
                                                      </td>

                                                 <td> 
                                                    <a href="{{url("file/deleteFile/{$file->hash}")}}" class="btn btn-danger text-white">Delete</a></td>   
                                            </tr>
                                            @endforeach

                                             @foreach ($choice->links as $link)
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
                                                 <td> 
                                                    <a href="{{url("link/deleteLink/{$link->id}")}}" class="btn btn-danger text-white">Delete</a></td>   
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
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->

        <div class="row">
            <!-- column -->
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <label class="col-md-12">  <img src={{asset("assets/images/addfile.png")}} width=40px>Add Content</label>
                            </div>
                            
                        </div>
                          <div class="card-body">
                            <form class="form-horizontal form-material mx-2"  method="post" action="{{url("teacherChoice/addFile/{$choice->id}")}}"  enctype="multipart/form-data">
                            <div class="form-group row">
                                 @csrf
                            
                                <div class="col-sm-5 col-12" >
                                    <label  >Title</label>
                                    <input type="text" name=title
                                    class="form-control form-control-line" maxlength="100" required>
                                    
                                </div>
                                
                               
                                 <div class="col-sm-4 col-6" >
                                    <label>Filename</label>
                                    <input type="file" name=file
                                    class="form-control form-control-line">
                                </div>
                                <div class="col-sm-2 col-4">
                                    <button class="btn btn-success text-white" style="position:absolute; bottom: 0px;" type="submit">Add new</button>
                                </div>
                                
                            </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>


         <div class="row">
            <!-- column -->
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>

                                <label class="col-md-12"><img src={{asset("assets/images/addurl.png")}} width=40px>Add Link / Multimedia</label>
                            </div>
                            
                        </div>
                          <div class="card-body">
                            <form class="form-horizontal form-material mx-2"  method="post" action="{{url("teacherChoice/addLink/{$choice->id}")}}"  enctype="multipart/form-data">
                            <div class="form-group row">
                                 @csrf
                            
                                <div class="col-sm-5 col-12" >
                                    <label  >Url</label>
                                    <input type="text" name=url
                                    class="form-control form-control-line" required>       
                                </div>
                                  <div class="col-sm-4 col-6" >
                                 <label>Choose type:</label>
                                 <select id="type" name="type" class="form-select shadow-none" style="width: 100%">
                                    <option value="youtube">Youtube Video</option>
                                    <option value="link">Link</option>
                                </select> 
                            </div>
                               
                                <div class="col-sm-2 col-4">
                                    <button class="btn btn-success text-white" style="position:absolute; bottom: 0px;" type="submit">Add new</button>
                                </div>
                                
                            </div>
                            </form>

                         </div>
                        
                    </div>
                </div>
            </div>
        </div>

         <div class="row">
            <!-- column -->
            <div class="col-12" align="right">
                      <a href="{{url("teacherQuestion/show/{$choice->question->id}")}}" class="btn btn-success text-white" style="margin-right: 30px; bottom: 0px;"><i class="mdi mdi-backspace">Back to Question</i></a>
            </div>
        </div>

         
        
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    @include('footer')

    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection