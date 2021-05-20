@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Create New Class</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("mycourses")}}">Teacher Dashboard</a></li>
                            
                            <li class="breadcrumb-item active" aria-current="page">Create new Class</li>
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
                        <form class="form-horizontal form-material mx-2"  method="post"  enctype="multipart/form-data" onsubmit="return checkSize()" >
                            @csrf
                             <div class="form-group row">
                                <label class="col-md-12">Title</label>
                                <div class="col-md-8">
                                    <input type="text" name='name'
                                    class="form-control form-control-line" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-8" >
                                    <label  >Description Heading</label>
                                    <input type="text" name=description_heading
                                    class="form-control form-control-line" required>   
                               </div>
                            </div>  
                            <div class="form-group row">
                                <div class="col-sm-8" >
                                    <label>Description</label>
                                    <input type="textarea" name=description
                                    class="form-control form-control-line" required>   
                               </div>
                            </div>  

                              <div class="form-group row">
                                 <div class="col-sm-4" >
                                    <label>Filename</label>
                                    <input type="file" name=picture id="image" 
                                    class="form-control form-control-line" onchange="CheckDimension()">
                                </div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-sm-4" >
                                    <label>Due Date</label>
                                    <input type="date" name=due_date
                                    class="form-control form-control-line" required>
                                      <span id='width' hidden></span><br/>
                               <span id='height' hidden></span>
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
imagewidth=0;
imageheight=0;

function CheckDimension() {
    //Get reference of File.
    var fileUpload = document.getElementById("image");
 
    //Check whether the file is valid Image.
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.png|.gif)$");
    if (regex.test(fileUpload.value.toLowerCase())) {
 
        //Check whether HTML5 is supported.
        if (typeof (fileUpload.files) != "undefined") {
            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(fileUpload.files[0]);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();
 
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;
                       
                //Validate the File Height and Width.
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    //show width and height to user
                    document.getElementById("width").innerHTML=width;
                    document.getElementById("height").innerHTML=height;
                    imageheight=height;
                    imagewidth=width;
                    return true;
                };
 
            }
        } else {
            alert("This browser does not support HTML5.");
            return false;
        }
    } else {
        alert("Please select a valid Image file.");
        return false;
    }
}


function checkSize(){

    if (document.getElementById('image').files.length==0) return true;
    if (imagewidth<800 || imageheight<200){
        alert("Image should be at least 800px width and 200px height");
        return false;
    }
    return true;

}

</script>
@endsection