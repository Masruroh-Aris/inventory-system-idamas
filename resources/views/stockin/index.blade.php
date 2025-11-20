@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Stock In</h2>
    <a href="{{ route('stockin.create') }}" class="btn btn-success">Tambah Stock In</a>
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
                    @forelse($stockins as $index => $stockin)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $stockin->product->name }}</td>
                            <td>{{ $stockin->quantity }}</td>
                            <td>{{ $stockin->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('stockin.edit', $stockin->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('stockin.destroy', $stockin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data stock in</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
