<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Aset/css/general.css">
</head>
<body style="background-color: #fefad0">
    <div class="container">
        <div class="register-container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card  mb-3" style="max-width:150vh; ">
                <div class="row">
                  <div class="col-md-5">
                    <img src="/Aset/image/header5.jpg" style="object-fit:cover" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-6 m-auto">
                    <div class="card-body">
                      <h2 class="mb-3 card-title fw-bold">Register</h2>
                      <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                        <button type="submit" class="btn bg-primary w-100">Register</button>
                        <div class="row">
                            <div class="col"><hr></div>
                            <div class="col-auto">or</div>
                            <div class="col"><hr></div>
                          </div>
                          <div class="row">
                            <div class="col text-center"><a class="btn w-100" style="text-decoration: none; color:black" href="{{ route('auth.google')}}"> <span><img src="Aset/icon/google.png" width="20px" class="me-3"></span> Continue with google</a>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col pri-color py-3 text-center">Alreaday have an account? <b> <a data-bs-toggle="modal" data-bs-target="#login" style="text-decoration: none; color:black" href="/login">Login Here</a></b></div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            {{-- <div class="register-card">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="register-button">Register</button>
                    <div class="row">
                        <div class="col"><hr></div>
                        <div class="col-auto">or</div>
                        <div class="col"><hr></div>
                      </div>
                      <div class="row">
                        <div class="col text-center wrapbutton"><a class="" href=""> <span><img src="Aset/icon/person-fill.svg" width="20px"></span> Continue with google</a>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col pri-color py-3 text-center">Alreaday have an account? <b> <a data-bs-toggle="modal" data-bs-target="#login" href="/login">Login Here</a></b></div>
                      </div>
                </form>
            </div> --}}

</body>
</html>
