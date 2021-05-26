  
@extends('layout')

@section('content')

<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="page-title">{{$course->name}}</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href={{url("mycourses")}}>Teacher Classes</a></li>
                                     <li class="breadcrumb-item"><a href='{{url("teacherQuestion/list/{$course->id}")}}'>{{$course->name}}</a></li>
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
                                    <div>
                                        <h4 class="card-title">{{$question->title}}</h4>
                                        <h5 class="card-subtitle">Overview of Students Answers</h5>
                                    </div>
                                   
                                </div>
                                <!-- title -->
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
                                            <th class="border-top-0">Work</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($question->answers as $answer)

                                        @if ($answer->completed_at)
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
                                            <td width="15%">
                                                @if (!($answer->review_date))
                                                    <h5 class="m-b-0"><span class="label label-rounded label-warning"><a href={{url("teacherQuestion/correct/{$answer->id}")}}>Go to correct it!</a></span></h5>
                                                @else
                                                     <h5 class="m-b-0"><span class="label label-rounded label-success"><a href={{url("teacherQuestion/correct/{$answer->id}")}}>view work</a></span></h5>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


      <div class="row">

               <!-- column -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex">
                                    <div>
                                        <h4 class="card-title">Students with work in progress</h4>
                                        <h5 class="card-subtitle">Here is the list of students who doesnt present their work yet</h5>
                                    </div>
                                    
                                </div>
                                <!-- title -->
                            </div>


                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0" colspan="2">Student Name</th>
                                            <th class="border-top-0">Option Selected</th>
                                            <th class="border-top-0">Last Update</hh>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($question->answers as $answer)

                                        @if (!($answer->completed_at))  
                                            <tr>
                                              <td class="user-image" width="5%"><img src="{{url("file/download/{$answer->student->picture->hash}")}}" class="rounded-circle" width="30" />
                                              </td>
                                              <td style="padding:0px;vertical-align: middle;">
                                                    <div class="d-flex align-items-center">
                                                        <h4 class="m-b-0 font-16">{{$answer->student->user->name}}</h4>
                                                    </div>
                                              </td>
                                                 <td><div class="m-r-10"><a class="btn btn-circle d-flex btn-info text-white" title="{{$answer->choice->title}}">{{$answer->choice->order}}</a>
                                                    </div></td>
                                               <td>{{date('m-d-Y H:i:s', strtotime($answer->updated_at))}}</td>
                                            </tr>
                                        @endif
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


         <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex">
                                    <div>
                                        <h4 class="card-title">Student with no activities</h4>
                                        <h5 class="card-subtitle">A list of student that doesnt begin the activity</h5>
                                    </div>
                                   
                                </div>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0" colspan=2>Student Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students_no_answer as $student)
                                        <tr>
                                            <td class="user-image" width="5%">
                                                <img src="{{url("file/download/{$student->picture->hash}")}}" class="rounded-circle" width="30" /></td>
                                             <td style="padding:0px;vertical-align: middle;">
                                                    <div class="d-flex align-items-center">
                                                            <h4 class="m-b-0 font-16">{{$student->user->name}}</h4>
                                                    </div>
                                            </td>
                                            
                                        </tr>
                                    
                                       @endforeach
                                    </tbody>
                                </table>
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
        
