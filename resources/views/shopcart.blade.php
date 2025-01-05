@extends('layouts.app')

@section('content')
    <div class="container" style="height: 60vh; margin-top:100px;">
        <div class="row">
            <div class="col-2 pt-3">
                <a href="{{ route('allproducts') }}">
                    <button class="btn py-1 px-4 text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg><span> Back </span>
                    </button>
                </a>
            </div>
        </div>

        @if ($cartItems->isNotEmpty())
            <div class="container my-5">
                <div class="row">
                    <div class="col-lg-8">
                        <h2>Your Items</h2>
                        <div>
                            <input type="checkbox" class="form-check-input" id="checkAll">
                            <label class="form-check-label" for="checkAll">Check All / Uncheck All</label>
                        </div>
                        @foreach ($cartItems as $item)
                            <div class="d-flex align-items-center mb-4 border-bottom pb-3"
                                data-item-id="{{ $item->id }}">
                                <input type="checkbox" class="form-check-input item-check me-3" checked>
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}"
                                    alt="{{ $item->name }}" class="cart-item-img me-3" style="width: 100px;">
                                <div>
                                    <h5 class="mb-1">{{ $item->genus }}</h5>
                                    <p class="mb-1">{{ $item->name }}</p>
                                    <p class="small text-muted">Subtotal: <span
                                            class="subtotal">${{ $item->price * $item->quantity }}</span></p>
                                </div>
                                <div class="ms-auto text-end">
                                    <p class="fw-bold">${{ $item->price }}</p>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-outline-secondary qty-decrease text-dark">-</button>
                                        <input type="number" class="form-control text-center mx-2 quantity-input"
                                            style="width: 50px;" value="{{ $item->quantity }}">
                                        <button class="btn btn-sm btn-outline-secondary qty-increase text-dark">+</button>
                                    </div>
                                </div>
                                <!-- Tombol hapus -->
                                <button class="delete-item ms-3">
                                    <i class="bi bi-trash"></i>
                                </button>
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
                                <button class="btn-checkout mt-3 border-3 w-100" style="background-color: orange;">Check out
                                    now!</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">Your cart is empty.</div>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartContainer = document.querySelector('.col-lg-8');
            const totalDisplay = document.querySelector('.total-price');
            const checkAll = document.getElementById('checkAll');
            const checkoutButton = document.querySelector('.btn-checkout');

            // Event listener untuk checkbox item
            cartContainer.addEventListener('change', function(event) {
                if (event.target.classList.contains('item-check')) {
                    updateTotal(); // Hitung ulang total ketika checkbox berubah
                }
            });

            // Event listener untuk tombol Check All/Uncheck All
            checkAll.addEventListener('change', function() {
                const isChecked = this.checked;
                document.querySelectorAll('.item-check').forEach((checkbox) => {
                    checkbox.checked =
                        isChecked; // Atur semua checkbox sesuai dengan status Check All
                });
                updateTotal(); // Hitung ulang total
            });

            // Delegasi event untuk tombol tambah/kurang
            cartContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('qty-increase') || event.target.classList.contains(
                        'qty-decrease')) {
                    const isIncrease = event.target.classList.contains('qty-increase');
                    const itemRow = event.target.closest('[data-item-id]');
                    const quantityInput = itemRow.querySelector('.quantity-input');
                    let quantity = parseInt(quantityInput.value) || 0;

                    // Update kuantitas produk dengan increment 1
                    if (isIncrease) {
                        quantity = quantity++;
                    } else {
                        quantity = Math.max(1, quantity--);
                    }

                    quantityInput.value = quantity;
                    updateQuantityOnServer(itemRow, quantity);
                }
            });

            // Event listener untuk input manual pada input kuantitas
            cartContainer.addEventListener('input', function(event) {
                if (event.target.classList.contains('quantity-input')) {
                    const itemRow = event.target.closest('[data-item-id]');
                    const value = event.target.value;

                    // Allow empty value temporarily for better UX during typing
                    if (value === '') {
                        event.target.value = '';
                        return;
                    }

                    let quantity = parseInt(value);

                    // If the parsed value is NaN or less than 1, set to 1
                    if (isNaN(quantity) || quantity < 1) {
                        quantity = 1;
                    }

                    event.target.value = quantity;
                    updateQuantityOnServer(itemRow, quantity);
                }
            });

            // Add blur event listener for quantity input
            cartContainer.addEventListener('blur', function(event) {
                if (event.target.classList.contains('quantity-input')) {
                    const itemRow = event.target.closest('[data-item-id]');
                    let quantity = parseInt(event.target.value) || 1;
                    quantity = Math.max(1, quantity);
                    event.target.value = quantity;
                    updateQuantityOnServer(itemRow, quantity);
                }
            }, true);

            // Event listener untuk tombol hapus
            cartContainer.addEventListener('click', function(event) {
                if (event.target.closest('.delete-item')) {
                    const deleteButton = event.target.closest('.delete-item');
                    const itemRow = deleteButton.closest('[data-item-id]');
                    const cartItemId = itemRow.dataset.itemId;

                    // Konfirmasi sebelum menghapus
                    if (confirm('Are you sure you want to delete this item?')) {
                        // Hapus item dari server
                        fetch('{{ route('cart.remove') }}', {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    id: cartItemId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    itemRow.remove(); // Hapus item dari tampilan
                                    updateTotal(); // Perbarui total harga
                                } else {
                                    alert('Failed to delete item: ' + data.message);
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                }
            });

            function updateQuantityOnServer(itemRow, quantity) {
                const cartItemId = itemRow.dataset.itemId;

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
                            const subTotalElement = itemRow.querySelector('.subtotal');
                            subTotalElement.textContent = `$${data.subTotal.toFixed(2)}`;
                            updateTotal();
                        } else {
                            alert('Failed to update cart: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            function updateTotal() {
                const itemCheckboxes = document.querySelectorAll('.item-check');
                let total = 0;

                itemCheckboxes.forEach((checkbox) => {
                    const itemRow = checkbox.closest('[data-item-id]');
                    const price = parseFloat(itemRow.querySelector('.fw-bold').textContent.replace('$',
                        ''));
                    const quantity = parseInt(itemRow.querySelector('.quantity-input').value) || 0;
                    const subTotalElement = itemRow.querySelector('.subtotal');

                    const subTotal = price * quantity;
                    subTotalElement.textContent = `$${subTotal.toFixed(2)}`;

                    if (checkbox.checked) {
                        total += subTotal;
                    }
                });

                totalDisplay.textContent = `$${total.toFixed(2)}`;
            }

            checkoutButton.addEventListener('click', function(event) {
                event.preventDefault();

                const selectedItems = Array.from(document.querySelectorAll('.item-check:checked'))
                    .map((checkbox) => checkbox.closest('[data-item-id]').dataset.itemId);

                if (selectedItems.length === 0) {
                    alert('Please select at least one item to checkout.');
                    return;
                }

                fetch("{{ route('checkout.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            selectedItems: selectedItems
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = "{{ route('checkout.index') }}";
                        } else {
                            alert('Failed to proceed to checkout: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            updateTotal();
        });
    </script>
    <style>
        .delete-item {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 45px;
            height: 45px;
        }

        .delete-item i {
            font-size: 20px;
            /* Ukuran ikon lebih besar */
        }

        .delete-item:hover {
            background-color: #c0392b;
            transform: scale(1.1);
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
        }
    </style>

@endsection
