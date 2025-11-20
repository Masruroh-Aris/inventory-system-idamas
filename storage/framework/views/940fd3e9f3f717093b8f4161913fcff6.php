<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar styling */
        body {
            overflow-x: hidden;
        }
        #sidebar {
            min-width: 220px;
            max-width: 220px;
            background-color: #7D8D86; /* Emerald green */
            min-height: 100vh;
        }
        #sidebar .nav-link {
            color: #3E3F29;
        }
        #sidebar .nav-link.active {
            background-color: #BCA88D;
        }
        #main-content {
            margin-left: 50px;
        }
        .navbar-custom {
            background-color: #3E3F29; /* Emerald green */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom navbar-dark">
        <div class="container-fluid">
            <a class="nav-link" href="<?php echo e(route('admin.logout')); ?>"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>
<form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" class="d-none">
    <?php echo csrf_field(); ?>
</form>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar + Content -->
    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="d-flex flex-column p-3">
            <h4 class="text-white">Menu</h4>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="<?php echo e(route('products.index')); ?>" class="nav-link <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>">Produk</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('stockin.index')); ?>" class="nav-link <?php echo e(request()->routeIs('stockin.*') ? 'active' : ''); ?>">Stock In</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('stockout.index')); ?>" class="nav-link <?php echo e(request()->routeIs('stockout.*') ? 'active' : ''); ?>">Stock Out</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('transactions.index')); ?>" class="nav-link <?php echo e(request()->routeIs('transactions.*') ? 'active' : ''); ?>">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('reports.index')); ?>" class="nav-link <?php echo e(request()->routeIs('reports.*') ? 'active' : ''); ?>">Laporan</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="p-4 flex-grow-1">
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH E:\SEMESTER 5\Pemrograman Framework\inventory-idamas\inventory-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>