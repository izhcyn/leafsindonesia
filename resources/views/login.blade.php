<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Aset/css/general.css">
</head>
<body style="background-color: #fefad0">
    <div class="container">
        <div class="login-container">
            <div class="card  mb-3" style="max-width:150vh; ">
                <div class="row">
                  <div class="col-md-5">
                    <img src="/Aset/image/header5.jpg" style="object-fit:cover" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-6 m-auto">
                    <div class="card-body">
                      <h2 class="mb-3 card-title fw-bold">Login to Your Account</h2>
                      <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="email" placeholder="name@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn bg-primary w-100" href="/">Login</button>
                        <div class="row">
                            <div class="col"><hr></div>
                            <div class="col-auto">or</div>
                            <div class="col"><hr></div>
                          </div>
                          <div class="row">
                            <div class="col text-center"><a class="btn w-100" style="text-decoration: none; color:black" href="{{ route('auth.google') }}"> <span><img src="Aset/icon/google.png" width="20px" class="me-3"></span> Continue with google</a>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col pri-color py-3 text-center">don't have an account? <b> <a data-bs-toggle="modal" data-bs-target="#login" href="/register" style="text-decoration: none; color:black">Register Here</a></b></div>
                          </div>
                    </form>
                        </div>
                    </div>
                  </div>
                </div>



</body>
</html>
