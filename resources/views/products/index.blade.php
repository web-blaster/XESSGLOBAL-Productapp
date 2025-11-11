<x-app-layout>
    @section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-xl font-bold mb-4">Products</h1>

        <a href="{{ route('products.create') }}"
           class="px-4 py-2 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 
           text-white font-semibold rounded-lg shadow-md hover:from-red-500 hover:to-yellow-500 
           transition-colors duration-300 mb-4 inline-block">
            Add Product
        </a>

        @if(session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <!-- Responsive Table Wrapper -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Description</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Stock</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $product->name }}</td>
                            <td class="border px-4 py-2">{{ $product->description }}</td>
                            <td class="border px-4 py-2">{{ $product->price }}</td>
                            <td class="border px-4 py-2">{{ $product->stock }}</td>
                            <td class="border px-4 py-2 flex flex-wrap gap-2">
                                <a href="{{ route('products.edit', $product) }}" 
                                   class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                   Edit
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                                            onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
