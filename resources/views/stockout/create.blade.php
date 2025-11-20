@extends('layouts.app')

@section('content')
    <h1>Tambah Stock Out</h1>
    <form action="{{ route('stockout.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Produk</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="quantity" class="form-control" value="1" required>
        </div>
        <div class="mb-3">
            <label>Jenis</label>
            <input type="text" name="type" class="form-control" placeholder="Penjualan / Pemakaian" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('stockout.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
