@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Stock Out</h2>
    <a href="{{ route('stockout.create') }}" class="btn btn-success">Tambah Stock Out</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockouts as $index => $stockout)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $stockout->product->name }}</td>
                            <td>{{ $stockout->quantity }}</td>
                            <td>{{ $stockout->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('stockout.edit', $stockout->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('stockout.destroy', $stockout->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data stock out</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
