@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Add/Edit Choice</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("teacherQuestion/list")}}">Question</a></li>
                             <li class="breadcrumb-item"><a href="{{url("teacherQuestion/show/{$choice->question_id}")}}">Choice</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$choice->title}}</li>
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
                <div class="card">
                    
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2"  method="post" action="{{url("teacherQuestion/editChoice/{$choice->id}")}}" >
                            @csrf
                             <div class="form-group row">
                                <label class="col-md-12">Title</label>
                                <div class="col-md-8">
                                    <input type="text" name=title value="{{$choice->title}}"
                                    class="form-control form-control-line" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2" >
                                    <label  >Order</label>
                                    <input type="text" name=title
                                    class="form-control form-control-line" maxlength="5" value={{$choice->order}}>   
                               </div>
                            </div>   
                            <input class="btn btn-success text-white" type=submit value=Save >

                            <div><hr></div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

         <div class="row">
            <!-- column -->
            <div class="col-12">
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

                                                    <img src={{asset("assets/images/fileIcons/")}}/{{pathinfo($file->filename,PATHINFO_EXTENSION)}}-icon-48x48.png />
                                                    </td>
                                                 <td> 
                                                    <a href="{{url("file/deleteFile/{$file->hash}")}}" class="btn btn-danger text-white">Delete</a></td>   
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <label class="col-md-12">Add Content</label>
                            </div>
                            
                        </div>
                          <div class="card-body">
                            <form class="form-horizontal form-material mx-2"  method="post" action="{{url("teacherChoice/addFile/{$choice->id}")}}"  enctype="multipart/form-data">
                            <div class="form-group row">
                                 @csrf
                            
                                <div class="col-sm-5" >
                                    <label  >Title</label>
                                    <input type="text" name=title
                                    class="form-control form-control-line" maxlength="100" required>
                                    
                                </div>
                                
                               
                                 <div class="col-sm-4" >
                                    <label>Filename</label>
                                    <input type="file" name=file
                                    class="form-control form-control-line">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-success text-white" style="position:absolute; bottom: 0px;" type="submit">Add new</button>
                                </div>
                                
                            </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center">
        All Rights Reserved by Xtreme Admin. Designed and Developed by <a
        href="https://www.wrappixel.com">WrapPixel</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection