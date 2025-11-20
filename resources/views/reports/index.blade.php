@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Laporan</h2>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    @if(auth()->user()->role == 'kasir')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $transaction)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $transaction->product->name ?? '-' }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ number_format($transaction->total_price,0,',','.') }}</td>
                        <td>{{ $transaction->note ?? '-' }}</td>
                        <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                        @if(auth()->user()->role == 'kasir')
                        <td>
                            <!-- Tombol untuk tambah/edit keterangan -->
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#noteModal{{ $transaction->id }}">
                                Tambah/Edit Keterangan
                            </button>

                            <!-- Modal untuk keterangan -->
                            <div class="modal fade" id="noteModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="noteModalLabel{{ $transaction->id }}" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="noteModalLabel{{ $transaction->id }}">Keterangan Transaksi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="{{ route('reports.addNote') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="report_id" value="{{ $transaction->id }}">
                                        <div class="mb-3">
                                            <label>Keterangan</label>
                                            <textarea name="note" class="form-control" required>{{ $transaction->note ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role == 'kasir' ? 7 : 6 }}" class="text-center">Tidak ada laporan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
