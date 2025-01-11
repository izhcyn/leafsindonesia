<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leafs Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="Aset/css/general.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</head>

<body>
    @include('partial.navbar')
    @include('partial.offcanvas')

    @yield('content')


    @include('partial.footer')




    <!-- Navbar -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="/Aset/js/general.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            for (var i = 1; i <= $(".slider__slide").length; i++) {
                $(".slider__indicators").append(
                    '<div class="slider__indicator" data-slide="' + i + '"></div>'
                );
            }
            setTimeout(function() {
                $(".slider__wrap").addClass("slider__wrap--hacked");
            }, 1000);
        });

        function goToSlide(number) {
            $(".slider__slide").removeClass("slider__slide--active");
            $(".slider__slide[data-slide=" + number + "]").addClass(
                "slider__slide--active"
            );
        }

        $(".slider__next, .go-to-next").on("click", function() {
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
        $(document).ready(function() {
            $('#registerform').on('submit', function(e) {
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
                    success: function(response) {
                        // Handle success response
                        alert('Registration successful!');
                        $('#logreg').modal('hide');
                    },
                    error: function(xhr) {
                        // Handle error response
                        alert('An error occurred.');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Quantity Increment/Decrement
            $(".qty-increase").click(function() {
                const input = $(this).siblings("input");
                let value = parseInt(input.val());
                input.val(value + 1);
            });

            $(".qty-decrease").click(function() {
                const input = $(this).siblings("input");
                let value = parseInt(input.val());
                if (value > 1) {
                    input.val(value - 1);
                }
            });

            // Check All / Uncheck All functionality
            $("#checkAll").change(function() {
                const isChecked = $(this).prop("checked");
                $(".item-check").prop("checked", isChecked);
            });

            // Update "Check All" based on individual checkboxes
            $(".item-check").change(function() {
                const allChecked = $(".item-check:checked").length === $(".item-check").length;
                $("#checkAll").prop("checked", allChecked);
            });
        });
    </script>

    <script>
        function updateCartCount() {
            $.get('/update-cart-total-items', function(data) {
                $('#cart-count').text(data.total_items);
            });
        }
    </script>
         <script>
            document.addEventListener('DOMContentLoaded', function () {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        alert.classList.add('fade-out');
                        alert.addEventListener('transitionend', () => alert.remove());
                    }, 5000); // 5 detik
                });
            });
        </script>

</body>

</html>
