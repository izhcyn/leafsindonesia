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
        <h1>Edit Produk</h1>
        <form action="{{ route('update.product', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="my-3">
                <label for="nama" class="form-label fw-bold">Judul Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" maxlength="100" required
                    value="{{ $produk->nama }}">
            </div>
            <div class="row ">
                <div class="col">
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Gambar Thumbnail</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <p class="text-muted mt-2">Gambar saat ini:
                            <img src="{{ asset('storage/' . $produk->image) }}" alt="{{ $produk->nama }}"
                                style="max-width: 100px">
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="image_2" class="form-label">Gambar lainnya</label>
                        <input type="file" class="form-control" id="image_2" name="image_2">
                        <p class="text-muted mt-2">Gambar saat ini:
                            <img src="{{ asset('storage/' . $produk->image_2) }}" alt="{{ $produk->nama }}"
                                style="max-width: 100px">
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="image_3" class="form-label">Gambar lainnya</label>
                        <input type="file" class="form-control" id="image_3" name="image_3">
                        <p class="text-muted mt-2">Gambar saat ini:
                            <img src="{{ asset('storage/' . $produk->image_3) }}" alt="{{ $produk->nama }}"
                                style="max-width: 100px">
                        </p>
                    </div>
                </div>


            </div>

            <div class="mb-3">
                <label for="genus" class="form-label fw-bold">Genus</label>
                <input type="text" class="form-control" id="genus" name="genus" maxlength="100" required
                    value="{{ $produk->genus }}">
            </div>
            <div class="mb-3">
                <label for="ukuran" class="form-label fw-bold">Ukuran</label>
                <select class="form-select" id="ukuran" name="ukuran">
                    <option value="seed" {{ $produk->ukuran == 'seed' ? 'selected' : '' }}>Seed</option>
                    <option value="seeding" {{ $produk->ukuran == 'seeding' ? 'selected' : '' }}>Seeding</option>
                    <option value="medium" {{ $produk->ukuran == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="mature" {{ $produk->ukuran == 'mature' ? 'selected' : '' }}>Mature</option>
                </select>

            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" maxlength="255" required rows="3">{{ $produk->deskripsi }}</textarea>

            </div>

            <div class="mb-3">
                <label for="price" class="form-label fw-bold">Harga</label>
                <input type="number" class="form-control" id="harga" name="price" required
                    value="{{ $produk->price }}">
            </div>
            <div class="mb-3">
                <label for="label" class="form-label fw-bold">Label</label>
                <select class="form-select" id="label" name="label">
                    <option value="hot_item" {{ $produk->label == 'hot_item' ? 'selected' : '' }}>Hot Item</option>
                    <option value="last_stock" {{ $produk->label == 'last_stock' ? 'selected' : '' }}>Last Stock</option>
                    <option value="only_one" {{ $produk->label == 'only_one' ? 'selected' : '' }}>Only One</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label fw-bold">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required
                    value="{{ $produk->stock }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Produk</button>
        </form>
    </div>
@endsection
