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
                                    
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <h4 class="card-title">Archived Classes</h4>
                                <h5 class="card-subtitle">My Archived classes</h5>
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
                   
                      <div class="card">

                        <img class="card-img-top" src="{{url("file/download/{$course->picture->hash}")}}"alt="Card image cap" width="297px" height="180px" style="filter:grayscale(100%);">
                        <div class="card-body">
                                <h5 class="card-title">{{$course->name}}</h5>

                            <p class="card-text">{{$course->description_heading}}</p>
                            <p class="card-text">Due date: <i>{{date('m-d-Y', strtotime($course->due_date))}}</i></p>
                            <p class="card-text"><small class="text-muted">Total Students:{{count($course->students)}}</small></p>
                            <p class="card-text"><small class="text-muted">Created At:{{$course->created_at}}</small></p>
                            <p class="card-text"><small class="text-muted">Archived At:{{$course->updated_at}}</small></p>
                        </div>
                          <div class="card-footer" style="text-align: right;">
                                <a href="{{url("mycourses/active/{$course->id}")}}" ><span class="label label-success label-rounded">Restore </span></a>
                              {{--  <a href="{{url("mycourses/delete/{$course->id}")}}" ><span class="label label-warning label-rounded">Delete </span></a>  --}}
                            </div>
                    </div>  
                   
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
    @include('footer')

    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>

<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection