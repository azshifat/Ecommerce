<!-- form start -->
<h2>Add Sub-Category</h2>
<form id="AddForm" action="{{ route('subcategory.insert') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    {{-- Category --}}
    <div class="form-input-group">
        <label for="subcategory_id">Sub Category Id <span class="required" title="Required">*</span></label>
        <select type="text" name="category_id" class="form-input" id="category_id" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    
    {{-- Name --}}
    <div class="form-input-group">
        <label for="name">Category Name <span class="required" title="Required">*</span></label>
        <input type="text" name="name" class="form-input" id="name">
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="center">
        <button type="submit" class="btn-blue" id="Insert">Submit</button>
    </div>
</form>