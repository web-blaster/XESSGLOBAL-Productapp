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

        <table class="min-w-full bg-white shadow rounded">
            <thead>
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
                <tr>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->description }}</td>
                    <td class="border px-4 py-2">{{ $product->price }}</td>
                    <td class="border px-4 py-2">{{ $product->stock }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('products.edit', $product) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>