@extends('backend.layouts.layout')
@section('title', ' Product Images - Raza Mall')

@section('content')
<div class="page-wrapper">
    <div class="content">

        {{-- Page Header --}}
        <div class="page-header">
            <div class="page-title">
                <h4>Add Product Images</h4>
            </div>
        </div>

        {{-- Attribute Form --}}
        <form method="POST" id="attributeForm">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="row">
                <div class="col-md-6">
                    <input type="file" class="form-control" name="images[]" multiple id="">
                </div>
                <div class="col-md-6">
                    <input type="submit" value="Add Images" class="btn btn-primary ">

                </div>
            </div>
        </form>

        {{-- Product Attribute List --}}
        <div class="page-header mt-5">
            <div class="page-title">
                <h4>All Product Images</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all" onclick="selectAll(this)">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th>
                                <th>Order</th>
                                <th>Image</th>
                                <th>Color</th>
                                <th>Featured</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="attributeTableBody">
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" class="select-category" data-id="
                                         "
                                            onchange="toggleDeleteButton()">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <th>1</th>
                                <td>
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="
                                         "
                                            alt="profile image"
                                            style="width:60px; height:60px; border-radius:100px;">
                                    </a>
                                </td>

                                <th>Color</th>
                                <th>Featured</th>
                                <th>Action</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection