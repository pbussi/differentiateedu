@extends('layout')

@section('content')


        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Profile Page</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href={{url("home")}}>Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            
                            @if ($user->teachers->count()>0)
                            <div class="card-body">
                                <center class="m-t-30"> <img src="{{url("file/download/{$user->teacher->picture->hash}")}}"
                                        class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10">{{$user->name}}</h4>
                                    <h6 class="card-subtitle">                                      
                                            TEACHER
                                    </h6>
                                </center>
                            </div>
                            @endif
                           

                             @if ($user->students->count()>0)
                            <div class="card-body">
                                <center class="m-t-30"> <img src="{{url("file/download/{$user->student->picture->hash}")}}"
                                        class="rounded-circle" width="150"/>
                                    <h4 class="card-title m-t-10">{{$user->name}}</h4>
                                    <h6 class="card-subtitle">                                      
                                            STUDENT
                                    </h6>
                                    
                                </center>
                            </div>
                            @endif
                             <div class="card-body">
                            <form method="post" action="{{url("user/updatePicture/{$user->id}")}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <div class="custom-file">
                                         <input class="form-control" type="file" name=picture accept="image/*" />
                                    </div>
                                    <button class="btn btn-light-info text-info font-medium" type="submit">Update</button>
                                </div>
                            </form>
                             </div>

                            <div>
                                <hr>
                            </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6>{{$user->email}}</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                            <form method="post" action="">
                                @csrf
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text"
                                                class="form-control form-control-line" value="{{$user->name}}" id="name" name=username required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" class="form-control form-control-line" value={{$user->email}} id="email" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" value="password"
                                                class="form-control form-control-line" readonly>
                                        </div>
                                    </div>
                                   
                                    @if ($user->student)
                                      <div class="form-group">
                                        <label class="col-md-12">Your parents mail</label>
                                        <div class="col-md-12">
                                            <input type="email"
                                                class="form-control form-control-line" value={{$user->student->parent_email}} name=parent_email>
                                        </div> 
                                     </div>
                                    @endif
                                    
                                        <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success text-white" type=submit>Update Profile</button>
                                        </div>
                                    </div>

                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
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