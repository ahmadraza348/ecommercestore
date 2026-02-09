@extends('backend.layouts.layout')
@section('title', 'Manage Coupons - Raza Mall')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{ isset($editingCoupon) ? 'Edit' : 'Add' }} Coupon</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ isset($editingCoupon) ? route('coupons.update', $editingCoupon->id) : route('coupons.store') }}" method="POST">
                            @csrf
                            @if(isset($editingCoupon))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label>Label<span class="manitory">*</span></label>
                                        <input type="text" name="label" class="form-control" value="{{ old('label', $editingCoupon->label ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label>Discount Type<span class="manitory">*</span></label>
                                        <select class="form-control select" name="discount_type" id="discount_type" required>
                                            <option value="percentage" {{ (old('discount_type', $editingCoupon->discount_type ?? '') == 'percentage') ? 'selected' : '' }}>Percentage</option>
                                            <option value="fixed_amount" {{ (old('discount_type', $editingCoupon->discount_type ?? '') == 'fixed_amount') ? 'selected' : '' }}>Fixed Amount</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label>Amount<span class="manitory">*</span></label>
                                        <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $editingCoupon->amount ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label>Code<span class="manitory">*</span></label>
                                        <input type="text" name="code" class="form-control" value="{{ old('code', $editingCoupon->code ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label>Starting From<span class="manitory">*</span></label>
                                        <input type="datetime-local" class="form-control" name="starting_from" value="{{ old('starting_from', isset($editingCoupon) ? \Carbon\Carbon::parse($editingCoupon->starting_from)->format('Y-m-d\TH:i') : '') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label>Ending At<span class="manitory">*</span></label>
                                        <input type="datetime-local" class="form-control" name="ending_at" value="{{ old('ending_at', isset($editingCoupon) ? \Carbon\Carbon::parse($editingCoupon->ending_at)->format('Y-m-d\TH:i') : '') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="active" {{ (old('status', $editingCoupon->status ?? '') == 'active') ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ (old('status', $editingCoupon->status ?? '') == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-submit me-2">{{ isset($editingCoupon) ? 'Update' : 'Confirm' }}</button>
                                <a href="{{ route('coupons.index') }}" class="btn btn-cancel">Cancel</a>
                            </div>
                        </form>
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
                                        <th>Label</th>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $item)
                                    <tr>
                                        <td>{{ $item->label }}</td>
                                        <td><span class="badges bg-lightgreen">{{ $item->code }}</span></td>
                                        <td>{{ $item->amount }} {{ $item->discount_type == 'percentage' ? '%' : 'Flat' }}</td>
                                        <td>
                                            <span class="badges {{ $item->status == 'active' ? 'bg-lightgreen' : 'bg-lightred' }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('coupons.edit', $item->id) }}" class="me-3">
                                                <img src="{{ asset('backend/assets/img/icons/edit.svg') }}" alt="edit">
                                            </a>
                                            <a onclick="if(confirm('Are you sure?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="me-3" style="cursor: pointer;">
                                                <img src="{{ asset('backend/assets/img/icons/delete.svg') }}" alt="delete">
                                            </a>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('coupons.delete', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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