@extends('backend.layouts.layout')
@section('title', 'Manage Coupons - Raza Mall')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Manage Coupons</h4>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="card">

                    <div class="card-body">
                       
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table datanew">
                                <thead>
                                    <tr>
                                        <th> Label</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $item)
                                    <tr>
                                        <td>{{ $item->label }} </td>

                                        <td>
                                            <a href="
                                            {{ route('coupons.edit', $item->id) }}
                                             " class="me-3">
                                                <img src="{{ asset('backend/assets/img/icons/edit.svg') }}" alt="edit">
                                            </a>

                                            <form id="deleteCat-{{ $item->id }}" action="
                                                {{ route('coupons.delete', $item->id) }}
                                                 " method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>

                                            <a onclick="if(confirm('Are you sure to permanently delete this?')) { document.getElementById('deleteCat-{{ $item->id }}').submit(); } return false;" class="me-3">
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

    </div>
</div>

@endsection