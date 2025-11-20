@extends('layouts.app')

@section('content')
    <h1>Edit Stock In</h1>
    <form action="{{ route('stockin.update', $stockin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Produk</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $stockin->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="quantity" class="form-control" value="{{ $stockin->quantity }}" required>
        </div>
        <div class="mb-3">
            <label>Harga per Unit</label>
            <input type="number" name="price" class="form-control" value="{{ $stockin->price }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('stockin.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
