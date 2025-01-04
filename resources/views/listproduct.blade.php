@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-2 my-5 " style="background-color: orange; border-radius: 10px;">
           <a href="{{ route('weldone') }}" class="btn py-1 px-4 text-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg> <span> Kembali ke Menu </span></a>
        </div>
     </div>
    <h2 class="mb-4">Product List</h2>
    <table id="productTable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Product Name</th>
          <th>Size</th>
          <th>Genus</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($produks as $key => $produk)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>
                <img src="{{ asset('storage/' . $produk->image) }}" alt="{{ $produk->nama }}" style="max-width: 100px; height: auto;">
            </td>
            <td>{{ $produk->nama }}</td>
            <td>{{ $produk->ukuran }}</td>
            <td>{{ $produk->genus }}</td>
            <td>${{ number_format($produk->harga, 2) }}</td>
            <td>
                <a href="{{ route('edit.product', $produk->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                <form action="{{ route('destroy.product', $produk->id) }}"
                    method="POST" id="delete-form-{{ $produk->id }}"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm"
                        onclick="confirmDelete({{ $produk->id }})">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

    </table>
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
    $('#productTable').DataTable({
        paging: true, // Enable pagination
        searching: true, // Enable search
        pageLength: 5, // Number of rows per page
        lengthChange: true, // Allow users to change number of rows
        info: true, // Show table information
        columnDefs: [
            {
                targets: 0, // Kolom pertama (#)
                orderable: false, // Nonaktifkan pengurutan
                searchable: false, // Nonaktifkan pencarian
                render: function (data, type, row, meta) {
                    return meta.row + 1; // Berikan nomor berdasarkan indeks baris
                }
            }
        ]

        language: {
        search: "Search Products:",
        paginate: {
            next: "Next",
            previous: "Previous"
        }
        }
    });


      // Edit action
      $(document).on('click', '.edit-btn', function () {
        const row = $(this).closest('tr');
        const productName = row.find('td:nth-child(2)').text();
        alert(`Edit product: ${productName}`);
      });

      // Delete action
      $(document).on('click', '.delete-btn', function () {
        if (confirm('Are you sure you want to delete this product?')) {
          const row = $(this).closest('tr');
          $('#productTable').DataTable().row(row).remove().draw();
        }
      });
    });
  </script>
<script>
    function confirmDelete(produkId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + produkId).submit();
        }
    });
}

</script>
