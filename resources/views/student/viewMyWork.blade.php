@extends('layout')
@section('content')
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row align-items-center">
      <div class="col-12">
        <h4 class="page-title">{{$question->title}}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url("myactivities/questionList/{$question->course_id}")}}">Questions List</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$myanswerChoice->title}}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <img src={{asset("assets/images/final_paper.png")}} width="80px" >
            <h4 class="page-title" align="center">{{$question->title}}</h4>
            
            <label class="label label-info">Your Answer  </label><h4 class="card-title"><b>{{$myanswerChoice->title}}</b></h4>
            <h5 class="card-subtitle" style="text-align: justify;">{{$myanswerChoice->description}}</h5>
            <label class="label label-info">Presentation date  </label>
            <h6 class="card-subtitle" style="margin-top:3px;">{{date('Y-m-d H:i',strtotime($answer->completed_at))}}</h6>
            
            <h6 class="card-title" style="margin-top:15px;">Work Status: </h6>
            @if ($answer->review_date)
            <label class="label label-success">CORRECTED</label>
            <h6 class="card-title" style="margin-top:15px;">Review date: </h6>
            <h6 class="card-subtitle" style="margin-top:3px;">{{date('Y-m-d H:i',strtotime($answer->review_date))}}</h6>
            
            @else
            <label class="label label-danger">WAITING FOR CORRECTION</label>
            @endif
          </div>
        </div>
      </div>
      
    </div>
    
    <div class="row">
      <!-- column -->
      <div class="col-12 col-sm-6" >
        
        <form id="formmywork">
          <div class="card">
            <div class="card-body">
              @csrf
              <h4 class="card-title"> <img class="rounded-circle" width=50px src={{asset("assets/images/notes2_icon.png")}} style="margin-right: 15px;">My notes</h4>
              <textarea rows="5" name=notes class="form-control form-control-line" >{{$answer->notes}}</textarea>
            </div>
          </div>
        </form>
        
      </div>
      <div class="col-12 col-sm-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"> <img class="rounded-circle" width=50px style="margin-right: 15px;"src={{asset("assets/images/my-files.png")}}>My backpack </h4>
            
            <table class="table no-border mini-table m-t-20">
              @foreach ($answer->files as $file)
              <tr >
                <td class="text-muted"><img src={{asset("assets/images/fileIcons/")}}/{{pathinfo($file->filename,PATHINFO_EXTENSION)}}-icon-24x24.png style="margin-right:10px;" />{{$file->original_filename}}</td>
                <td style="padding:0px;vertical-align: middle;"><div class="m-icon" align=top><a href={{url("answerActivities/deleteWork/{$answer->id}/{$file->id}")}}><i class="m-r-10 mdi mdi-window-close"></i></a></div>
              </td>
              
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row" >
    <!-- column -->
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Content / Material </h4>
          <h6 class="card-subtitle">Here you will find all content and activities to do.  Please read, complete and upload your work if it necessary.</h6>
          <div class="form-group row">
            <div class="col-md-12">
              <div>
                <table class="table" no-border>
                  <tbody>
                    @foreach ($myanswerChoice->files as $file)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          
                          <div class="">
                            <h4 class="m-b-0 font-16"><a href="{{url("file/download/{$file->hash}")}}">{{$file->pivot->description}}</a></h4>
                          </div>
                        </div>
                      </td>
                      <td style="align-content:center;">
                        @if (substr($file->type,0,5)=="image")
                        <img src="{{url("file/download/{$file->hash}")}}" width="200px">
                        @else
                        <img src={{asset("assets/images/fileIcons/")}}/{{pathinfo($file->filename,PATHINFO_EXTENSION)}}-icon-48x48.png />
                        @endif
                      </td>
                      <td>
                        
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
    <div class="row">
      <!-- column -->
      <div class="col-6" >
        <div class="card">
            <!-- card -->
            @if ($answer->fireworks)
                <canvas id=myCanvas width=600 height="300"></canvas>
            @endif
          <div class="card-body" >
              <!-- card body -->
              <h4 class="card-title"> <img width=50px style="margin-right: 15px;"src={{asset("assets/images/test.png")}}>Teacher Review </h4>
              <h6 class="card-subtitle">Here you will find teacher notes and marks for your presented work</h6>
              <div class="form-group row" >

                    <div class="col-md-12">
                      <span class="label label-info label-rounded" >Correction date  </span>
                      <h6 class="card-title" style="padding-top:15px; padding-left:50px;">
                      @if ($answer->review_date)
                      {{date('Y-m-d H:i',strtotime($answer->review_date))}}</h6>
                      @else
                      </h6>
                      @endif
                      <span class="label label-info label-rounded">Your mark </span>
                      <h2 class="card-title" style="padding-top:10px;  padding-left:50px;">{{$answer->mark}}</h2>
                      <span class="label label-info  label-rounded">Feedback </span>
                      <h6 class="card-title" style="padding-top:15px; padding-left:50px;">{{$answer->teacher_notes}}</h6>
                    </div>
              </div>
                <!-- end form-group -->
          </div>
            <!-- end card body -->
        </div>
          <!-- end card -->
      </div>
        <!-- end col-6 -->

    </div>
 
  <!-- Modal -->
  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Really want to send your work?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="$('#confirmModal').modal('toggle')" >
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Sending your work, you will not be able to make changes or add more files
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#confirmModal').modal('toggle')">Close</button>
          <button type="button" class="btn btn-primary" onclick="$('#formmywork').submit()">Confirm</button>
        </div>
      </div>
    </div>
  </div>
  @endsection


@section('internal_scripts')

<script>
var canvas=document.getElementById('myCanvas');
   ctx= canvas.getContext('2d');
   var fireworks=[];
   var particles=[];
   var counter = 0;

   function Firework()
   {
      this.x = canvas.width/7*(1+3*Math.random());
      this.y = canvas.height +100;
      this.angle = Math.random() * Math.PI / 4 - Math.PI / 6;
      this.xSpeed = Math.sin(this.angle) *(6+Math.random()*7);
      this.ySpeed = -Math.cos(this.angle) *(6+Math.random()*7);
      this.hue = Math.floor(Math.random() * 360);
   }
   Firework.prototype.draw= function() 
   {
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.rotate(Math.atan2(this.ySpeed, this.xSpeed) + Math.PI / 2);
      ctx.fillStyle =`hsl(${this.hue}, 5%, 5%)`;
      ctx.fillRect(0, 0, 5, 15);
      ctx.restore();
   }
   Firework.prototype.update= function() 
   {
      this.x = this.x + this.xSpeed;
      this.y = this.y + this.ySpeed;
      this.ySpeed += 0.1;
   }
   Firework.prototype.explode= function() 
   {
        for (var i = 0; i < 70; i++) 
       {
          particles.push(new Particle(this.x, this.y, this.hue));
       }
   }

   function Particle(x,y,hue) 
   {
      this.x = x;
      this.y = y;
      this.hue = hue;
      this.lightness = 50;
      this.size = 15 + Math.random() * 10;
      this.angle = Math.random() * 2 * Math.PI;
      this.xSpeed = Math.cos(this.angle) *(1+Math.random() * 6);
      this.ySpeed = Math.sin(this.angle) *(1+Math.random() * 6);
   }
   Particle.prototype.draw= function() 
   {
       ctx.fillStyle = `hsl(${this.hue}, 100%, ${this.lightness}%)`;
       ctx.beginPath();
       ctx.arc(this.x, this.y, this.size, 0, 2* Math.PI);
       ctx.closePath();
       ctx.fill();
   }
   Particle.prototype.update= function(index) 
   {
       this.ySpeed += 0.05;
       this.size = this.size*0.95;
       this.x = this.x + this.xSpeed;
       this.y = this.y + this.ySpeed;
       if (this.size<1) 
       {
           particles.splice(index,1);
       }
   }
   function loop() 
   {
      ctx.fillStyle = "rgba(255, 255, 255, 0.1)";
      ctx.fillRect(0,0,canvas.width,canvas.height);
      counter++;
      if (counter==15) 
      {
          fireworks.push(new Firework());
          counter=0;
      }
      var i=fireworks.length;
      while (i--) 
      {
          fireworks[i].draw();
          fireworks[i].update();
          if (fireworks[i].ySpeed > 0) 
          {
              fireworks[i].explode();
              fireworks.splice(i, 1);
          }
      }
      var i=particles.length;
      while (i--) 
      {      
          particles[i].draw();
          particles[i].update(i);
      }
      requestAnimationFrame(loop);
   }
  loop();

</script>

@endsection