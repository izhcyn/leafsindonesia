@extends('layouts.app')

@section('content')
<div class="container" style="height: 60vh; margin-top:100px;">
   <div class="row">
      <div class="col-2 pt-3">
        <a href="{{ route('allproducts') }}">
        <button class="btn py-1 px-4 text-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
          </svg><span> Back </span>
        </button>
        </a>
      </div>
   </div>

   @if($cartItems->isNotEmpty())
   <div class="container my-5">
      <div class="row">
         <div class="col-lg-8">
            <h2>Your Items</h2>
            <div>
                <input type="checkbox" class="form-check-input" id="checkAll">
                <label class="form-check-label" for="checkAll">Check All / Uncheck All</label>
            </div>
            @foreach($cartItems as $item)
               <div class="d-flex align-items-center mb-4 border-bottom pb-3" data-item-id="{{ $item->id }}">
                  <input type="checkbox" class="form-check-input item-check me-3" checked>
                  <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}" class="cart-item-img me-3" style="width: 100px;">
                  <div>
                    <h5 class="mb-1">{{ $item->genus }}</h5>
                     <p class="mb-1">{{ $item->name }}</p>
                     <p class="small text-muted">Size: {{ $item->ukuran }}</p>
                  </div>
                  <div class="ms-auto text-end">
                     <p class="fw-bold">${{ $item->price }}</p>
                     <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-outline-secondary qty-decrease text-dark">-</button>
                        <input type="number" class="form-control text-center mx-2 quantity-input" style="width: 50px;" value="{{ $item->quantity }}">
                        <button class="btn btn-sm btn-outline-secondary qty-increase text-dark">+</button>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
         <div class="col-lg-4">
            <div class="summary-box card p-3">
               <h4>Summary</h4>
               <div class="d-flex justify-content-between">
                  <span>Estimated Sub Total</span>
                  <span class="fw-bold total-price">${{ $total }}</span>
               </div>
               <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="giftCheckbox">
                <label class="form-check-label" for="giftCheckbox">Send as a gift</label>
               </div>
               <a href="{{ route('checkout.index') }}">
               <button class="btn-checkout mt-3 border-3 w-100" style="background-color: orange;">Check out now!</button>
               </a>
            </div>
         </div>
      </div>
   </div>
   @else
      <div class="alert alert-warning">Your cart is empty.</div>
   @endif

   <script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartContainer = document.querySelector('.col-lg-8'); // Container utama untuk semua item di cart
        const totalDisplay = document.querySelector('.total-price');

        // Fungsi untuk menghitung ulang total harga
        function updateTotal() {
            const itemCheckboxes = document.querySelectorAll('.item-check');
            let total = 0;

            itemCheckboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    const itemRow = checkbox.closest('[data-item-id]');
                    const price = parseFloat(itemRow.querySelector('.fw-bold').textContent.replace('$', ''));
                    const quantity = parseInt(itemRow.querySelector('.quantity-input').value);
                    total += price * quantity;
                }
            });

            totalDisplay.textContent = `$${total.toFixed(2)}`;
        }

        // Delegasi event untuk tombol tambah/kurang dan quantity input
        cartContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('qty-increase') || event.target.classList.contains('qty-decrease')) {
                const isIncrease = event.target.classList.contains('qty-increase');
                const itemRow = event.target.closest('[data-item-id]');
                const cartItemId = itemRow.dataset.itemId; // ID dari item di keranjang
                const quantityInput = itemRow.querySelector('.quantity-input');
                let quantity = parseInt(quantityInput.value);

                // Update quantity
                quantity = isIncrease ? quantity + 1 : Math.max(1, quantity - 1);
                quantityInput.value = quantity;

                // Kirim perubahan ke server via AJAX
                fetch("{{ route('cart.updateQuantity') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: cartItemId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update total harga
                        updateTotal();
                    } else {
                        alert('Failed to update cart: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });

        // Delegasi untuk quantity input langsung
        cartContainer.addEventListener('input', function (event) {
            if (event.target.classList.contains('quantity-input')) {
                const itemRow = event.target.closest('[data-item-id]');
                const cartItemId = itemRow.dataset.itemId;
                const quantity = parseInt(event.target.value);

                if (quantity > 0) {
                    fetch("{{ route('cart.updateQuantity') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: cartItemId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update total harga
                            updateTotal();
                        } else {
                            alert('Failed to update cart: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                } else {
                    event.target.value = 1;
                }
            }
        });

        // Event listener untuk "Check All/Uncheck All"
        document.getElementById('checkAll').addEventListener('change', function () {
            const isChecked = this.checked;
            document.querySelectorAll('.item-check').forEach((checkbox) => {
                checkbox.checked = isChecked;
            });
            updateTotal();
        });

        // Inisialisasi total harga saat halaman dimuat
        updateTotal();
    });
</script>

@endsection
