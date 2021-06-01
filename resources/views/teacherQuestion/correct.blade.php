@extends('layout')
@section('content')
<div class="page-wrapper">
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">{{$answer->question->title}}</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{url("mycourses")}}">Teacher Classes</a></li>
							<li class="breadcrumb-item"><a href="{{url("teacherQuestion/list/{$answer->question->course_id}")}}">{{$answer->question->course->name}}</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{$answer->choice->title}}</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<img src={{asset("assets/images/final_paper.png")}} width="80px" >
						<h4 class="page-title" align="center">{{$answer->question->title}}</h4>
						
						<div class="user-image" width=20%><img src="{{url("file/download/{$answer->student->picture->hash}")}}" class="rounded-circle" width="80" /><h4 class="card-title"><b>{{$answer->student->user->name}}</b></h4></div>
						<label class="label label-info">Student Answer  </label><h4 class="card-title"><b>{{$answer->choice->title}}</b></h4>
						<h5 class="card-subtitle" style="text-align: justify;">{{$answer->choice->description}}</h5>
						<label class="label label-info">Presentation date  </label>
						<h6 class="card-subtitle" style="margin-top:3px;">{{date('Y-m-d H:i',strtotime($answer->completed_at))}}</h6>
						
						<h6 class="card-title" style="margin-top:15px;">Work Status: </h6>
						@if ($answer->review_date)
						<label class="label label-success">CORRECTED</label>
						@else
						<label class="label label-danger">WAITING FOR CORRECTION</label>
						@endif
					</div>
				</div>
			</div>
			
		</div>
		
		<div class="row">
			<!-- column -->
			<div class="col-6">
				
				<form class="form-horizontal form-material mx-2"  method="post" action="" id="formmywork">
					<div class="card">
						<div class="card-body">
							@csrf
							<div class="col-sm-12 col-md-12">
								<h4 class="card-title"> <img class="rounded-circle" width=50px src={{asset("assets/images/notes2_icon.png")}} style="margin-right: 15px;">Student notes</h4>
								<textarea rows="5" name=notes class="form-control form-control-line" readonly>{{$answer->notes}}</textarea>
							</div>
							
						</div>
					</div>
				</form>
				
			</div>
			<div class="col-6">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title"> <img class="rounded-circle" width=50px style="margin-right: 15px;"src={{asset("assets/images/my-files.png")}}>Student briefcase </h4>
						
						<table class="table no-border mini-table m-t-20">
							@foreach ($answer->files as $file)
							<tr >
								<td class="text-muted"><img src={{asset("assets/images/fileIcons/")}}/{{pathinfo($file->filename,PATHINFO_EXTENSION)}}-icon-24x24.png style="margin-right:10px;" /><a href="{{url("file/download/{$file->hash}")}}">{{$file->original_filename}}</a></td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- column -->
			<div class="col-12">
				<div class="card">
					@if($answer->review_date)
					<div class="card-body">
						<img src={{asset("assets/images/correct_icon.png")}} width="40px" >
						<h4 class="card-title" style="margin-top:15px;">Teacher Correction </h4>
						<h6 class="card-title" style="margin-top:15px;">Review date: </h6>
						<h6 class="card-subtitle" style="margin-top:3px;">{{date('Y-m-d H:i',strtotime($answer->review_date))}}</h6>
						<h6 class="card-title" style="margin-top:15px;">Score: </h6>
						<h5 class="card-subtitle" style="margin-top:3px;">{{$answer->mark}}</h5>
						<h6 class="card-title" style="margin-top:15px;">Teacher notes: </h6>
						<h6 class="card-subtitle" style="margin-top:3px;">{{$answer->teacher_notes}}</h6>
					</div>
					@else
					
					<div class="card-body">
						<h4 class="card-title"> <img width=50px style="margin-right: 15px;"src={{asset("assets/images/test.png")}}>Teacher Review </h4>
						<h6 class="card-subtitle">Here you can write notes and the score to student </h6>
						
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
											<label class="col-md-12">Notes for Student</label>
											<div class="col-md-8">
												<textarea rows="3" name=teacher_notes class="form-control form-control-line"></textarea>
											</div>
										</div>
										
										<div class="form-group row">
											<div class="col-md-6">
												<a class="btn btn-success text-white" onclick="$('#confirmModal').modal('toggle')" >Save</a>
											</div>
										</div>
										
									</form>
								</div>
								
								
							</div>
						</div>
					</div>
					@endif
					
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
	</div>}
@endsection


@section('internal_scripts')
<script>
		$(document).ready(function(){
    $('#mark').numeric("."); 
});
</script>
	@endsection