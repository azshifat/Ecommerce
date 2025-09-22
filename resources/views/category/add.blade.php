<!-- form start -->
<h2>Add Category</h2>
<form id="AddForm" action="{{ route('category.insert') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

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