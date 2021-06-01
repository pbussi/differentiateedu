@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Invite Students </h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("mycourses")}}">Teacher Dashboard</a></li>
                            
                            <li class="breadcrumb-item active" aria-current="page">Invite Students</li>
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
                        <form class="form-horizontal form-material mx-2"  method="post" >
                            @csrf
                             <div class="form-group row">
                                <label class="col-md-12">email</label>
                                <div class="col-md-8">
                                    <input type="text" name='email'
                                    class="form-control form-control-line" required>
                                </div>
                            </div>
                           
                            <input class="btn btn-success text-white" type=submit value=Invite >


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
    @include('footer')

    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->



@endsection


@section('internal_scripts')

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

@endsection