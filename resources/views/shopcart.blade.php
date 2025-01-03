@extends('layouts.app')

@section('content')
<div class="container" style="height: 60vh; margin-top:100px; ">
   <div class="row">
      <div class="col-2 pt-3">
        <a href="{{ route('allproducts') }}">
        <button class="btn py-1 px-4 text-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
          </svg><span> Back </span></button>
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
                  <span>Sub Total</span>
                  <span></span>
               </div>
               <hr>
               <div class="d-flex justify-content-between fw-bold">
                <span>Estimated Sub Total</span>
                <span>${{ $total }}</span>
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
        const itemCheckboxes = document.querySelectorAll('.item-check');
        const checkAll = document.getElementById('checkAll');
        const totalDisplay = document.querySelector('.summary-box .fw-bold span');

        let total = 0;

        // Set semua checkbox tidak tercentang dan hitung ulang total harga
        function updateTotal() {
            total = Array.from(itemCheckboxes).reduce((sum, checkbox) => {
                if (checkbox.checked) {
                    const itemRow = checkbox.closest('[data-item-id]');
                    const price = parseFloat(itemRow.querySelector('.fw-bold').textContent.replace('$', ''));
                    const quantity = parseInt(itemRow.querySelector('input[type="number"]').value);
                    return sum + price * quantity;
                }
                return sum;
            }, 0);

            totalDisplay.textContent = `$${total.toFixed(2)}`;
        }

        // Event listener untuk setiap checkbox
        itemCheckboxes.forEach((checkbox) => {
            checkbox.checked = false; // Tidak tercentang saat halaman dimuat
            checkbox.addEventListener('change', updateTotal);
        });

        // Event listener untuk "Check All/Uncheck All"
        checkAll.addEventListener('change', function () {
            const isChecked = this.checked;
            itemCheckboxes.forEach((checkbox) => {
                checkbox.checked = isChecked;
            });
            updateTotal();
        });

        // Inisialisasi total harga
        updateTotal();
    });
    </script>


<script>
document.querySelectorAll('.qty-increase, .qty-decrease').forEach(function(button) {
  button.addEventListener('click', function() {
    const isIncrease = this.classList.contains('qty-increase');
    const cartItemId = this.dataset.cartItemId; // Ensure you have data-cart-item-id on buttons
    const quantityInput = this.closest('.cart-item').querySelector('.quantity-input');
    let quantity = parseInt(quantityInput.value);

    // Update quantity based on button clicked
    if (isIncrease) {
      quantity++;
    } else {
      quantity--;
    }

    // Validation (quantity cannot be less than 1)
    if (quantity < 1) {
      alert('Quantity cannot be less than 1');
      return;
    }

    // Update database through AJAX (replace with your actual update route)
    fetch("{{ route('cart.updateQuantity', $item->id) }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
      },
      body: JSON.stringify({
        id: cartItemId,
        quantity: quantity,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Update UI if successful
          quantityInput.value = quantity;
          // Update subtotal and total based on the data returned from the server
          this.closest('.cart-item').querySelector('.subtotal').innerText = `$${data.subTotal}`;
          document.querySelector('.total-price').innerText = `$${data.total}`;
        } else {
          alert(data.message || ' Failed to update cart');
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
      });
  });
});
 </script>


@endsection
