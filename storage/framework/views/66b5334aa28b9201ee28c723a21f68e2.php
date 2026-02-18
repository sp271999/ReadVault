

<?php $__env->startSection('content'); ?>
<div class="py-6">
  <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
      <h2 class="font-semibold text-xl mb-4">Add Book</h2>

      <?php if($errors->any()): ?>
        <div class="mb-4 text-red-600">
          <ul class="list-disc pl-5">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('books.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="mb-4">
          <label class="block text-sm font-medium">Title</label>
          <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="mt-1 block w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium">Author</label>
          <input type="text" name="author" value="<?php echo e(old('author')); ?>" class="mt-1 block w-full border rounded p-2">
        </div>

       <div class="mb-4">
   <div class="mb-4">
    <label class="block text-sm font-medium">Category</label>

    <select name="category_id"
            class="mt-1 block w-full border rounded p-2"
            required>
        <option value="">-- Select Category --</option>

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->id); ?>"
                <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                <?php echo e($category->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>


  
</div>


        <div class="mb-4">
          <label class="block text-sm font-medium">Quantity</label>
          <input type="number" name="quantity" value="<?php echo e(old('quantity', 1)); ?>" class="mt-1 block w-full border rounded p-2" min="0" required>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium">Book Image</label>
          <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full text-sm" />
          <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
          <img id="imagePreview" src="<?php echo e(asset('images/book-placeholder.png')); ?>" alt="Preview" class="w-32 h-40 object-cover rounded hidden"/>
        </div>

        <div class="flex space-x-2">
          <button type="submit" class="bg-indigo-500 px-4 py-2 rounded text-white">Save Book</button>
          <a href="<?php echo e(route('books.index')); ?>" class="px-4 py-2 rounded border">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e){
    const file = e.target.files[0];
    const preview = document.getElementById('imagePreview');
    if (!file) { preview.classList.add('hidden'); return; }
    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/books/create.blade.php ENDPATH**/ ?>