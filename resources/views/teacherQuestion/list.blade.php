 
@extends('layout')

@section('content')



<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Teacher Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Teacher Dashboard</li>
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
                                            <th class="border-top-0">Course</th>
                                            <th class="border-top-0">Subject</th>
                                             <th class="border-top-0">Category</th>
                                            <th class="border-top-0">Created</th>
                                             <th class="border-top-0">Due to</th>
                                             <th class="border-top-0">Status</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($questions as $question)

                                         <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                   
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16"><a href={{url("teacherQuestion/show/{$question->id}")}}>{{$question->title}}</a></h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$question->category->subject->course->name}}</td>
                                            <td>{{$question->category->subject->name}}</td>
                                            <td>
                                                <label class="label label-warning">{{$question->category->name}}</label>
                                            </td>
                                             <td>{{$question->created_at->format('m-d-Y')}}</td>
                                             <td>{{date('m-d-Y', strtotime($question->finished_at))}}</td>
                                             <td>@if (date('U', strtotime($question->finished_at))< date("U"))
                                             		<span class="label label-rounded label-danger">Closed</span>
                                             	@endif
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
        

