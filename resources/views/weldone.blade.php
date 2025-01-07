<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leafs Indonesia Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/72533ffec0.js" crossorigin="anonymous"></script>
  </head>
  <body style="background-color: #eff5ff;">
    <nav class="navbar navbar-expand-lg" >
        <div class="container" >

            Leafs Indonesia Admin</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
           <div class="ul navbar-nav ms-auto">

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <img src="aset/ava.png" height="40px" class="rounded-circle">
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('logout') }}"
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
           </div>
          </div>
          </div>
        </div>
      </nav>

      <div class=" d-flex  align-items-center " style="height: 90vh;">
        <div class="container"style="height: 70vh;">
          <h3 class="fw-semibold text-center py-3">Selamat Datang Administrator</h3>

          <div class="row justify-content-center  mx-3 my-5">
            <div class="col-lg-3 mb-3">
              <a class="menu" href="{{ route ('add.product') }}">
              <div class="card p-3 border-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle mx-auto my-3" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                <div class="card-title text-center fs-6 fw-semibold">Tambah Produk</div>
                <div class="card-caption"></div>
              </div>
            </a>
            </div>
            <div class="col-lg-3 mb-3">
              <a class="menu" href="{{ route ('listproduct') }}">
                <div class="card p-3 border-0 rounded-3" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list-check mx-auto my-3" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                  </svg>
                <div class="card-title text-center fs-6 fw-semibold">Daftar Produk</div>

              </div></a>

            </div>
            <div class="col-lg-3  mb-3">
              <a class="menu" href="{{ route ('genus') }}">
                <div class="card p-3 border-0" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-patch-plus mx-auto my-3" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5"/>
                    <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z"/>
                  </svg>                  <div class="card-title text-center fs-6 fw-semibold"></div>
                  <div class="card-title text-center fs-6 fw-semibold">Jenis Produk</div>
                </div>
              </a>

            </div>

            <div class="col-lg-3 mb-3">
              <a class="menu" href="">
                <div class="card p-3 border-0" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-image mx-auto my-3" viewBox="0 0 16 16">
                    <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12z"/>
                  </svg>                  <div class="card-title text-center fs-6 fw-semibold">Banner</div>

                </div>
              </a>
            </div>

          </div>

        </div>

      </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

<!-- <div class=" d-flex justify-content-between align-items-center" style=" height: 90vh; ">

  <div class="container">

    <h3 class="fw-semibold text-center">Selamat Datang Administrator</h3>
    <div class="dropdown m-5 ">
      <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Dropdown button
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
    </div>
    <div class="row justify-content-center  m-5">
    <div class="col-lg-3 mb-3">
      <div class="card p-3 border-0" style="background-color: white">
          <img src="aset/icon/dash_icon.png" width="40px" height="auto" class="mx-auto mb-3" >
        <div class="card-title text-center fs-6 fw-semibold">Dashboard</div>
        <div class="card-caption">Dashboard Data & Informasi Pendidikan</div>
      </div>
    </div>
    <div class="col-lg-3 mb-3">
      <div class="card p-3 border-0 rounded-3" style="background-color: white">
        <img src="aset/icon/sipp_icon.png" width="40px" height="auto" class="mx-auto mb-3">
        <div class="card-title text-center fs-6 fw-semibold">SIPP</div>
        <div class="card-caption">Sistem Informasi Pegawai Pendidik</div>
      </div>
    </div>
    <div class="col-lg-3  mb-3">
      <div class="card p-3 border-0" style="background-color: white">
        <img src="aset/icon/sika_icon.png" width="40px" height="auto" class="mx-auto mb-3">
        <div class="card-title text-center fs-6 fw-semibold">SIKA</div>
        <div class="card-caption">Sistem Informasi Kesiswaan & Akademik</div>
      </div>
    </div>
    <div class="col-lg-3  mb-3">
      <div class="card p-3 border-0" style="background-color: white">
        <img src="aset/icon/perpus_icon.png" width="40px" height="auto" class="mx-auto mb-3">
        <div class="card-title text-center fs-6 fw-semibold">Perpustakaan</div>
        <div class="card-caption">Sistem Informasi Perpustakaan</div>
      </div>
    </div>
    <div class="col-lg-3 mb-3">
      <div class="card p-3 border-0" style="background-color: white">
        <img src="aset/icon/keuangan_icon.png" width="40px" height="auto" class="mx-auto mb-3">
        <div class="card-title text-center fs-6 fw-semibold">Keuangan</div>
        <div class="card-caption">Sistem Informasi Keuangan</div>
      </div>
    </div>
    <div class="col-lg-3 mb-3">
      <div class="card p-3 border-0" style="background-color: white">
        <img src="aset/icon/monev_icon.png" width="40px" height="auto" class="mx-auto mb-3">
        <div class="card-title text-center fs-6 fw-semibold">Monev</div>
        <div class="card-caption">Sistem Informasi Monev</div>
      </div>
    </div>
    <div class="col-lg-3 mb-3">
      <div class="card p-3 border-0" style="background-color: white">
        <img src="aset/icon/aset_icon.png" width="40px" height="auto" class="mx-auto mb-3">
        <div class="card-title text-center fs-6 fw-semibold">Aset</div>
        <div class="card-caption">Sistem Informasi Aset</div>
      </div>
    </div>
    <div class="col-lg-3 mb-3">
      <div class="card p-3 border-0" style="background-color: white">
        <img src="aset/icon/setting_icon.png" width="40px" height="auto" class="mx-auto mb-3">
        <div class="card-title text-center fs-6 fw-semibold">Setting</div>
        <div class="card-caption">Pengaturan</div>
      </div>
    </div>
  </div>
</div>
</div> -->
