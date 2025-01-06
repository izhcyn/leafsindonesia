@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-2 my-5 " style="background-color: orange; border-radius: 10px;">
                <a href="{{ route('weldone') }}" class="btn py-1 px-4 text-dark"> <svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg> <span> Kembali ke Menu </span></a>
            </div>
        </div>
        <h1>Tambah Produk</h1>
        <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="my-3">
                <label for="nama" class="form-label fw-bold">Judul Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" maxlength="100" required>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Gambar Thumbnail</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="image_2" class="form-label">Gambar lainnya</label>
                        <input type="file" class="form-control" id="image_2" name="image_2">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="image_3" class="form-label">Gambar lainnya</label>
                        <input type="file" class="form-control" id="image_3" name="image_3">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="genus" class="form-label fw-bold">Genus</label>
                <select class="form-select" id="genus" name="genus" required>
                    <option value="">Pilih Genus</option>
                    @foreach ($genusList as $genus)
                        <option value="{{ $genus->name }}">{{ $genus->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="ukuran" class="form-label fw-bold">Ukuran</label>
                <select class="form-select" id="ukuran" name="ukuran">
                    <option value="">Pilih ukuran</option>
                    <option value="seed">Seed</option>
                    <option value="seeding">Seeding</option>
                    <option value="medium">Medium</option>
                    <option value="Mature">Mature</option>
                </select>

            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" maxlength="255" required rows="3"></textarea>

            </div>

            <div class="mb-3">
                <label for="price" class="form-label fw-bold">Harga</label>
                <input type="number" class="form-control" id="harga" name="price" required>
            </div>
            <div class="mb-3">
                <label for="label" class="form-label fw-bold">Label</label>
                <select class="form-select" id="label" name="label">
                    <option value="">Pilih Label</option>
                    <option value="hot_item">Hot Item</option>
                    <option value="last_stock">Last Stock</option>
                    <option value="only_one">Only One</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label fw-bold">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </form>
    </div>
@endsection
