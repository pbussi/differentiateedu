@extends('layout')
@section('content')

<div class="page-wrapper">

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
     <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="page-title">Teacher Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Teacher Classes</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-success" onClick="window.location='{{url("mycourses/create")}}'">Add New Class</button>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <h4 class="card-title">Classes</h4>
                                <h5 class="card-subtitle">List of Teacher Classes</h5>
                            </div>
                            <div class="ms-auto">
                                <div class="dl">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   

        <div class="row">
            <div class="col-12">           
                <div class="card-columns">
                  @foreach ($courses->sortBy('updated_at') as $course)
                    @if ($course->status=="0")
                        <div class="card"><a href="{{url("teacherQuestion/list/{$course->id}")}}" >

                          <img class="card-img-top" src="{{url("file/download/{$course->picture->hash}")}}"alt="Card image cap" width="297px" height="180px">
                            <div class="card-body">
                                <h5 class="card-title">{{$course->name}}</h5>
                                 <p class="card-text">{{$course->description_heading}}</p>
                            
                                <p class="card-text"><small class="text-muted"> updated at: {{date('m-d-Y H:i', strtotime($course->updated_at))}}</small></p>
                            </div></a>
                            <div class="card-footer" style="text-align: right;">
                                <a href="{{url("mycourses/edit/{$course->id}")}}" ><span class="label label-success label-rounded" style="margin-right:5px;">Edit </span></a>
                                <a href="{{url("mycourses/participants/{$course->id}")}}" ><span class="label label-warning label-rounded" style="margin-right:5px;">Manage Students </span></a>
                                 <span class="label label-megna label-rounded">{{count($course->students)}} Participants</span></a>
                            </div>

                        </div>
                    @endif
                  @endforeach
                </div>

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->



    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Table closed Classes
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <h4 class="card-title">Closed Classes</h4>
                                <h5 class="card-subtitle">List of Teacher Closed Classes</h5>
                            </div>
                            <div class="ms-auto">
                                <div class="dl">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   

        <div class="row">
            <div class="col-12">           
                <div class="card-columns">
                  @foreach ($courses as $course)
                    @if ($course->status=="1")
                      <div class="card"><a href="{{url("teacherQuestion/list/{$course->id}")}}" >

                        <img class="card-img-top" src="{{url("file/download/{$course->picture->hash}")}}"alt="Card image cap" width="297px" height="180px" style="filter:grayscale(100%);">
                        <div class="card-body">
                                <h5 class="card-title">{{$course->name}}</h5>

                            <p class="card-text">{{$course->description_heading}}</p>
                            <p class="card-text">Due date: <i>{{date('m-d-Y', strtotime($course->due_date))}}</i></p>
                            <p class="card-text"><small class="text-muted">Total Students:</small></p>
                            <p class="card-text"><small class="text-muted">Created At:{{$course->created_at}}</small></p>
                        </div>
                          <div class="card-footer" style="text-align: right;">
                                <a href="{{url("mycourses/edit/{$course->id}")}}" ><span class="label label-success label-rounded">Edit </span></a>
                                <a href="{{url("mycourses/edit/{$course->id}")}}" ><span class="label label-warning label-rounded">Delete </span></a>
                            </div>
                    </div>  
                    @endif 
                  @endforeach

                </div>
            </a>

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        
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