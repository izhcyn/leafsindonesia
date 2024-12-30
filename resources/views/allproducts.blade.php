

    @extends('layouts.app')

   @section('content')

      <div class="container-fluid d-flex " style="margin-top: 100px;">
        <div class="sidebar d-none d-lg-block">
        <small> Filter by: </small>
        <hr>
          <ul class="nav flex-column">

              <li class="nav-item ">
                <a class="nav-link fw-bold pri-color fs-5 ps-0 d-flex justify-content-between align-items-center"
                href="" data-bs-toggle="collapse" data-bs-target="#content" aria-expanded="false"
                aria-controls="content">
                Size <i class="py-1  fas fa-sm fa-chevron-up arrowIcon" id="arrowIcon"> </i>
            </a>
            <div class="collapse show " id="content">
                <div class="card card-body ps-0" style="border: none !important;">
                    <label><input type="checkbox" class="filter size" value="seed"> Seed</label>
                    <label><input type="checkbox" class="filter size" value="seeding"> Seeding</label>
                    <label><input type="checkbox" class="filter size" value="medium"> Medium</label>
                    <label><input type="checkbox" class="filter size" value="mature"> Mature</label>
                </div>
            </div>

              </li>
              <hr>
              <li class="nav-item">

                <a class="nav-link fw-bold pri-color fs-5 ps-0 d-flex justify-content-between align-items-center"
                href="" data-bs-toggle="collapse" data-bs-target="#range" aria-expanded="true"
                aria-controls="range">
                Price Range <i class=" fas fa-sm fa-chevron-up arrowIcon" id="arrowIcon"> </i>
            </a>

            <div class="collapse show " id="range">
                <div class="card card-body ps-0" style="border: none !important;">
                    <div class="price-input">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="field">
                                    <span>Min</span>
                                    <input type="number" class=" form-control form-control-sm input-min"
                                        value="0">
                                </div>
                            </div>
                            <div class="col-2 pt-3">
                                <hr>
                            </div>
                            <div class="col">
                                <div class="field">
                                    <span>Max</span>
                                    <input type="number" class="form-control form-control-sm input-max"
                                        value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sliderange">
                        <div class="progress"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" class="range-min" min="0" max="2000" value="0"
                            step="10">
                        <input type="range" class="range-max" min="0" max="2000" value="0"
                            step="10">
                    </div>

                </div>
            </div>

              </li>
              <hr>
              <li class="nav-item">
                <a class="nav-link fw-bold pri-color fs-5 ps-0 d-flex justify-content-between align-items-center"
                    href="" data-bs-toggle="collapse" data-bs-target="#genus" aria-expanded="true"
                    aria-controls="genus">
                    Genus <i class=" fas fa-sm fa-chevron-up arrowIcon"> </i>
                </a>

                <div class="collapse show" id="genus">
                    <div class="card card-body ps-0" style="border: none !important;">
                        @foreach ($genusList as $genus)
                            <label>
                                <input type="checkbox" class="filter genus" value="{{ $genus->genus }}">
                                {{ $genus->genus }}
                            </label>
                        @endforeach
                    </div>
                </div>

            </li>

          <hr>

          <a href="#" id="clear-settings" class="text-decoration-none pri-color">Clear Setting</a>


      </ul>
      </div>
      <div class=" pb-5 w-100" style="padding-top: 50px; margin-right:10rem; margin-left:5rem;">
        <div class="row">
            <div class="col text-start">
                <h4 class="fw-bold pri-color"> All Products </h4>
            </div>
            <div class="col-2 text-end">
                <select class="form-select form-select-md" id="sort-select" aria-label="Small select example">
                    <option selected value="default">Short By</option>
                    <option value="highest">Highest Price</option>
                    <option value="lowest">Lowest Price</option>
                </select>
            </div>
        </div>

<div class="items mt-3">
    <div class="row g-5">
        @foreach($produks as $produk)
            <div class="col-md-4">
                <a href="{{ route('detailprod', ['id' => $produk->id]) }}" style="text-decoration: none; color: inherit;">
                    <div class="item seed">
                        <div class="card card-product">
                            <img src="{{ asset('storage/' . $produk->image) }}"
                                 height="380vh"
                                 style="object-fit: cover; border-radius:10px !important;"
                                 class="card-img-top" alt="{{ $produk->nama }}">
                            @if($produk->label)
                                <div class="product-label">
                                    <div class="{{ strtolower($produk->label) }}">
                                        {{ ucwords(str_replace('_', ' ', $produk->label)) }}
                                    </div>
                                </div>
                            @endif
                            <div class="card-body" style="padding-left: 0px !important;">
                                <div class="row mb-1">
                                    <div class="col pri-color ">{{ $produk->genus }}</div>
                                    <div class="col pri-color text-end"> ${{ number_format($produk->harga, 2) }} </div>
                                </div>
                                <div class="card-text fw-bold pri-color mb-1">{{ $produk->nama }}</div>
                                <small class="pri-color mb-1">{{ $produk->ukuran }}</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>



      </div>
      </div>
    </div>







    <!-- Footer -->
{{-- <footer class="foots text-center text-lg-start text-muted">

  <section class="d-flex justify-content-center justify-content-lg-between">

  </section>



  <section class="">
    <div class="container text-center text-md-start mt-5">

      <div class="row mt-3">

        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

          <h6 class="text-uppercase fw-bold mb-4">
           <img src="Aset/image/logo_yellow.png" width="100vw">
          </h6>
          <p>
            Here you can use rows and columns to organize your footer content. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit.
          </p>
        </div>


        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="#!" class="text-reset">Angular</a>
          </p>
          <p>
            <a href="#!" class="text-reset">React</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Vue</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Laravel</a>
          </p>
        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" class="text-reset">Pricing</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Settings</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Orders</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Help</a>
          </p>
        </div>



        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            info@example.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
        </div>
      </div>
    </div>
  </section>

  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2021 Copyright:
    <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
</footer> --}}





  <!-- Navbar -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
<script src="Aset/js/general.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
    <script>

  $(document).ready(function () {
  for (var i = 1; i <= $(".slider__slide").length; i++) {
    $(".slider__indicators").append(
      '<div class="slider__indicator" data-slide="' + i + '"></div>'
    );
  }
  setTimeout(function () {
    $(".slider__wrap").addClass("slider__wrap--hacked");
  }, 1000);
});

function goToSlide(number) {
  $(".slider__slide").removeClass("slider__slide--active");
  $(".slider__slide[data-slide=" + number + "]").addClass(
    "slider__slide--active"
  );
}

$(".slider__next, .go-to-next").on("click", function () {
  var currentSlide = Number($(".slider__slide--active").data("slide"));
  var totalSlides = $(".slider__slide").length;
  currentSlide++;
  if (currentSlide > totalSlides) {
    currentSlide = 1;
  }
  goToSlide(currentSlide);
});
    </script>
    <script>
        $(document).ready(function () {
            $('#registerform').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        // Handle success response
                        alert('Registration successful!');
                        $('#logreg').modal('hide');
                    },
                    error: function (xhr) {
                        // Handle error response
                        alert('An error occurred.');
                    }
                });
            });
        });
        </script>

<script>
  $(document).ready(function() {
      $('.filter').change(function() {
          var selected = $('.filter:checked').map(function() {
              return this.value;
          }).get();

          $('.item').hide(); // Hide all items

          if (selected.length) {
              selected.forEach(function(value) {
                  $('.item.' + value).show(); // Show selected items
              });
          } else {
              $('.item').show(); // Show all if no checkbox is checked
          }
      });
  });

  $(document).ready(function() {
    $('.nav-link').click(function() {
        // Find the icon within the clicked nav-link
        var icon = $(this).find('.arrowIcon');

        // Toggle the classes based on the current icon state
        if (icon.hasClass('fa-chevron-up')) {
            icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
        } else {
            icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
        }
    });
});


  $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val().toLowerCase(); // Get the input value and convert to lowercase
                $('.genusdata label').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1); // Show/hide based on match
                });
            });
        });

  </script>

  <script>
  const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".sliderange .progress");
let priceGap = 0;

priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);

        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);

        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});
  </script>

    <script>
        $(document).ready(function() {
            // Filter Products
            function filterProducts() {
                var selectedSizes = $('.filter.size:checked').map(function() {
                    return this.value;
                }).get();

                var selectedGenus = $('.filter.genus:checked').map(function() {
                    return this.value;
                }).get();

                // Ambil nilai min dan max dari input harga
                var minPrice = parseFloat($('.input-min').val()) || 0; // Default ke 0 jika tidak ada
                var maxPrice = parseFloat($('.input-max').val()) || Infinity; // Default ke Infinity jika tidak ada

                $('.item').each(function() {
                    var productSize = $(this).find('small').text().trim();
                    var productGenus = $(this).find('.pri-color').first().text().trim();
                    var productPrice = parseFloat($(this).find('.text-end').text().replace('$', '').replace(
                        ',', ''));

                    // Cek apakah produk sesuai dengan filter
                    var sizeMatch = selectedSizes.length ? selectedSizes.includes(productSize) : true;
                    var genusMatch = selectedGenus.length ? selectedGenus.includes(productGenus) : true;
                    var priceMatch = productPrice >= minPrice && productPrice <= maxPrice;

                    // Debugging
                    console.log(
                        `Product Size: ${productSize}, Size Match: ${sizeMatch}, Genus Match: ${genusMatch}, Price Match: ${priceMatch}`
                    );

                    // Tampilkan atau sembunyikan produk berdasarkan hasil filter
                    if (sizeMatch && genusMatch && priceMatch) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Event listeners for filters
            $('.filter').change(function() {
                filterProducts();
            });

            // Sort Products
            $('#sort-select').on('change', function() {
                var selectedValue = $(this).val();
                var items = $('.item');

                if (selectedValue === 'highest') {
                    items.sort(function(a, b) {
                        return parseFloat($(b).find('.text-end').text().replace('$', '').replace(
                                ',', '')) -
                            parseFloat($(a).find('.text-end').text().replace('$', '').replace(',',
                                ''));
                    });
                } else if (selectedValue === 'lowest') {
                    items.sort(function(a, b) {
                        return parseFloat($(a).find('.text-end').text().replace('$', '').replace(
                                ',', '')) -
                            parseFloat($(b).find('.text-end').text().replace('$', '').replace(',',
                                ''));
                    });
                } else if (selectedValue === 'default') {
                    // Jika default, urutkan kembali ke urutan awal
                    items.sort(function(a, b) {
                        return $(a).index() - $(b).index();
                    });
                }

                // Detach items dari DOM dan append kembali dalam urutan baru
                var container = $('.items .row');
                items.detach().appendTo(container);

                // Panggil filterProducts untuk memastikan produk yang ditampilkan sesuai dengan filter
                filterProducts();
            });
            // Clear Settings
            $('#clear-settings').on('click', function(e) {
                e.preventDefault(); // Mencegah link default

                // Reset checkboxes
                $('.filter').prop('checked', false);

                // Reset input harga
                $('.input-min').val(0);
                $('.input-max').val(0);

                // Reset slider
                $('.range-min').val(0);
                $('.range-max').val($('.range-max').attr('max'));

                // Update progress bar
                $('.sliderange .progress').css({
                    left: '0%',
                    right: '0%'
                });

                // Reset dropdown "Short By"
                $('#sort-select').val('default');

                // Tampilkan semua item tanpa filter
                $('.item').show();

                // Panggil fungsi filter untuk menampilkan semua produk
                filterProducts();
            });


            // Slider for Price Range
            const rangeInput = document.querySelectorAll(".range-input input"),
                priceInput = document.querySelectorAll(".price-input input"),
                range = document.querySelector(".sliderange .progress");

            // Update input values when slider changes
            rangeInput.forEach(input => {
                input.addEventListener("input", e => {
                    let minVal = parseInt(rangeInput[0].value),
                        maxVal = parseInt(rangeInput[1].value);

                    // Update the price input fields
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;

                    // Update the progress bar
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";

                    // Filter products based on the new price range
                    filterProducts();
                });
            });

            // Update slider when price input changes
            priceInput.forEach(input => {
                input.addEventListener("input", e => {
                    let minVal = parseInt(priceInput[0].value),
                        maxVal = parseInt(priceInput[1].value);

                    // Ensure min value is less than max value
                    if (maxVal < minVal) {
                        priceInput[1].value = minVal;
                    }

                    // Update the range input fields
                    rangeInput[0].value = minVal;
                    rangeInput[1].value = maxVal;

                    // Update the progress bar
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";

                    // Filter products based on the new price range
                    filterProducts();
                });
            });
        });
    </script>
    <style>
        .item {
            width: 100%;
            flex: 0 0 33.33%;
            box-sizing: border-box;
        }
    </style>
  @endsection

