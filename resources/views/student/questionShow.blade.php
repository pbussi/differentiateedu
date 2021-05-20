@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">{{$question->title}}</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("myactivities/questionList/{$question->course->id}")}}">Questions List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$question->title}}</li>
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
          <div class="row">
            <!-- column -->
            <div class="col-10">
                <div class="card">
                    
                    <div class="card-body">
                                <center class="m-t-30"> <img src="{{url("file/download/{$question->picture->hash}")}}"
                                        class="rounded-circle" width="200"/>
                                    <h4 class="card-title m-t-10" style="padding-top:10px;"> {{$question->title}}</h4>
                                    <h6 class="card-subtitle" style="text-align: justify;">                                      
                                           {{$question->description}}
                                    </h6>
                                    
                                </center>
                            </div>
                </div>
            </div>
       </div>
  

        @if ($selectedChoice==NULL)
            <div class="row">
       
                <div class="col-lg-10">
                        <div class="card">
                          
                              <div class="card-body">
                                  <h4 class="card-title">Select your answer</h4>
                              <!--  <img src={{asset("assets/images/choices2.jpg")}}>  -->
                                    <div class="comment-widgets scrollable">
                                    <!-- Comment Row -->
                                    <form action="{{url("myactivities/saveMyChoice/")}}" method="post" >    
                                        @csrf
                                        <input type='hidden' name=question_id value={{$question->id}}>
                                        @foreach ($choices->sortBy('order') as $choice)

                                            <div class="custom-control custom-radio">
                                                <div class="p-2"> <input class="form-check-input" type="radio" name="choice_id" value={{$choice->id}}></div>
                                                <div class="comment-text w-100">
                                                    <h6 class="font-medium">{{$choice->title}}</h6>
                                                    <span class="m-b-15 d-block" style="text-align: justify;">{{$choice->description}} </span>
                                       
                                                </div>
                                            </div>
                                        @endforeach
                                 
                                    </div>
                                   
                                    <div class="p-3">
                                        <input class="btn btn-success text-white" type=submit value="Send Answer" align=right>
                                    </div>
                                 </form>
                             
                           </div>

                        </div>
                </div>
            </div>

        @else

            <div class="row">
                <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Your selected answer was: </h4>
                            </div>
                              <div class="card-body">
                                    <div class="comment-widgets scrollable"
                                            <div class="custom-control custom-radio">
                                                <div class="p-2"> </div>
                                                <div class="comment-text w-100">
                                                    <h6 class="font-medium"><i class="m-r-10 mdi mdi-check-circle">{{$selectedChoice->title}}</i></h6>
                                                    <span class="m-b-15 d-block" style="text-align: justify;">{{$selectedChoice->description}} </span>
                                                </div>
                                            </div>
                                    </div>
                                     <div class="card-body">

                           
                                        @if ($answer->completed_at=="")
                                          <button type="button" class="btn btn-outline-warning" onClick="window.location='{{url("answerActivities/{$selectedChoice->id}")}}'">Continue working</button>
                                        @else
                                        <button type="button" class="btn btn-outline-success" onClick="window.location='{{url("myactivities/working/{$selectedChoice->id}")}}'">View your work</button>
                                        @endif
                                     </div>
                                        
                             
                           </div>

                        </div>
                </div>
            </div>




    @endif





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