@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Produk</h1>
    <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="mb-3">
            <label for="genus" class="form-label">genus</label>
            <input type="text" class="form-control" id="genus" name="genus" maxlength="100" required>
        </div>
        <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran</label>
            <select class="form-select" id="ukuran" name="ukuran">
                <option value="">Pilih ukuran</option>
                <option value="seed">Seed</option>
		<option value="seeding">Seeding</option>
                <option value="medium">Medium</option>
                <option value="mature">Mature</option>
            </select>

        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" maxlength="255" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" maxlength="100" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="mb-3">
            <label for="label" class="form-label">Label</label>
            <select class="form-select" id="label" name="label">
                <option value="">Pilih Label</option>
                <option value="hot_item">Hot Item</option>
                <option value="last_stock">Last Stock</option>
                <option value="only_one">Only One</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Produk</button>
    </form>
</div>
@endsection
