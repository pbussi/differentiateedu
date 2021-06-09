
@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
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
                        <form class="form-horizontal form-material mx-2"  method="post" enctype="multipart/form-data" >
                            @csrf
                             <div class="form-group row">
                                <label class="col-md-12">Title</label>
                                <div class="col-md-8">
                                    <input type="text" name=title value="{{$choice->title}}"
                                    class="form-control form-control-line" required>
                                </div>
                            </div>
                               <i class="m-r-10 mdi mdi-microphone"></i><input type="button" class="btn" id=audio value="Click and Hold to record Audio" style="margin-bottom:15px;"/>
                            @if ($choice->audio)
                            <figure>
                                <figcaption>Teacher Instructions:</figcaption>
                                <audio
                                    controls
                                    src="{{url("file/download/{$choice->audio->hash}")}}" >
                                        Your browser does not support the
                                        <code>audio</code> element.
                                </audio>
                            </figure>
                            @endif
                            <div class="form-group row">
                                <div class="col-sm-2" >
                                    <label  >Order</label>
                                    <input type="text" name=order
                                    class="form-control form-control-line" maxlength="5" value={{$choice->order}}>   
                               </div>
                            </div>   
                             <div class="form-group row">
                                <div class="col-sm-8" >
                                    <label>Choice Description</label>
                                    <textarea name=description class="form-control form-control-line">{{$choice->description}} </textarea>  
                               </div>
                            </div>   
                            <input class="btn btn-success text-white" type=submit value=Save >

                            <div><hr></div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

       
    </div>
   
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection

@section('internal_scripts')

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

                    fetch("{{route('teacherChoice.recordAudio',$choice->id)}}", {
                        method: "POST",
                        body: f
                    })
                    .then(_ => {
                        window.location.href="{{route('teacherChoice.edit',$choice->id)}}"
                    });
                }


                btn.addEventListener("mousedown", recStart);
                btn.addEventListener("touchstart", recStart);
                window.addEventListener("mouseup", recEnd);
                window.addEventListener("touchend", recEnd);
            })();
        </script>



@endsection