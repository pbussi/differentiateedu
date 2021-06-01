@extends('layout')

@section('content')



<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="page-title">Pending questions</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                     <li class="breadcrumb-item"><a href={{url("myactivities")}}>Student Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pending Questions</li>
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
           

            <div class="container-fluid">
      

 				<div class="row">
                    <!-- column -->
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">My Pending Questions</h4>
                                     <h5 class="card-subtitle">List of all questions you should complete until due date</h5>
                            </div>
                            <div class="comment-widgets scrollable">
                                @foreach ($pendingQuestions as $item)
                                	
                              
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row m-t-0">
                                  <div class="p-2">
                                    @if ($item['question']->picture)
                                        <img src="{{url("file/download/{$item['question']->picture->hash}")}}" class="rounded-square" width="120" /></div>
                                    @else 
                                        <!-- question without image, show class image -->
                                         <img src="{{url("file/download/{$item['question']->course->picture->hash}")}}" class="rounded-square" width="120" /></div>
                                    @endif

                                    <div class="comment-text w-100">
                                        <h6>  
                                        	@if ($item['answer']) 
                                        		 <a href="{{route('answerActivities',$item['answer']->choice_id)}}">
                                            @else 

                                            	<a href="{{route('questionShow',$item['question']->id)}}">
                                            @endif

                                        	{{$item['question']->title}}</a></h6>
                                        <span class="m-b-15 d-block">{{$item['question']->description}}</span>
                                        <div class="comment-footer">
                                        	<p class="text-muted float-end">Course: {{$item['question']->course->name}}</p> 
                                            <span class="text-muted float-end">Posted at: {{$item['question']->created_at}}</span> 
                                              
                                                 
                                            @if ($item['answer'])
                                            <span
                                                class="label label-primary">In progress...</span> <span
                                                class="action-icons">
                                                <a href="{{route('answerActivities',$item['answer']->choice_id)}}"><i class="ti-pencil-alt"></i></a>
                                              
                                            </span>
                                            @else
                                             <span
                                                class="label label-danger">Not Started</span> <span
                                                class="action-icons">
                                                <a href="{{route('questionShow',$item['question']->id)}}"><i class="ti-pencil-alt"></i></a>
                                            
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <!-- Comment Row -->
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                 </div>
                </div>
    @include('footer')

            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->



@endsection
