@extends('backend.layouts.layout')
@section('title', 'All Categories - Raza Mall')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Manage Categories</h4>
                    <h6>Manage your Product Categories </h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('category.create') }}" class="btn btn-added"><img
                            src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img">Add Category</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Parent</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ $category->image ? asset('uploads/categories/' . $category->image) : asset('backend/assets/img/noimage.png') }}"
                                                    alt="profile image"
                                                    style="width:60px; height:60px; border-radius:100px;">
                                            </a>
                                        </td>
                                        <td>{{ $category->name }} </td>
                                        @if ($category->parent)
                                        <td>{{ $category->parent->name }}</td>
                                    @else
                                        <td>None</td>
                                    @endif
                                    
                                        <td>
                                            @if ($category->is_featured == '1')
                                                <span class="badge rounded-pill bg-success">Yes</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($category->status == '1')
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}" class="me-3">
                                                <img src="{{ asset('backend/assets/img/icons/edit.svg') }}" alt="edit">
                                            </a>
                                            <!-- Delete Form (hidden) -->
                                            <form id="deleteCat-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        
                                            <!-- Delete Icon -->
                                            <a href="javascript:void(0);" onclick="document.getElementById('deleteCat-{{ $category->id }}').submit();" class="me-3">
                                                <img src="{{ asset('backend/assets/img/icons/delete.svg') }}" alt="delete">
                                            </a>
                                        

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
