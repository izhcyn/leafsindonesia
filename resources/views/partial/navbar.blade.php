<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" aria-label="Fifth navbar example">

    <div class="mx-auto px-5 d-flex justify-content-between container-fluid">

        <a class="navbar-brand" href="{{ route('welcome') }}"><img src="Aset/image/logos.png" width="70px"></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05"
            aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>



        <div class="collapse navbar-collapse" id="navbarsExample05">

            <div class="mx-auto" style="width: 45%;">

                <div class="input-group my-3">

                    <input type="text" class="form-control srch" placeholder="Search" aria-label="Search"
                        aria-describedby="Search">

                    <span class="input-group-text " id="basic-addon2"><img src="Aset/icon/search.svg"
                            width="15px"></span>

                </div>

            </div>



            <ul class="navbar-nav mb-2 mb-lg-0 ">

                <li class="nav-item">

                    <a class="nav-link" href="" data-bs-toggle="offcanvas" data-bs-target="#demo">

                        <span class="shopnav" id="model">Shop</span>

                    </a>

                </li>



                <ul class="navbar-nav mb-2 mb-lg-0">



                    <li class="nav-item">

                        <a class="nav-link" href="#">Abouts</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('contactus') }}">Contact</a>

                    </li>
                    <a href="{{ route('shopcart') }}" class="position-relative my-auto"
                        style="border: none; background-color: transparent; color: inherit; text-decoration: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-cart" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg>
                        <span id="cart-count"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ session('cart_total_items', 0) }}
                        </span>

                    </a>



                    </li>

                    <!-- Jika pengguna sudah login, tampilkan nama dan opsi dropdown -->

                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="Aset/icon/person-fill.svg" width="20px">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                @if (Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('add.product') }}">Add Produk</a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                   	 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>

                            </ul>

                        </li>
                    @else
                        <!-- Jika pengguna belum login, tampilkan ikon register/login -->

                        <li class="nav-item">

                            <a class="nav-link" href="/register"><img src="Aset/icon/person-fill.svg"
                                    width="20px"></a>

                        </li>

                    @endif

                </ul>







        </div>

    </div>

</nav>









{{--



<div class="offcanvas offcanvas-top ofc"data-bs-backdrop="false" id="demo">

    <div class="offcanvas-header">

       <h1 class="offcanvas-title mx-auto fs-6 fw-bold  ">HI! HAVE YOUR HEART SET ON SOMETHING YET?</h1>

       <button type="button" class="btn-close mx-1" data-bs-dismiss="offcanvas"></button>

   </div>

 <div class="offcanvas-body text-center">

   <div class="row justify-content-center">

       <div class="col mx-auto">

           <a class="allprod" href="{{ route ('allproducts') }}" >

           <img src="Aset/image/leaf_nav1.jpg" style="width: 20rem;" class="card-img-top" alt="...">

           </a>

       </div>

     <div class="col mx-auto">



       <img src="Aset/image/leaf_nav1.jpg" style="width: 20rem;" class="card-img-top" alt="...">





       </div>

       <div class="offcanvas-body text-center">

           <div class="row justify-content-center">

           <div class="col mx-auto">

           Lorem Isum asdasdksjhiwesj

           </div>

           <div class="col mx-auto">

         Lorem Isum asdasdksjhiwesj

           </div>

       </div>

    </div> --}}
