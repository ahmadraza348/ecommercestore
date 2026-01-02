@extends('backend.layouts.layout')
@section('title', 'All Coupons')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Manage Coupons</h4>
                </div>
                <div class="page-btn">
                    <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addpayment">
                        <img src="{{asset('backend/assets/img/icons/plus.svg')}}" alt="img" class="me-1">Add New Coupon
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset">
                                    <img src="{{asset('backend/assets/img/icons/search-white.svg')}}" alt="img">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>Label</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Starting</th>
                                    <th>Ending</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{$coupon->label}}</td>
                                    <td>{{$coupon->amount}}</td>
                                    <td>{{$coupon->discount_type}}</td>
                                    <td>{{ \Carbon\Carbon::parse($coupon->starting_from)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($coupon->ending_at)->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $coupon->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($coupon->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a class="edit-btn"
                                            data-id="{{ $coupon->id }}"
                                            data-update-url="{{ route('coupons.update', $coupon->id) }}"
                                            data-label="{{ $coupon->label }}"
                                            data-amount="{{ $coupon->amount }}"
                                            data-type="{{ $coupon->discount_type }}"
                                            data-code="{{ $coupon->code }}"
                                            data-start="{{ \Carbon\Carbon::parse($coupon->starting_from)->format('Y-m-d') }}"
                                            data-end="{{ \Carbon\Carbon::parse($coupon->ending_at)->format('Y-m-d') }}"
                                            data-status="{{ $coupon->status }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCouponModal">
                                            <img src="{{ asset('backend/assets/img/icons/edit.svg') }}">
                                        </a>


                                        <!-- Delete Form (hidden) -->
                                        <form id="deleteCat-{{ $coupon->id }}" action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Delete Icon -->
                                        <a onclick="if(confirm('Are you sure to permanently delete this?')) { document.getElementById('deleteCat-{{ $coupon->id }}').submit(); } return false;" class="me-3">
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

    <!-- Add Modal -->
    <div class="modal fade" id="addpayment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('coupons.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Label<span class="manitory">*</span></label>
                                    <input type="text" name="label" class="form-control" value="{{ old('label') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Discount Type<span class="manitory">*</span></label>
                                    <select class="form-control" name="discount_type" id="discount_type" required>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed_amount">Fixed Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Amount<span class="manitory">*</span></label>
                                    <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Code<span class="manitory">*</span></label>
                                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Starting From<span class="manitory">*</span></label>
                                    <input type="datetime-local" class="form-control" name="starting_from" value="{{ old('starting_from') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Ending At<span class="manitory">*</span></label>
                                    <input type="datetime-local" class="form-control" name="ending_at" value="{{ old('ending_at') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="">Choose Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Confirm</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCouponModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Coupon</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <form method="POST" id="editCouponForm">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Label<span class="manitory">*</span></label>
                                    <input type="text" name="label" id="editLabel" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Discount Type<span class="manitory">*</span></label>
                                    <select name="discount_type" id="editType" class="select" required>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed_amount">Fixed Amount</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Amount<span class="manitory">*</span></label>
                                    <input type="text" name="amount" id="editAmount" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Code<span class="manitory">*</span></label>
                                    <input type="text" name="code" id="editCode" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Starting From<span class="manitory">*</span></label>
                                    <input type="datetime-local" name="starting_from" id="editStart" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Ending At<span class="manitory">*</span></label>
                                    <input type="datetime-local" name="ending_at" id="editEnd" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group mb-0">
                                    <label>Status</label>
                                    <select name="status" id="editStatus" class="select" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Update</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


</div>

<script>
    $(document).on('click', '.edit-btn', function() {
        const btn = $(this);

        // Form action
        $('#editCouponForm').attr('action', btn.data('update-url'));

        // Inputs
        $('#editLabel').val(btn.data('label'));
        $('#editAmount').val(btn.data('amount'));
        $('#editCode').val(btn.data('code'));

        // DATE – must already be YYYY-MM-DD
        $('#editStart').val(btn.data('start'));
        $('#editEnd').val(btn.data('end'));

        // SELECTS (plugin-safe)
        $('#editType')
            .val(btn.data('type'))
            .trigger('change');

        $('#editStatus')
            .val(btn.data('status'))
            .trigger('change');
    });
</script>
@endsection