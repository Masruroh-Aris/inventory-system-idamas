

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Transaksi</h2>
    <a href="<?php echo e(route('transactions.create')); ?>" class="btn btn-success">Tambah Transaksi</a>
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
                    <th>Harga</th>
                    <th>Total Harga</th>
                    <th>Kasir</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($transaction->product->name ?? '-'); ?></td>
                        <td><?php echo e($transaction->quantity); ?></td>
                        <td><?php echo e(number_format($transaction->price,0,',','.')); ?></td>
                        <td><?php echo e(number_format($transaction->total,0,',','.')); ?></td>
                        <td><?php echo e($transaction->user->name ?? '-'); ?></td>
                        <td><?php echo e($transaction->created_at->format('d/m/Y H:i')); ?></td>
                        <td>
                            <!-- Semua bisa edit -->
                            <a href="<?php echo e(route('transactions.edit', $transaction->id)); ?>" class="btn btn-sm btn-primary">Edit</a>

                            <!-- Hanya admin bisa hapus -->
                            <?php if(auth()->user()->role == 'admin'): ?>
                                <form action="<?php echo e(route('transactions.destroy', $transaction->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada transaksi</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SEMESTER 5\Pemrograman Framework\inventory-idamas\inventory-system\resources\views/transactions/index.blade.php ENDPATH**/ ?>