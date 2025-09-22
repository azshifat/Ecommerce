<!-- form start -->
<h2>Add Category</h2>
<form id="AddForm" action="{{ route('product.insert') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    {{-- Category --}}
    <div class="form-input-group">
        <label for="subcategory_id">Sub Category Id <span class="required" title="Required">*</span></label>
        <select type="text" name="subcategory_id" class="form-input" id="subcategory_id" required>
            <option value="">Select Sub Category</option>
            @foreach($subcategory as $item)
                <option value="{{ $item->id }}">
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
        @error('subcategory_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- Name --}}
    <div class="form-input-group">
        <label for="name">Product Name <span class="required" title="Required">*</span></label>
        <input type="text" name="name" class="form-input" id="name">
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    
    {{-- Descrption --}}
    <div class="form-input-group">
        <label for="description">Descrption<span class="required" title="Required">*</span></label>
        <textarea name="description" class="form-input" id="description"></textarea>
        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    
    {{-- Old Price --}}
    <div class="form-input-group">
        <label for="old_price">Old Price <span class="required" title="Required">*</span></label>
        <input type="text" name="old_price" class="form-input" id="old_price">
        @error('old_price') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- New Price --}}
    <div class="form-input-group">
        <label for="new_price">New Price <span class="required" title="Required">*</span></label>
        <input type="text" name="new_price" class="form-input" id="new_price">
        @error('new_price') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    
    {{-- Image --}}
    <div class="form-input-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-input" id="image">
        <img src="/images/male.png" alt="Selected Image" id="previewImage" style="width:150px; height:150px;">
        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="center">
        <button type="submit" class="btn-blue" id="Insert">Submit</button>
    </div>
</form>


<script>
    document.addEventListener('change', function (e) {
        if (e.target && e.target.id === 'image') {
            let path = e.target.value;
            let extension = path.substring(path.lastIndexOf('.') + 1).toLowerCase();

            let previewImage = document.getElementById('previewImage');

            if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                let file = e.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        previewImage.setAttribute('src', event.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImage.setAttribute('src', "/images/male.png");
                }
            } else {
                previewImage.setAttribute('src', "/images/male.png");
            }
        }
    });
</script>