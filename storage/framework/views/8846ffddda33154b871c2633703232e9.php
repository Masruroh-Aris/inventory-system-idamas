

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Dashboard</h1>
    <p>Selamat datang, <?php echo e(auth()->user()->name); ?> (<?php echo e(auth()->user()->role); ?>)</p>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Produk</h5>
                    <p class="card-text"><?php echo e($products); ?></p>
                    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-light btn-sm">Lihat Produk</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Stock In</h5>
                    <p class="card-text"><?php echo e($stockInTotal); ?></p>
                    <a href="<?php echo e(route('stockin.index')); ?>" class="btn btn-light btn-sm">Lihat Stock In</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Stock Out</h5>
                    <p class="card-text"><?php echo e($stockOutTotal); ?></p>
                    <a href="<?php echo e(route('stockout.index')); ?>" class="btn btn-light btn-sm">Lihat Stock Out</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Transaksi</h5>
                    <p class="card-text"><?php echo e($transactionTotal); ?></p>
                    <a href="<?php echo e(route('transactions.index')); ?>" class="btn btn-light btn-sm">Lihat Transaksi</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="<?php echo e(route('reports.index')); ?>" class="btn btn-info">Lihat Laporan</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SEMESTER 5\Pemrograman Framework\inventory-idamas\inventory-system\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>