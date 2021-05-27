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
                            <li class="breadcrumb-item"><a href="{{url("teacherQuestion/list/$question->course_id")}}">{{$question->course->name}}</a></li>
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
                        <form class="form-horizontal form-material mx-2"  method="post" action="{{url("teacherQuestion/edit/{$question->id}")}}"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-12">Title</label>
                                <div class="col-md-8">
                                    <input type="text" name=title value="{{$question->title}}"
                                    class="form-control form-control-line" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-8">Description</label>
                                <div class="col-md-8">
                                    <textarea rows="3" name=description class="form-control form-control-line" required>{{$question->description}}</textarea>
                                </div>
                            </div>
                            
                              <i class="m-r-10 mdi mdi-microphone"></i><input type="button" class="btn" id=audio value="Click and Hold to record Audio" style="margin-bottom:15px;"/>
                            @if ($question->audio)
                            <figure>
                                <figcaption>Listen Teacher Instructions:</figcaption>
                                <audio
                                    controls
                                    src="{{url("file/download/{$question->audio->hash}")}}" >
                                        Your browser does not support the
                                        <code>audio</code> element.
                                </audio>
                            </figure>
                            @endif
                      
                            <div class="form-group row">
                               
                                <div class="col-md-4">
                                   <label class="col-md-8">Related image</label>
                                    <img class="card-img-top" src="{{url("file/download/{$question->picture->hash}")}}" alt="question image" width="200px" height="200px">
                                    <input type="file" name=picture class="form-control form-control-line">
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
                                    <input type="date"
                                    class="form-control form-control-line" name=finished_at value="{{date('Y-m-d', strtotime($question->finished_at))}}">
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
                                                <th class="border-top-0"></th>
                                                <th class="border-top-0">Order</th>
                                                <th class="border-top-0" ></th>
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
                                                <td> <a href="{{url("teacherChoice/edit/{$choice->id}")}}" class="btn btn-warning text-white">Edit</a>
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
                                        
                                        <div class="col-sm-4" >
                                            <label  >Title</label>
                                            <input type="text" name=title
                                            class="form-control form-control-line">
                                        </div>
                                         <div class="col-sm-5" >
                                            <label>Description</label>
                                            <input type="text" name=description
                                            class="form-control form-control-line">
                                            
                                        </div>
                                        
                                        <div class="col-sm-1" >
                                            <label>Order</label>
                                            <input type="text" name=order
                                            class="form-control form-control-line" maxlength="5" required>
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



         <script type="text/javascript">
            window.nonce = "jhgfjgfjh"
            // courtesy https://medium.com/@bryanjenningz/how-to-record-and-play-audio-in-javascript-faa1b2b3e49b
            const recordAudio = () => {
              return new Promise(async resolve => {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                const mediaRecorder = new MediaRecorder(stream);
                const audioChunks = [];

                mediaRecorder.addEventListener("dataavailable", event => {
                  audioChunks.push(event.data);
                });

                const start = () => mediaRecorder.start();

                const stop = () =>
                  new Promise(resolve => {
                    mediaRecorder.addEventListener("stop", () => {
                      const audioBlob = new Blob(audioChunks);
                      const audioUrl = URL.createObjectURL(audioBlob);
                      const audio = new Audio(audioUrl);
                      const play = () => audio.play();
                      resolve({ audioBlob, audioUrl, play });
                    });

                    mediaRecorder.stop();
                  });

                resolve({ start, stop });
              });
            }

            /* simple timeout */
            const sleep = time => new Promise(resolve => setTimeout(resolve, time));

            /* init */
            (async () => {
                const btn = document.getElementById("audio");
                const recorder = await recordAudio();
                let audio; // filled in end cb

                const recStart = e => {
                    recorder.start();
                    btn.initialValue = btn.value;
                    btn.value = "recording...";
                }
                const recEnd = async e => {
                    btn.value = btn.initialValue;
                    audio = await recorder.stop();
                    audio.play();
                    uploadAudio(audio.audioBlob);
                }

                const uploadAudio = a => {
                    if (a.size > (10 * Math.pow(1024, 2))) {
                        alert("Too big; could not upload");
                        return;
                    }
                    const f = new FormData();
                    f.append("_token", window.nonce);
                    f.append("audio", a);

                    fetch("{{route('teacherQuestion.recordAudio',$question->id)}}", {
                        method: "POST",
                        body: f
                    })
                    .then(_ => {
                        window.location.href="{{route('teacherQuestion.show',$question->id)}}"
                    });
                }


                btn.addEventListener("mousedown", recStart);
                btn.addEventListener("touchstart", recStart);
                window.addEventListener("mouseup", recEnd);
                window.addEventListener("touchend", recEnd);
            })();
        </script>

    @endsection