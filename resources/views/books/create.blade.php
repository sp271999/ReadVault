@extends('layouts.app')

@section('content')
<div class="py-6">
  <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
      <h2 class="font-semibold text-xl mb-4">Add Book</h2>

      @if ($errors->any())
        <div class="mb-4 text-red-600">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
          <label class="block text-sm font-medium">Title</label>
          <input type="text" name="title" value="{{ old('title') }}" class="mt-1 block w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium">Author</label>
          <input type="text" name="author" value="{{ old('author') }}" class="mt-1 block w-full border rounded p-2">
        </div>

       <div class="mb-4">
   <div class="mb-4">
    <label class="block text-sm font-medium">Category</label>

    <select name="category_id"
            class="mt-1 block w-full border rounded p-2"
            required>
        <option value="">-- Select Category --</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>


  
</div>


        <div class="mb-4">
          <label class="block text-sm font-medium">Quantity</label>
          <input type="number" name="quantity" value="{{ old('quantity', 1) }}" class="mt-1 block w-full border rounded p-2" min="0" required>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium">Book Image</label>
          <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full text-sm" />
          @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
          <img id="imagePreview" src="{{ asset('images/book-placeholder.png') }}" alt="Preview" class="w-32 h-40 object-cover rounded hidden"/>
        </div>

        <div class="flex space-x-2">
          <button type="submit" class="bg-indigo-500 px-4 py-2 rounded text-white">Save Book</button>
          <a href="{{ route('books.index') }}" class="px-4 py-2 rounded border">Cancel</a>
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
@endsection
