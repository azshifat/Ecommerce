<!-- form start -->
<h2>Edit Category</h2>
<form id="EditForm" action="{{ route('category.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Name --}}
    <div class="form-input-group">
        <label for="name">Category Name <span class="required" title="Required">*</span></label>
        <input type="text" name="name" class="form-input" id="name" value="{{ $data->name }}">
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="center">
        <button type="submit" class="btn-blue" id="Update">Update</button>
    </div>
</form>