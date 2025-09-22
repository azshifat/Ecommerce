<!-- form start -->
<h2>Edit Sub Category</h2>
<form id="EditForm" action="{{ route('subcategory.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Category --}}
    <div class="form-input-group">
        <label for="category_id">Category Id <span class="required" title="Required">*</span></label>
        <select type="text" name="category_id" class="form-input" id="category_id" required>
            @foreach($categories as $item)
                <option value="{{ $item->id }}" {{ $data->category_id == $item->id ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- Name --}}
    <div class="form-input-group">
        <label for="name">Sub Category Name <span class="required" title="Required">*</span></label>
        <input type="text" name="name" class="form-input" id="name" value="{{ $data->name }}">
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="center">
        <button type="submit" class="btn-blue" id="Update">Update</button>
    </div>
</form>