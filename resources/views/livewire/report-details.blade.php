<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Report Details</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{route('Reports')}}" wire:navigate>Reports</a></li>
                                        <li class="breadcrumb-item active">Report Details</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row justify-content-center">
                        <div class="col-xxl-9">
                            <div class="card" id="demo">
                                <div class="row">
                                    
                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="row g-3">
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                                    <h5 class="fs-14 mb-0">#VL<span id="invoice-no">25000355</span></h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                                    <h5 class="fs-14 mb-0"><span id="invoice-date">23 Nov, 2021</span> <small class="text-muted" id="invoice-time">02:36PM</small></h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                                    <span class="badge badge-soft-success fs-11" id="payment-status">Paid</span>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                                    <h5 class="fs-14 mb-0">$<span id="total-amount">755.96</span></h5>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4 border-top border-top-dashed">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing Address</h6>
                                                    <p class="fw-medium mb-2" id="billing-name">David Nichols</p>
                                                    <p class="text-muted mb-1" id="billing-address-line-1">305 S San Gabriel Blvd</p>
                                                    <p class="text-muted mb-1"><span>Phone: +</span><span id="billing-phone-no">(123) 456-7890</span></p>
                                                    <p class="text-muted mb-0"><span>Tax: </span><span id="billing-tax-no">12-3456789</span> </p>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Shipping Address</h6>
                                                    <p class="fw-medium mb-2" id="shipping-name">David Nichols</p>
                                                    <p class="text-muted mb-1" id="shipping-address-line-1">305 S San Gabriel Blvd</p>
                                                    <p class="text-muted mb-1"><span>Phone: +</span><span id="shipping-phone-no">(123) 456-7890</span></p>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                    <div class="col-lg-12" style="margin-top:-3rem">
                                        <div class="card-body p-4">
                                            <div class="mt-4">
                                                <div class="alert alert-info">
                                                    <p class="mb-0"><span class="fw-semibold">NOTES:</span>
                                                        <span id="note">All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or
                                                            credit card or direct payment online. If account is not paid within 7
                                                            days the credits details supplied as confirmation of work undertaken
                                                            will be charged the agreed quoted fee noted above.<br>All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or
                                                            credit card or direct payment online. If account is not paid within 7
                                                            days the credits details supplied as confirmation of work undertaken
                                                            will be charged the agreed quoted fee noted above
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                                <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                                                {{-- <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download</a> --}}
                                            </div>
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

</div>
