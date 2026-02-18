<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transaction Report</title>

    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2 align="center">Borrowed Books Transactions</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Book</th>
            <th>Borrowed Date</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($t->id); ?></td>
            <td><?php echo e($t->book->title ?? '-'); ?></td>
            <td><?php echo e($t->borrowed_at); ?></td>
            <td><?php echo e($t->due_date); ?></td>
            <td><?php echo e($t->returned_at ? 'Returned' : 'Not Returned'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/transactions/pdf.blade.php ENDPATH**/ ?>