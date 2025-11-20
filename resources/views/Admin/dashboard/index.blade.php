@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Selamat datang, {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Produk</h5>
                    <p class="card-text">{{ $products }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-sm">Lihat Produk</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Stock In</h5>
                    <p class="card-text">{{ $stockInTotal }}</p>
                    <a href="{{ route('stockin.index') }}" class="btn btn-light btn-sm">Lihat Stock In</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Stock Out</h5>
                    <p class="card-text">{{ $stockOutTotal }}</p>
                    <a href="{{ route('stockout.index') }}" class="btn btn-light btn-sm">Lihat Stock Out</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Transaksi</h5>
                    <p class="card-text">{{ $transactionTotal }}</p>
                    <a href="{{ route('transactions.index') }}" class="btn btn-light btn-sm">Lihat Transaksi</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('reports.index') }}" class="btn btn-info">Lihat Laporan</a>
    </div>
</div>
@endsection
