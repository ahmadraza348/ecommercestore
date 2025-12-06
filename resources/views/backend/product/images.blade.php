@extends('backend.layouts.layout')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <h4 class=" mb-3">Manage Images — {{ $product->name }}</h4>


        {{-- UPLOAD NEW IMAGES --}}
        <dic action="{{ route('admin.product.store-images') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-4">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <select name="color_id" class="form-control" required>
                        <option value="">-- Select Color --</option>
                        @foreach($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">

                    <input type="file" name="images[]" multiple class="form-control">

                </div>
                <div class="col-4">
                 <button class="btn btn-primary ">Upload</button>
                </div>
            </div>
        </dic>
        </form>


        <hr>


        {{-- UPDATE + DELETE --}}
        <form action="{{ route('admin.product.update-images') }}" method="POST">
            @csrf

            <table class="table">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Image</th>
                        <th>Color</th>
                        <th>Featured</th>
                        <th>Back</th>
                        <th>Sort</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($images as $img)
                    <tr>
                        <td>
                            <input type="checkbox" class="delete-check" value="{{ $img->id }}">
                        </td>

                        <td>
                            <img src="{{ asset('storage/'.$img->image) }}" width="80">
                        </td>

                        <td>
                            <select name="images[{{ $img->id }}][color_id]" class="form-control">
                                @foreach($colors as $color)
                                <option value="{{ $color->id }}"
                                    {{ $img->color_id == $color->id ? 'selected' : '' }}>
                                    {{ $color->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <input type="checkbox" name="images[{{ $img->id }}][is_featured]"
                                {{ $img->is_featured ? 'checked' : '' }}>
                        </td>

                        <td>
                            <input type="checkbox" name="images[{{ $img->id }}][is_back]"
                                {{ $img->is_back ? 'checked' : '' }}>
                        </td>

                        <td>
                            <input type="number" name="images[{{ $img->id }}][sort_order]"
                                value="{{ $img->sort_order }}" class="form-control" style="width:80px;">
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

            <button class="btn btn-sm btn-success mt-2">Update All</button>
        </form>


        {{-- BULK DELETE FORM --}}
        <form id="delete-form" action="{{ route('admin.product.delete-images') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="delete_ids" id="delete-ids">
        </form>

        <button class="btn btn-danger btn-sm mt-2" onclick="bulkDelete()">Delete</button>

    </div>
</div>

<script>
    function bulkDelete() {
        const ids = [...document.querySelectorAll('.delete-check:checked')].map(c => c.value);
        if (!ids.length) {
            alert('No images selected');
            return;
        }
        document.getElementById('delete-ids').value = ids.join(',');
        document.getElementById('delete-form').submit();
    }
</script>

@endsection