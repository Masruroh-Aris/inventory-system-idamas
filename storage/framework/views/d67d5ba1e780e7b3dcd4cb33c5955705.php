

<?php $__env->startSection('content'); ?>
    <h1>Tambah Transaksi</h1>
    <form action="<?php echo e(route('transactions.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label>Produk</label>
            <select name="product_id" class="form-control" required>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> (Stok: <?php echo e($product->stock); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="quantity" class="form-control" value="1" required>
        </div>
        <div class="mb-3">
            <label>Harga per Unit</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo e(route('transactions.index')); ?>" class="btn btn-secondary">Kembali</a>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SEMESTER 5\Pemrograman Framework\inventory-idamas\inventory-system\resources\views/transactions/create.blade.php ENDPATH**/ ?>