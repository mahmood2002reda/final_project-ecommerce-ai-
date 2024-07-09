<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModal" aria-hidden="true" wire:ignore.self>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addBrandModal">Add Brands</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="validateAndStoreBrand">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Brand Name</label>
                        <input type="text" class="form-control" wire:model.defer="name" id="name-input" />
                        @error('name') <small class="text-danger">{{$message}}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Brand Slug</label>
                        <input type="text" class="form-control" wire:model.defer="slug" id="slug-input" />
                        @error('slug') <small class="text-danger">{{$message}}</small> @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="category-input">Category</label>
                        <select class="form-control" id="vendor-input" wire:model.defer="category_id">
                            <option value="">--Select category--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label for="vendor-input">Vendor</label>
                        <select class="form-control" id="vendor-input" wire:model.defer="vendor_id">
                            <option value="">--Select Vendor--</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                        @error('vendor_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Brand Status</label><br>
                        <input type="checkbox" wire:model.defer="active" id="active-checkbox" />Checked=Visible, Unchecked=Hidden
                        @error('active') <small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Brand delete model --}}
<div   wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModal">delete Brand</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
     <form wire:submit.prevent="destroyBrand" >
        <div class="modal-body">
          <h6>Are you sure you want to delete this data?</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
          <button type="submit"  class="btn btn-primary"  data-bs-dismiss="modal" >Yes delete</button>
        </div>
        </form>
      </div>
    </div>
  </div>

    {{-- Do your work, then step back. --}}
    <!-- Modal -->


@push('script')


            <script>

Livewire.on('closeModal', () => {
            $('#addBrandModal').modal('hide');
            Livewire.find('admin.brands.modal-form').call('resetFields');
        });

        $('#addBrandModal').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();

})

    </script>
@endpush

