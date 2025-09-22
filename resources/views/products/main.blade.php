<div class="container">
    <h2>Products</h2>
    <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add Products</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Sub Category Name</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Old Price</th>
                <th>New Price</th>
                <th>Image</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->subcategory->name }}</td>
                    <td>{{ $item->subcategory->category->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->old_price }}</td>
                    <td>{{ $item->new_price }}</td>
                    <td>{{ $item->image }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('product.delete', $item->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No Products found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>