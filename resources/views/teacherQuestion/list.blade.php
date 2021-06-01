 
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
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                     <li class="breadcrumb-item"><a href={{url("mycourses")}}>Teacher Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$course->name}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                      <div class="col-4">
                        <button type="button" class="btn btn-outline-success" onClick="window.location='{{url("teacherQuestion/create/{$course->id}")}}'">New Question</button>
                         <button type="button" class="btn btn-outline-warning" onClick="window.location='{{url("mycourses/studentResults/{$course->id}")}}'">Students Results</button>
                    </div>
                   	
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            

                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
         <div class="container-fluid">    
           
                <div class="card">
                    <div class="card-body">
                      <div class="row">
                    <!-- column -->
                         <div class="col-12 col-sm-8">
                             <div class="card" style="background-image: url('{{url("file/download/{$course->picture->hash}")}}');   background-repeat:no-repeat; background-size:cover;height: 100%; width: 100%">  
                            </div>
                         </div> 
                        <div class="col-12 col-sm-4">
                            <div class="card-body">
                              
                                   <img src="http://api.qrserver.com/v1/create-qr-code/?color=000000&bgcolor=FFFFFF&data={{url("QRInvitation/{$course->code}")}}"> 
                                   <input id="foo" value="{{url("QRInvitation/{$course->code}")}}">
                                    <!-- Trigger -->
                                    <button class="btn" data-clipboard-target="#foo">
                                        <img src={{asset("assets/images/clippy.svg")}} alt="Copy to clipboard" width=13>
                                    </button>
                              

                            </div>
                        
                        </div>       
                    </div>
                
                </div>
            </div>
           
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">  
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex">
                                    <div>
                                        <h4 class="card-title">Questions</h4>
                                        <h5 class="card-subtitle">List of activities and questions</h5>

                                    </div>
                                    <div class="ms-auto">
                                        <div class="dl">
                                        	<form name="filter" id=filter method="get" action="">
                                            <select name=status id=status class="form-select shadow-none" onchange="$('#filter').submit()" >
                                                <option value="all" @if (app('request')->input('status')=='all') selected @endif >All  </option>
                                                <option value="active"  @if (app('request')->input('status')=='active') selected @endif>Active</option>
                                                <option value="completed"  @if (app('request')->input('status')=='completed') selected @endif>Completed</option>
                                            </select>
                                        </form> 	
                                        </div>
                                    </div>
                                </div>
                                <!-- title -->
                            </div>


						
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Question</th>
                                             <th class="border-top-0"></th>
                                            <th class="border-top-0">Created</th>
                                             <th class="border-top-0">Due to</th>
                                             <th class="border-top-0"></th>
                                             <th class="border-top-0"></th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($questions as $question)

                                         <tr>
                                            <td width="30%">
                                                <div class="d-flex align-items-center">
                                                        <h4 class="m-b-0 font-16"><a href={{url("teacherQuestion/show/{$question->id}")}}>{{$question->title}}</a></h4>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="m-icon"><a href={{url("teacherQuestion/show/{$question->id}")}}><i class="m-r-10 mdi mdi-lead-pencil"></i></a></div>
                                                <div class="m-icon"><a href={{url("teacherQuestion/delete/{$question->id}")}}><i class="m-r-10 mdi mdi-delete"></i></a></div>
                                            </td>
                                             <td>{{$question->created_at->format('m-d-Y')}}</td>
                                             <td>{{date('m-d-Y', strtotime($question->finished_at))}}</td>
                                             <td align="center">@if (date('U', strtotime($question->finished_at))< date("U"))
                                             		<span class="label label-rounded label-inverse">Closed</span>
                                                 @else
                                                    <span class="label label-rounded label-success">Open</span>
                                             	@endif
                                             </td>
                                             @php $color="grey"; @endphp
                                             @foreach ($question->answers as $answer)
                                                @if ($answer->completed_at!="" && $answer->review_date=="")
                                                    @php $color="danger"; @endphp

                                                @endif

                                            @endforeach
                                                    <td>
                                                        @if ($color=="danger")
                                                           <a href={{url("teacherQuestion/studentsResults/{$question->id}")}}> <span class="label label-rounded label-{{$color}} blink_me">Pending students Answers</span></a></td>
                                                        @else
                                                         <img src={{asset("assets/images/check_result.png")}} width="20px" ><small class="text-muted"> <a href={{url("teacherQuestion/studentsResults/{$question->id}")}}>View Students Results </a></small></td>
                                                        @endif
                                                



                                             
                                        </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
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
    new ClipboardJS('.btn');
</script>
    @endsection
