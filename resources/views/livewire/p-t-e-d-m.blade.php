<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">PT-EDM</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li> --}}
                                <li class="breadcrumb-item active">PT-EDM</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="customerList">
                        <div class="card-header border-bottom-dashed">

                            <div class="row g-4 align-items-center">
                                <div class="col-sm">
                                    <div>
                                        <h5 class="card-title mb-0">PT List</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-soft-danger" id="remove-actions"
                                            onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <button type="button" class="btn btn-info"><i
                                                class="ri-file-download-line align-bottom me-1"></i> Import</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (session()->has('success'))
                            <div id="alert-box" class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div id="alert-box" class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <script>
                            document.addEventListener('hide-alerts', () => {
                                setTimeout(() => {
                                    let alerts = document.querySelectorAll('.alert');
                                    alerts.forEach(alert => {
                                        alert.style.transition = "opacity 0.5s";
                                        alert.style.opacity = "0";
                                        setTimeout(() => alert.remove(), 500); // Remove o alerta da DOM
                                    });
                                }, 5000);
                            });
                        </script>

                        <div class="card-body border-bottom-dashed border-bottom">
                            <form wire:submit="save" method="post">
                                <div class="row g-3">
                                    <div class="col-xl-4">
                                        <div class="search-box">
                                            <input type="text" class="form-control" wire:model="name"
                                                placeholder="Write the name or code of that PT - EDM" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xl-8">
                                        <div class="row g-3">
                                            <div class="col-sm-4">
                                                <div>
                                                    <select class="form-control" data-plugin="choices" data-choices
                                                        required data-choices-search-true wire:model="city"
                                                        id="province_city">
                                                        <option value="">Selecione uma cidade ou província
                                                        </option>
                                                        <option value="Maputo">Maputo (Cidade)</option>
                                                        <option value="Maputo_Provincia">Maputo (Província)</option>
                                                        <option value="Gaza">Gaza</option>
                                                        <option value="Inhambane">Inhambane</option>
                                                        <option value="Sofala">Sofala</option>
                                                        <option value="Manica">Manica</option>
                                                        <option value="Tete">Tete</option>
                                                        <option value="Zambezia">Zambézia</option>
                                                        <option value="Nampula">Nampula</option>
                                                        <option value="Cabo_Delgado">Cabo Delgado</option>
                                                        <option value="Niassa">Niassa</option>
                                                    </select>
                                                    @error('city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!--end col-->
                                            <div class="col-sm-4">
                                                <div>
                                                    <select class="form-control" data-plugin="choices" data-choices
                                                        data-choices-search-false wire:model="neighborhood"
                                                        id="idStatus" required>
                                                        <option value="">Selecione uma cidade ou província
                                                        </option>
                                                        <option value="Mozambique">Mozambique</option>
                                                    </select>
                                                    @error('neighborhood')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-sm-4">
                                                <div>
                                                    <button type="submit" class="btn btn-success w-100"><i
                                                            class="ri-add-line align-bottom me-1"></i>Add
                                                        PT-EDM</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card mb-1">
                                    <table class="table align-middle" id="customerTable">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll"
                                                            value="option">
                                                    </div>
                                                </th>

                                                <th class="sort" data-sort="customer_name">PT Code / Name</th>
                                                <th class="sort" data-sort="email">Location</th>
                                                <th class="sort" data-sort="phone">Another Location</th>
                                                <th class="sort" data-sort="phone">Created_at</th>
                                                <th class="sort" data-sort="phone"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($pts as $pt)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="chk_child" value="option1">
                                                        </div>
                                                    </th>
                                                    <td class="customer_name">{{ $pt['name'] }}</td>
                                                    <td class="email">{{ $pt['city'] }}</td>
                                                    <td class="phone">{{ $pt['neighborhood'] }}</td>
                                                    <td class="date">
                                                        {{ \Carbon\Carbon::parse($pt['created_at'])->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td>
                                                        <ul class="list-inline hstack gap-2 mb-0">
                                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                                <a href="#" wire:click="edit({{ $pt['id'] }})" class="text-primary d-inline-block edit-item-btn">
                                                                    <i class="ri-pencil-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-placement="top"
                                                                title="Remove">
                                                                <a class="text-danger d-inline-block remove-item-btn"
                                                                    data-bs-toggle="modal"
                                                                    href="#deleteRecordModal{{ $pt['id'] }}">
                                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                {{-- *Modal Edit --}}

                                                <script>
                                                    window.addEventListener('show-edit-modal', event => {
                                                        var modal = new bootstrap.Modal(document.getElementById(`shwModal`));
                                                        modal.show();
                                                    });

                                                    window.addEventListener('close-edit-modal', event => {
                                                        var modal = bootstrap.Modal.getInstance(document.getElementById('shwModal'));
                                                        if (modal) {
                                                            modal.hide();
                                                        }

                                                        setTimeout(() => {
                                                            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                                                            document.body.classList.remove('modal-open');
                                                        }, 10);
                                                    });
                                                </script>

                                                <div class="modal fade" id="shwModal"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light p-3">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                    PT - EDM</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"
                                                                    id="close-modal"
                                                                    wire:click="$dispatch('close-edit-modal')">
                                                                </button>
                                                            </div>

                                                            <form class="tablelist-form"
                                                                wire:submit.prevent="update({{ $edit_id }})">
                                                                <div class="modal-body">
                                                                    <input type="hidden" wire:model="edit_id" />

                                                                    <div class="mb-3">
                                                                        <label for="customername-field"
                                                                            class="form-label">PT Name / Code</label>
                                                                        <input type="text"
                                                                            class="form-control @error('edit_name') is-invalid @enderror"
                                                                            wire:model="edit_name" required />
                                                                        @error('edit_name')
                                                                            <span class="text-danger"
                                                                                x-data="{ show: true }"
                                                                                x-init="setTimeout(() => show = false, 10000)" x-show="show">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="status-field"
                                                                            class="form-label">City or Province</label>
                                                                        <select
                                                                            class="form-control @error('edit_city') is-invalid @enderror"
                                                                            wire:model="edit_city" required>
                                                                            <option value="">Select a city
                                                                            </option>
                                                                            <option value="Maputo">Maputo (Cidade)
                                                                            </option>
                                                                            <option value="Maputo_Provincia">Maputo
                                                                                (Província)</option>
                                                                            <option value="Gaza">Gaza</option>
                                                                            <option value="Inhambane">Inhambane
                                                                            </option>
                                                                            <option value="Sofala">Sofala</option>
                                                                            <option value="Manica">Manica</option>
                                                                            <option value="Tete">Tete</option>
                                                                            <option value="Zambezia">Zambézia</option>
                                                                            <option value="Nampula">Nampula</option>
                                                                            <option value="Cabo_Delgado">Cabo Delgado
                                                                            </option>
                                                                            <option value="Niassa">Niassa</option>
                                                                        </select>
                                                                        @error('edit_city')
                                                                            <span class="text-danger"
                                                                                x-data="{ show: true }"
                                                                                x-init="setTimeout(() => show = false, 10000)" x-show="show">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="status-field"
                                                                            class="form-label">Country</label>
                                                                        <select
                                                                            class="form-control @error('edit_neighborhood') is-invalid @enderror"
                                                                            wire:model="edit_neighborhood" required>
                                                                            <option value="">Select a Country
                                                                            </option>
                                                                            <option value="Mozambique">Mozambique
                                                                            </option>
                                                                        </select>
                                                                        @error('edit_neighborhood')
                                                                            <span class="text-danger"
                                                                                x-data="{ show: true }"
                                                                                x-init="setTimeout(() => show = false, 10000)" x-show="show">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <div class="hstack gap-2 justify-content-end">
                                                                        <button type="button" class="btn btn-light"
                                                                            data-bs-dismiss="modal"
                                                                            wire:click="$dispatch('close-edit-modal')">
                                                                            Close
                                                                        </button>
                                                                        <button type="submit" class="btn btn-success"
                                                                            id="add-btn">
                                                                            Update PT
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- *End Modal --}}

                                                <!-- Modal -->
                                                <div class="modal fade zoomIn"
                                                    id="deleteRecordModal{{ $pt['id'] }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close"
                                                                    id="deleteRecord-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mt-2 text-center">
                                                                    <lord-icon
                                                                        src="https://cdn.lordicon.com/gsqxdxog.json"
                                                                        trigger="loop"
                                                                        colors="primary:#f7b84b,secondary:#f06548"
                                                                        style="width:100px;height:100px"></lord-icon>
                                                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                        <h4>Are you sure?</h4>
                                                                        <p class="text-muted mx-4 mb-0">Are you sure
                                                                            you want to remove this record?</p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                    <button type="button" class="btn w-sm btn-light"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn w-sm btn-danger"
                                                                        wire:click="delete({{ $pt['id'] }})"
                                                                        data-bs-dismiss="modal">
                                                                        Yes, Delete It!
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end modal -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#121331,secondary:#08a88a"
                                                style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ customer We did
                                                not find any customer for you search.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
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

                        </div>
                    </div>
                </div>

            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
</div>
