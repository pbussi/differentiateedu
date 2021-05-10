@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Create New Class</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("mycourses")}}">Teacher Dashboard</a></li>
                            
                            <li class="breadcrumb-item active" aria-current="page">Create new Class</li>
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
                        <form class="form-horizontal form-material mx-2"  method="post"  enctype="multipart/form-data" >
                            @csrf
                             <div class="form-group row">
                                <label class="col-md-12">Title</label>
                                <div class="col-md-8">
                                    <input type="text" name='name'
                                    class="form-control form-control-line" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-8" >
                                    <label  >Description Heading</label>
                                    <input type="text" name=description_heading
                                    class="form-control form-control-line" required>   
                               </div>
                            </div>  
                            <div class="form-group row">
                                <div class="col-sm-8" >
                                    <label>Description</label>
                                    <input type="textarea" name=description
                                    class="form-control form-control-line" required>   
                               </div>
                            </div>  

                              <div class="form-group row">
                                 <div class="col-sm-4" >
                                    <label>Filename</label>
                                    <input type="file" name=picture
                                    class="form-control form-control-line">
                                </div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-sm-4" >
                                    <label>Due Date</label>
                                    <input type="date" name=due_date
                                    class="form-control form-control-line">
                                </div>
                             </div>
                            <input class="btn btn-success text-white" type=submit value=Save >

                            <div><hr></div>

                        </form>
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