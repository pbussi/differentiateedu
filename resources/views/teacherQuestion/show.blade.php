@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Edit Question</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("teacherQuestion/list")}}">Question</a></li>
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
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2"  method="post" action="{{url("teacherQuestion/edit/{$question->id}")}}" >
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-12">Title</label>
                                <div class="col-md-8">
                                    <input type="text" name=title value="{{$question->title}}"
                                    class="form-control form-control-line" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-12">Description</label>
                                <div class="col-md-12">
                                    <textarea rows="3" name=description class="form-control form-control-line" required>{{$question->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 col-xlg-3 col-md-5">
                                    <label>Created at</label>
                                    <input type="text"
                                    class="form-control form-control-line" value="{{$question->created_at->format('m-d-Y')}}" readonly>
                                </div>
                                <div class="col-lg-3 col-xlg-3 col-md-5">
                                    <label>Due at</label>
                                    <input type="text"
                                    class="form-control form-control-line" value="{{date('m-d-Y', strtotime($question->finished_at))}}" readonly>
                                </div>
                                <div class="col-lg-3 col-xlg-3 col-md-5">
                                    
                                    <input class="btn btn-success text-white" type=submit value=Save style="position:absolute; bottom: 0px;">
                                </div>
                            </div>
                            
                         
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="form-group row">
                            <h4><label class="col-md-12">Choices</label></h4>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table v-middle table-hover">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="border-top-0">Title</th>
                                                <th class="border-top-0">Order</th>
                                                <th class="border-top-0" >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($question->choices->sortBy('order') as $choice)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        
                                                        <div class="">
                                                            <h4 class="m-b-0 font-16"><a href="{{url("teacherChoice/edit/{$choice->id}")}}">{{$choice->title}}</a></h4>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="align-content:center;">{{$choice->order}}</td>
                                                <td> <button class="btn btn-warning text-white">Edit</button>
                                                    <a href="{{url("teacherChoice/delete/{$choice->id}")}}" class="btn btn-danger text-white">Delete</a></td>
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
   
        
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
                                <label class="col-md-12">Add new choice</label>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2"  method="post" action="{{url("teacherChoice/add/{$question->id}")}}" >
                                    <div class="form-group row">
                                        @csrf
                                        
                                        <div class="col-sm-5" >
                                            <label  >New Title</label>
                                            <input type="text" name=title
                                            class="form-control form-control-line">
                                            
                                        </div>
                                        
                                        <div class="col-sm-1" >
                                            <label>Order</label>
                                            <input type="text" name=order
                                            class="form-control form-control-line" maxlength="5">
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-success text-white" style="position:absolute; bottom: 0px;" type="submit">Add new</button>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                            
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