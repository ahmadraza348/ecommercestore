@extends('backend.layouts.layout')
@section('title', 'All Couponns')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Manage Coupons</h4>
                </div>
                <div class="page-btn">
                    <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addpayment"><img
                            src="{{asset('backend/assets/img/icons/plus.svg')}}" alt="img" class="me-1">Add New Coupon </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{asset('backend/assets/img/icons/search-white.svg')}}"
                                        alt="img"></a>
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
                                @if($coupons->isEmpty())                                  
                                    <tr>
                                        <td colspan="7" class="text-center">No coupons available.</td>
                                    </tr>
                                @else
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{$coupon->label}} </td>
                                    <td>{{$coupon->amount}}</td>
                                    <td>{{$coupon->discount_type}}</td>
                                    <td>{{$coupon->starting_from}}</td>
                                    <td>{{$coupon->ending_at}}</td>
                                    <td>{{ $coupon->status }}</td>
                                    <td class="text-end">
                                        <a data-bs-toggle="modal" data-bs-target="#editcoupon{{$coupon->id}}">
                                            <img src="{{asset('backend/assets/img/icons/edit.svg')}}">
                                        </a>
                                        <!-- Delete Form (hidden) -->
                                            <form id="deleteCat-{{ $coupon->id }}" action="
                                                {{ route('coupons.destroy', $coupon->id) }}
                                                 " method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            
                                            <!-- Delete Icon -->
                                            <a onclick="if(confirm('Are you sure to permanently delete this?')) { document.getElementById('deleteCat-{{ $coupon->id }}').submit(); } return false;" class="me-3">
                                                <img src="{{ asset('backend/assets/img/icons/delete.svg') }}" alt="delete">
                                            </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editcoupon{{$coupon->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Coupon </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Label<span class="manitory">*</span></label>
                                                                <input type="text" name="label" value="{{ $coupon->label }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                 <label>Discount Type<span class="manitory">*</span></label>
                                                                <select name="discount_type" class="form-control" required>
                                                                    <option value="percentage" {{ $coupon->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                                    <option value="fixed_amount" {{ $coupon->discount_type == 'fixed_amount' ? 'selected' : '' }}>Fixed Amount</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                 <label>Amount<span class="manitory">*</span></label>
                                                                <input type="text" name="amount" value="{{ $coupon->amount }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                 <label>Code<span class="manitory">*</span></label>
                                                                <input type="text" name="code" value="{{ $coupon->code }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group" required>
                                                                <label>Starting From<span class="manitory">*</span></label>
                                                                <input type="date"class="form-control"
                                                                    name="starting_from"
                                                                    value="{{ \Carbon\Carbon::parse($coupon->starting_from)->format('Y-m-d') }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group" required>
                                                                <label>Ending At<span class="manitory">*</span></label>
                                                                <input type="date"
                                                                    name="ending_at"class="form-control"
                                                                    value="{{ \Carbon\Carbon::parse($coupon->ending_at)->format('Y-m-d') }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                 <label>Status</label>
                                                                <select name="status" class="form-control" required>
                                                                    <option value="active" {{ $coupon->status=='active'?'selected':'' }}>Active</option>
                                                                    <option value="inactive" {{ $coupon->status=='inactive'?'selected':'' }}>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-submit">Update</button>
                                                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="addpayment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Coupon </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('coupons.create')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Label<span class="manitory">*</span></label>
                                    <input type="text" name="label" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Discount Type<span class="manitory">*</span></label>
                                    <select required class="select" name="discount_type" id="discount_type">
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed_amount">Fixed Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Amount<span class="manitory">*</span></label>
                                    <input type="text" name="amount" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Code<span class="manitory">*</span></label>
                                    <input type="text" name="code" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Starting From<span class="manitory">*</span></label>
                                    <input type="date" class="form-control" name="starting_from" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Ending At<span class="manitory">*</span></label>
                                    <input type="date" class="form-control" name="ending_at" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-0">
                                    <label>Status</label>
                                    <select name="status" class="select" required>
                                        <option>Choose Status</option>
                                        <option value="active"> Active</option>
                                        <option value="inactive"> InActive</option>
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
</div>

@endsection