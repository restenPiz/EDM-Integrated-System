<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Report List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                <li class="breadcrumb-item active">Reports List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="invoiceList">
                        <div class="card-header border-0">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1">Reports</h5>
                                <div class="flex-shrink-0">
                                    <div class="d-flex gap-2 flex-wrap">
                                        <button class="btn btn-primary" id="remove-actions"
                                            onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
                            <form>
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-12">
                                        <div class="search-box">
                                            <input type="text" class="form-control search bg-light border-light"
                                                placeholder="Search for customer, email, country, status or something...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-4">
                                        <input type="text" class="form-control bg-light border-light"
                                            id="datepicker-range" placeholder="Select date">
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-4">
                                        <div class="input-light">
                                            <select class="form-control" data-choices data-choices-search-false
                                                name="choices-single-default" id="idStatus">
                                                <option value="">Status</option>
                                                <option value="all" selected>All</option>
                                                <option value="Unpaid">Unpaid</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Cancel">Cancel</option>
                                                <option value="Refund">Refund</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-xxl-1 col-sm-4">
                                        <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
                                            <i class="ri-equalizer-fill me-1 align-bottom"></i> Filters
                                        </button>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card">
                                    <table class="table align-middle table-nowrap" id="invoiceTable">
                                        <thead class="text-muted">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort text-uppercase" data-sort="invoice_id">ID</th>
                                                <th class="sort text-uppercase" data-sort="customer_name">EDM TechInician
                                                </th>
                                                <th class="sort text-uppercase" data-sort="email">Email</th>
                                                <th class="sort text-uppercase" data-sort="country">Country</th>
                                                <th class="sort text-uppercase" data-sort="date">Date</th>
                                                <th class="sort text-uppercase" data-sort="status">Status</th>
                                                <th class="sort text-uppercase" data-sort="action"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all" id="invoice-list-data">
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child"
                                                            value="option1">
                                                    </div>
                                                </th>
                                                <td class="date">
                                                    <a href="{{route('ReportDetails')}}" wire:navigate>#ABC123</a>
                                                </td>
                                                <td>Mauro Peniel</td>
                                                <td>mauropeniel7@gmail.com</td>
                                                <td>Beira, Mozambique</td>
                                                <td>11/09/2002</td>
                                                <td><span class="badge bg-danger">Cancelled</span></td>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top"
                                                            title="Remove">
                                                            <a class="text-danger d-inline-block remove-item-btn"
                                                                data-bs-toggle="modal" href="#deleteRecordModal">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#121331,secondary:#08a88a"
                                                style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ invoices We did
                                                not find any invoices for you search.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade flip" id="deleteOrder" tabindex="-1"
                                aria-labelledby="deleteOrderLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-5 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                colors="primary:#405189,secondary:#f06548"
                                                style="width:90px;height:90px"></lord-icon>
                                            <div class="mt-4 text-center">
                                                <h4>You are about to delete a order ?</h4>
                                                <p class="text-muted fs-15 mb-4">Deleting your order will remove all of
                                                    your information from our database.</p>
                                                <div class="hstack gap-2 justify-content-center remove">
                                                    <button
                                                        class="btn btn-link link-success fw-medium text-decoration-none"
                                                        id="deleteRecord-close" data-bs-dismiss="modal"><i
                                                            class="ri-close-line me-1 align-middle"></i> Close</button>
                                                    <button class="btn btn-danger" id="delete-record">Yes, Delete
                                                        It</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
                        </div>
                    </div>

                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container-fluid -->
    </div>
</div>
