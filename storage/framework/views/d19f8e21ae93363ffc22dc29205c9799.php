

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Laporan</h2>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

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
                    <?php if(auth()->user()->role == 'kasir'): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($transaction->product->name ?? '-'); ?></td>
                        <td><?php echo e($transaction->quantity); ?></td>
                        <td><?php echo e(number_format($transaction->total_price,0,',','.')); ?></td>
                        <td><?php echo e($transaction->note ?? '-'); ?></td>
                        <td><?php echo e($transaction->created_at->format('d/m/Y H:i')); ?></td>
                        <?php if(auth()->user()->role == 'kasir'): ?>
                        <td>
                            <!-- Tombol untuk tambah/edit keterangan -->
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#noteModal<?php echo e($transaction->id); ?>">
                                Tambah/Edit Keterangan
                            </button>

                            <!-- Modal untuk keterangan -->
                            <div class="modal fade" id="noteModal<?php echo e($transaction->id); ?>" tabindex="-1" aria-labelledby="noteModalLabel<?php echo e($transaction->id); ?>" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="noteModalLabel<?php echo e($transaction->id); ?>">Keterangan Transaksi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="<?php echo e(route('reports.addNote')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="modal-body">
                                        <input type="hidden" name="report_id" value="<?php echo e($transaction->id); ?>">
                                        <div class="mb-3">
                                            <label>Keterangan</label>
                                            <textarea name="note" class="form-control" required><?php echo e($transaction->note ?? ''); ?></textarea>
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
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="<?php echo e(auth()->user()->role == 'kasir' ? 7 : 6); ?>" class="text-center">Tidak ada laporan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SEMESTER 5\Pemrograman Framework\inventory-idamas\inventory-system\resources\views/reports/index.blade.php ENDPATH**/ ?>