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
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <a href="{{ route ('edit.product') }}" class="btn btn-sm btn-warning me-2 edit-btn">Edit</a>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="Aset/css/"> </td>
          
          <td>Product A</td>
          <td>Category 1</td>
          <td>Category 1</td>
          <td>$10</td>
          <td>
            <button class="btn btn-sm btn-warning me-2 edit-btn">Edit</button>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
</div>

@endsection
<script>
    $(document).ready(function () {
      // Initialize DataTable with search and pagination
      $('#productTable').DataTable({
        paging: true, // Enable pagination
        searching: true, // Enable search
        pageLength: 5, // Number of rows per page
        lengthChange: true, // Allow users to change number of rows
        info: true, // Show table information
        language: {
          search: "Search Products:", // Custom label for search box
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