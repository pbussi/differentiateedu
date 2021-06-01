@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">{{$course->name}}</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('mycourses')}}">MyCourses</a></li>
                             <li class="breadcrumb-item"><a href="{{url("teacherQuestion/list/$course->id")}}">{{$course->name}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Students</li>
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
                        <div class="form-group row">
                            <h5><label class="col-md-12"><img class="rounded-circle" width=50px style="margin-right: 15px;"src={{asset("assets/images/std3.png")}}>Class Participants</label></h5>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                               <th scope="col">Name</th>
                                                <th scope="col"></th>
                                                <th scope="col">email</th>
                                                 <th scope="col"></th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($course->students as $student)
                                            <tr>
                                                <td class="user-image" width="5%">
                                                    <img src="{{url("file/download/{$student->picture->hash}")}}" class="rounded-circle" width="30" /></td>
                                                <td style="padding:0px;vertical-align: middle;">
                                                    <div class="d-flex align-items-center">
                                                            <h4 class="m-b-0 font-16">{{$student->user->name}}</h4>
                                                    </div>
                                                </td>
                                                <td style="padding:0px;vertical-align: middle;">{{$student->user->email}}</td>
                                                 <td style="padding:0px;vertical-align: middle;"><div class="m-icon" align=top><a href={{url("mycourses/DeleteStudentFromClass/{$course->id}/$student->id")}}><i class="m-r-10 mdi mdi-delete"></i></a></div>
                                                </td>
                                               
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
                                
                            </div>
                            <div class="card-body">
                                    <div class="form-group row">
                                        @csrf
                                        <label class="col-md-12"><img class="rounded-circle" width=50px style="margin-right: 15px;"src={{asset("assets/images/addstudent.png")}}>Add student to class</label>
                                        <div class="col-sm-6" >
                                           <div class="ui-widget">
                                                <input id="search" type="text" name=title
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-success text-white" style="position:absolute; bottom: 0px;" id=addstudent><i class="mdi mdi-account-multiple"> Add new</i></button>
                                        </div>
                                        
                                    </div>
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
    idstudent=0;
      $("#search").val('');

  $( function() { 
    $( "#search" ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "{{url('mycourses/getallparticipants')}}",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
        //alert( "Selected: " + ui.item.name + "  " + ui.item.id );
        idstudent=ui.item.id;
      }
    } );

$("#addstudent").click(function(){
    if(idstudent==0){
        alert("Select a student first");
        return;
    }else{
    window.location.href="{{url('mycourses/addStudentToClass')}}"+"/"+{{$course->id}}+"/"+idstudent;
    }
});



  } );
  </script>

@endsection
