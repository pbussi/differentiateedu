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
                                     <li class="breadcrumb-item"><a href={{url("myactivities")}}>Student Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$course->name}}</li>
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
            

                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
            <div class="card">
                <div class="card-body">
                  <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card" style="background-image: url('{{url("file/download/{$course->picture->hash}")}}');   background-repeat:no-repeat; background-size:cover;height: 100%; width: 100%">  
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
                                        <h4 class="card-title">Questions</h4>
                                        <h5 class="card-subtitle">List of activities and questions</h5>

                                    </div>
                                    <div class="ms-auto">
                                        <div class="dl">
                                        	<form name="filter" id=filter method="get" action="">
                                            <select name=status id=status class="form-select shadow-none" onchange="$('#filter').submit()" >
                                                <option value="all" @if (app('request')->input('status')=='all') selected @endif >All  </option>
                                                <option value="active"  @if (app('request')->input('status')=='active') selected @endif>Active</option>
                                                <option value="completed"  @if (app('request')->input('status')=='completed') selected @endif>Finished</option>
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
                                           
                                            <th class="border-top-0">Created</th>
                                             <th class="border-top-0">Due to</th>
                                             <th class="border-top-0"></th>
                                             <th class="border-top-0">Your work</th>
                                             <th class="border-top-0"></th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($questions as $question)

                                         <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                   
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16"><a href={{url("myactivities/questionShow/{$question->id}")}}>{{$question->title}}</a></h4>
                                                    </div>
                                                </div>
                                            </td>
                                           
                                         
                                             <td>{{$question->created_at->format('m-d-Y')}}</td>
                                             <td>{{date('m-d-Y', strtotime($question->finished_at))}}</td>
                                             <td align="center">
                                           
                                             	@php 
                                             		$answer=$question->getStudentAnswer();
                                             	@endphp
                                             		@if ($answer!==NULL)
                                             			@if ($answer->completed_at!==NULL)
                                             				</td><td><span class="label label-rounded label-success"><i class="m-r-10 mdi mdi-check-all" style="margin-right:5px;"></i><b>COMPLETED<b></span></td>
                                                                @if ($answer->review_date)
                                                                   <td><span class="label label-rounded label-success"><i class="m-r-10 mdi mdi-check-all" style="margin-right:5px;"></i><b>CORRECTED<b></span></td></b></tr>
                                                                @else
                                                                 <td><span class="label label-rounded label-danger"><i class="m-r-10 mdi mdi-check-all" style="margin-right:5px;"></i><b>WAITING CORRECTION<b></span></td></b></tr>
                                                                @endif

                                             			@else
                                             				@if (date('U', strtotime($question->finished_at))< date("U"))
                                             					<span class="label label-rounded label-inverse">Closed</span></td>
                                             					<td><span class="label label-rounded label-danger"><i class="mdi mdi-emoticon-dead" style="margin-right:5px;"></i><b>No more time</b></span></td>
                                                                <td></td>
                                                 			@else
                                                    			<span class="label label-rounded label-success">Open</span></td>
                                                    			<td><span class="label label-rounded label-warning"><i class="m-r-10 mdi mdi-wrench" style="margin-right:5px;"></i><B>Working on it!</B></span></td>
                                                                <td><p class="card-text"><small class="text-muted"> Last Update: {{date('m-d-Y H:i:s', strtotime($answer->updated_at))}}</small></p>
                                             				@endif
                                             				
                                             			@endif
                                             		@else
                                             			@if (date('U', strtotime($question->finished_at))< date("U"))
                                             					<span class="label label-rounded label-inverse">Closed</span></td><td></td><td></td></tr>

                                                 		@else
                                                    			<span class="label label-rounded label-success">Open</span></td><td></td><td></td></tr>
                                             			@endif
                                        
                                                     
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
        

