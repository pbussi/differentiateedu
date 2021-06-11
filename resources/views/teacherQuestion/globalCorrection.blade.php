  
@extends('layout')

@section('content')

<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="page-title">{{$question->course->name}}</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href={{url("mycourses")}}>Teacher Classes</a></li>
                                     <li class="breadcrumb-item"><a href='{{url("teacherQuestion/list/{$question->course->id}")}}'>{{$question->course->name}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Students Answers</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                      
                    
                </div>
            </div>
    <div class="card">
                <div class="card-body">
                  <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card" style="background-image: url('{{url("file/download/{$question->picture->hash}")}}');   background-repeat:no-repeat; background-size:cover;height: 100%; width: 100%">  
                            <div class="card-body" style="height: 200px;">

                            </div>

                        </div>
                    </div>  

                 </div>
                </div>
    </div>

    <div class="container-fluid">

         <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex">
                                    <div class="col-8">
                                        <h4>Massive Correction</h4>
                                        <h5 class="card-title">{{$question->title}}</h5>
                                       <!--<h5 class="card-subtitle">Assign the same correction to all pending students jobs</h5> -->
                                    </div>
                                      
                                   
                                </div>
                                <!-- title -->
                            </div>

                    @if (count($answers)==0)
                     <div class="card-body">
                        <h4 class="card-title"> <img width=50px style="margin-right: 15px;"src={{asset("assets/images/test.png")}}>There is no pending students jobs to be correct.</h4>
                        <h6 class="card-subtitle"> </h6>
                    </div>

                    @else

                      <div class="card-body">
                        <h4 class="card-title"> <img width=50px style="margin-right: 15px;"src={{asset("assets/images/test.png")}}>Teacher Review </h4>
                        <h6 class="card-subtitle">Here you can write the same note and score to all pending students jobs. </h6>
                        
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <form class="form-horizontal form-material mx-2"  method="post" action="" id="teacherForm">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-12">Grade</label>
                                            <div class="col-md-4">
                                                <input type="number" name=mark id=mark class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-12">Feedback for Student</label>
                                            <div class="col-md-8">
                                                <textarea rows="3" name=teacher_notes class="form-control form-control-line"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <a class="btn btn-success text-white" onclick="$('#confirmModal').modal('toggle')" ><i class="mdi mdi-check-all" style="margin-right:5px;"></i>Correct all</a>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>



<!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Really want to send this correction?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="$('#confirmModal').modal('toggle')" >
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sending your correction, you will not be able to make changes.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#confirmModal').modal('toggle')">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#teacherForm').submit()">Confirm</button>
                </div>
            </div>
        </div>
    </div>



                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Student</th>
                                            <th class="border-top-0"></th>
                                            <th class="border-top-0">Completed at</th>
                                            <th class="border-top-0">Selected choice</th>
                                            <th class="border-top-0">Student Notes</th>
                                            
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($answers as $answer)

                                        
                                        <tr>
                                            <td class="user-image" width="5%">
                                                <img src="{{url("file/download/{$answer->student->picture->hash}")}}" class="rounded-circle" width="30" /></td>
                                             <td style="padding:0px;vertical-align: middle;">
                                                    <div class="d-flex align-items-center">
                                                            <h4 class="m-b-0 font-16">{{$answer->student->user->name}}</h4>
                                                    </div>
                                            </td>
                                            
                                            <td>{{date('m-d-Y H:i:s', strtotime($answer->completed_at))}}</td>
                                          
                                            <td>
                                                <div class="m-r-10"><a class="btn btn-circle d-flex btn-success text-white" title="{{$answer->choice->title}}">{{$answer->choice->order}}</a>
                                                    </div>
                                            </td>
                                             <td>{{$answer->notes}}</td>
                                           
                                        </tr>
                                      
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
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
        $(document).ready(function(){
    $('#mark').numeric("."); 
});
</script>
    @endsection