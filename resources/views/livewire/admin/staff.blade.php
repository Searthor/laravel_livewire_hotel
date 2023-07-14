<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ພະນັກງານ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ພະນັກງານ</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <button class="btn btn-primary" wire:click.prevent="addNew"><i
                                    class="fa fa-plus-circle"></i>
                                ເພີ່ມ
                            </button>
                        </div>



                        <div class="d-flex justify-content-center align-items-center border bg-white pr-2">

                            <input wire:model="searchTerm" type="text" class="form-control border-0"
                                placeholder="ຄົ້ນຫາ...">

                        </div>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">ຊື່ພະນັກງານ</th>
                                        <th scope="col">ຕຳແໜ່ງ</th>
                                        <th scope="col">ເງິນເດືອນ</th>
                                        <th scope="col">ເບີໂທ</th>
                                        <th scope="col">option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eproyees as $emp)
                                        <tr>
                                            <td>{{ $emp->id }}</td>
                                            <td>{{ $emp->emp_name }}</td>
                                            <td>{{ $emp->staff_type }}</td>
                                            <td>{{ number_format($emp->salary, 2, '.', ',') }}</td>
                                            <td>{{ $emp->contact_no }}</td>
                                            <td>
                                                <a href="" class="mr-3 btn btn-info btn-sm"
                                                    wire:click.prevent="showDetail({{ $emp->id }})">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="" class="btn btn-warning btn-sm"
                                                    wire:click.prevent="edit({{ $emp->id }})">
                                                    <i class="fa fa-edit "></i>
                                                </a>

                                                <a class="ml-3 btn btn-danger btn-sm" href=""
                                                    wire:click.prevent="comfirmRemoval({{ $emp->id }})">
                                                    <i class="fa fa-trash "></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addemployees" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'save_employees' }}">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        @if ($showEditModal)
                            <h4>ແກ້ໄຂ</h4>
                        @else
                            <h4>ເພີ່ມໃໜ່</h4>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="forn-group">
                            <label for="">ຕຳແໜ່ງ</label>
                            <select name="staff_type_id" id="staff_type_id"
                                class="form-control  @error('staff_type_id') is-invalid @enderror"
                                wire:model.defer="state.staff_type_id" aria-describedby="staff_type_id">
                                <option selected>ກະລຸນາເລືອກຕຳແໜ່ງ</option>
                                @foreach ($staff_type as $type)
                                    <option value="{{ $type->id }}">{{ $type->staff_type }}</option>
                                @endforeach
                            </select>
                            @error('staff_type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="forn-group">
                            <label for="emp_name">ຊື່ພະນັກງານ</label>
                            <input type="text" wire:model.defer="state.emp_name"
                                class="form-control @error('emp_name') is-invalid @enderror" id="emp_name"
                                aria-describedby="emp_name" placeholder="ຊື່ພະນັກງານ">

                            @error('emp_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="forn-group">
                            <label for="address">ທີ່ຢູ່</label>
                            <textarea type="text" wire:model.defer="state.address" class="form-control @error('address') is-invalid @enderror"
                                id="address" aria-describedby="address" placeholder="ທີ່ຢູ່"></textarea>

                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="forn-group">
                            <label for="contact_no">ເບີໂທ</label>
                            <input type="number" wire:model.defer="state.contact_no"
                                class="form-control @error('contact_no') is-invalid @enderror" id="contact_no"
                                aria-describedby="contact_no" placeholder="ເບີໂທ">

                            @error('contact_no')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="forn-group">
                            <label for="salary">ເງິນເດືອນ</label>
                            <input type="number" wire:model.defer="state.salary"
                                class="form-control @error('salary') is-invalid @enderror" id="salary"
                                aria-describedby="salary" placeholder="ເງິນເດືອນ">

                            @error('salary')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if ($showEditModal)
                            <button type="submit" class="btn btn-primary">
                                <span>ແກ້ໄຂ</span>
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary">
                                <span>ບັກທຶກ</span>
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="showdetail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">

                    <h4>ລາຍລະອຽດ</h4>


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ຊື່ພະນັກງານ:</th>
                            <td>{{ $view_emp_name }}</td>

                        </tr>

                        <tr>
                            <th>ຕຳແໜ່ງ:</th>
                            <td>{{ $view_staff_type }}</td>
                        </tr>
                        <tr>
                            <th>ເງິນເດືອນ:</th>
                            <td>{{ number_format($view_salary, 2, '.', ',') }} ກິບ</td>

                        </tr>
                        <tr>
                            <th>ເບີໂທ:</th>
                            <td>{{ $view_contact_no }}</td>
                        </tr>
                        <tr>
                            <th>ທີ່ຢູ່:</th>
                            <td>{{ $view_address }}</td>
                        </tr>
                    </table>


                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ປິດ</button>
                </div>
            </div>
        </div>
    </div>

    <!--cofirm Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">

                        ລົບ
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>ເຈົ້າໜັ້ນໃຈບໍທີ່ຕ້ອງການລົບ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fa fa-times mr-1"></i>Cancel</button>

                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash mr-1"></i>
                        ລົບ
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>



</div>
