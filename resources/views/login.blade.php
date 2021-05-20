<!DOCTYPE html>
<html>
<head>
<link href={{asset("dist/css/login.css")}} rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">

<link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">

</head>


<body>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form class="form-signin">
                        <div class="form-label-group"> <input type="email" id="inputEmail" class="form-control"  required autofocus> <label for="inputEmail">Email address</label> </div>
                        <div class="form-label-group"> <input type="password" id="inputPassword" class="form-control" required> <label for="inputPassword">Password</label> </div>
                        <div class="custom-control custom-checkbox mb-3"> <input type="checkbox" class="custom-control-input" id="customCheck1"> <label class="custom-control-label" for="customCheck1">Remember password?</label> </div> <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                        <hr class="my-4"> <button class="btn btn-lg btn-google btn-block text-uppercase" onclick=window.location.href="{{url("login/google")}}"><i class="fab fa-google mr-2"></i> Sign in with Google</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>