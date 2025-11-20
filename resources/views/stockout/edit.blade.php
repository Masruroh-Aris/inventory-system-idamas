@extends('layouts.app')

@section('content')
    <h1>Edit Stock Out</h1>
    <form action="{{ route('stockout.update', $stockout->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Produk</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $stockout->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="quantity" class="form-control" value="{{ $stockout->quantity }}" required>
        </div>
        <div class="mb-3">
            <label>Jenis</label>
            <input type="text" name="type" class="form-control" value="{{ $stockout->type }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('stockout.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
