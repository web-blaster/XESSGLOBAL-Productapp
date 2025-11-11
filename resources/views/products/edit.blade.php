<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-xl font-bold mb-4">Edit Product</h1>

        <form id="editProductForm" action="{{ route('products.update', $product) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label>Name</label>
                <input type="text" name="name"
                       value="{{ old('name', $product->name) }}"
                       class="w-full border px-3 py-2 rounded @error('name') border-red-500 @enderror"
                       required minlength="3" maxlength="255" pattern="^[A-Za-z0-9\s]+$"
                       title="Name should be letters, numbers, and spaces only">
                <!-- Backend Error -->
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <!-- Frontend Error -->
                <p class="text-red-500 text-sm mt-1 hidden" id="nameError"></p>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label>Description</label>
                <textarea name="description"
                          class="w-full border px-3 py-2 rounded @error('description') border-red-500 @enderror"
                          maxlength="1000">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-red-500 text-sm mt-1 hidden" id="descriptionError"></p>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label>Price</label>
                <input type="text" name="price"
                       value="{{ old('price', $product->price) }}"
                       class="w-full border px-3 py-2 rounded @error('price') border-red-500 @enderror"
                       required pattern="^\d+(\.\d{1,2})?$"
                       title="Enter a valid decimal number (e.g., 123.45)">
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-red-500 text-sm mt-1 hidden" id="priceError"></p>
            </div>

            <!-- Stock -->
            <div class="mb-4">
                <label>Stock</label>
                <input type="number" name="stock"
                       value="{{ old('stock', $product->stock) }}"
                       class="w-full border px-3 py-2 rounded @error('stock') border-red-500 @enderror"
                       required min="0" step="1">
                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-red-500 text-sm mt-1 hidden" id="stockError"></p>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                Update
            </button>
        </form>
    </div>

    <!-- Frontend JS Validation -->
    <script>
        const form = document.getElementById('editProductForm');
        const fields = {
            name: {
                el: form.querySelector('[name="name"]'),
                errorEl: document.getElementById('nameError'),
                validate: value => /^[A-Za-z0-9\s]{3,255}$/.test(value) ? '' : 'Name must be 3-255 chars, letters/numbers only.'
            },
            price: {
                el: form.querySelector('[name="price"]'),
                errorEl: document.getElementById('priceError'),
                validate: value => /^\d+(\.\d{1,2})$/.test(value) ? '' : 'Enter a valid decimal number (e.g., 123.45).'
            },
            stock: {
                el: form.querySelector('[name="stock"]'),
                errorEl: document.getElementById('stockError'),
                validate: value => Number.isInteger(+value) && +value >= 0 ? '' : 'Stock must be a positive integer.'
            }
        };

        Object.values(fields).forEach(field => {
            field.el.addEventListener('input', () => {
                const error = field.validate(field.el.value);
                if (error) {
                    field.errorEl.textContent = error;
                    field.errorEl.classList.remove('hidden');
                    field.el.classList.add('border-red-500');
                } else {
                    field.errorEl.classList.add('hidden');
                    field.el.classList.remove('border-red-500');
                }
            });
        });

        form.addEventListener('submit', function(event) {
            let hasError = false;
            Object.values(fields).forEach(field => {
                const error = field.validate(field.el.value);
                if (error) {
                    field.errorEl.textContent = error;
                    field.errorEl.classList.remove('hidden');
                    field.el.classList.add('border-red-500');
                    hasError = true;
                }
            });

            if (hasError) {
                event.preventDefault();
                alert('Please fix the errors before submitting.');
            }
        });
    </script>
</x-app-layout>
