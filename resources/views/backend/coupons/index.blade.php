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
                                <th>Discount</th>
                                <th>Type</th>
                                <th>Starting</th>
                                <th>Ending</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               
                                <td>SGST 9% </td>
                                <td>9.00</td>
                                <td>SGST 9% </td>
                                <td>9.00</td>
                                <td>9.00</td>
                                <td>
                                    <div
                                        class="status-toggle d-flex justify-content-between align-items-center">
                                        <input type="checkbox" id="user1" class="check" checked="">
                                        <label for="user1" class="checktoggle">checkbox</label>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a class="me-3" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#editpayment">
                                        <img src="{{asset('backend/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="{{asset('backend/assets/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                </td>
                            </tr>
                     
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
                    <h5 class="modal-title">Add TAX </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tax Name<span class="manitory">*</span></label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tax Rate(%)<span class="manitory">*</span></label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select">
                                    <option>Choose Status</option>
                                    <option> Active</option>
                                    <option> InActive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-submit">Confirm</button>
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editpayment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tax</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tax Name<span class="manitory">*</span></label>
                                <input type="text" value="SGST 4.5%	">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tax Rate(%)<span class="manitory">*</span></label>
                                <input type="text" value="4.50">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select">
                                    <option> Active</option>
                                    <option> InActive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-submit">Update</button>
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection