<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ຈັດການຫ້ອງ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ຫ້ອງ</a></li>
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
                    <div class="d-flex justify-content-between  mb-2">
                        <div class="d-grid gap-3">
                            <button class="btn btn-primary" wire:click.prevent="addNew"><i
                                    class="fa fa-plus-circle"></i>
                                ເພີ່ມຫ້ອງ
                            </button>
                            
                            <a href="{{ Route('manage_rooms') }}" class="btn btn-secondary">

                                ຫ້ອງທັງໜົດ
                                <span class="badge badge-light right">{{ $all_room }}</span>

                            </a>
                            <a href="{{ Route('manage_rooms', ['status' => '0']) }}"
                                class="btn btn-success">ຫ້ອງຫວ່າງ
                                <span class="badge badge-light right">{{ $guest_room }}</span>
                            </a>
                            <a href="{{ Route('manage_rooms', ['status' => '1']) }}" class="btn btn-warning ">ລໍຖ້າ
                                check In
                                <span class="badge badge-light right">{{ $booking_room }}</span>
                            </a>
                            <a href="{{ Route('manage_rooms', ['status' => '2']) }}" class="btn btn-info ">ລໍຖ້າ
                                check out
                                <span class="badge badge-light right">{{ $check_in_room }}</span>
                            </a>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ເລກຫ້ອງ</th>
                                        <th scope="col">ປະເພດຫ້ອງ</th>
                                        <th scope="col">ສະຖານະການຈອງ</th>
                                        <th scope="col">Check In</th>
                                        <th scope="col">Check out</th>
                                        <th scope="col">option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($room as $room)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                {{ $room->room_no }}
                                            </td>
                                            <td>{{ $room->type_room_name }}</td>
                                            @if ($room->status == 0)
                                                <td><a href="{{ route('reservation', ['Roomid' => $room->id]) }}"
                                                        class="btn btn-success">ຫ່ວາງ</a>
                                                </td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                            @if ($room->status == 1)
                                                <td>
                                                    <p href="" class="btn btn-danger">ຈອງແລ້ວ</p>
                                                </td>
                                                <td><a href=""
                                                        wire:click.prevent="check_in({{ $room->id }})"
                                                        class="btn btn-warning">Check In</a></td>
                                                <td>-</td>
                                            @endif
                                            @if ($room->status == 2)
                                                <td>
                                                    <p class="btn btn-danger">ຈອງແລ້ວ</p>
                                                </td>
                                                <td>
                                                    <p class="btn btn-danger">Check In ແລ້ວ</p>
                                                </td>
                                                <td><a href="" class="btn btn-info"
                                                        wire:click.prevent="check_out({{ $room->id }})">
                                                        Check out</a></td>
                                            @endif
                                            <td>
                                                <a href="" class="mr-3 btn btn-info btn-sm"
                                                    wire:click.prevent="showDetail({{ $room->id }})">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="" class="btn btn-warning btn-sm"
                                                    wire:click.prevent="edit({{ $room->id }})">
                                                    <i class="fa fa-edit "></i>
                                                </a>

                                                <a class="ml-3 btn btn-danger btn-sm" href=""
                                                    wire:click.prevent="comfirmRemoval({{ $room->id }})">
                                                    <i class="fa fa-trash "></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="7">NO results found</td>
                                        </tr>
                                    @endforelse
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


    <!-- Modal add Room -->
    <div class="modal fade" id="addRoot" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'createRoom' }}">
                <div class="modal-content">
                    <div class="modal-header bg-info ">
                        @if ($showEditModal)
                            <h4 >ແກ້ໄຂຫ້ອງ</h4>
                        @else
                            <h4 >ເພີ່ມຫ້ອງໃໜ່</h4>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="forn-group">
                            <label for="">ປະເພດຫ້ອງ</label>
                            <select name="room_type_id" id="room_type_id"
                                class="form-control  @error('room_type_id') is-invalid @enderror"
                                wire:model.defer="state.room_type_id" aria-describedby="room_type_id">
                                <option selected>ກະລຸນາເລືອກປະເພດຫ້ອງ</option>
                                @foreach ($roomtype as $type)
                                    <option value="{{ $type->id }}">{{ $type->room_types }}</option>
                                @endforeach
                            </select>
                            @error('room_type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="forn-group">
                            <label for="room_no">ເລກຫ້ອງ</label>
                            <input type="text" wire:model.defer="state.room_no" id="room_no" name="room_no"
                                class="form-control @error('room_no') is-invalid @enderror" aria-describedby="room_no"
                                placeholder="ເລກຫ້ອງ">
                            @error('room_no')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ປິດ</button>

                        @if ($showEditModal)
                            @if ($room_status_edit == 0)
                                <button type="submit" class="btn btn-primary">
                                    <span>ແກ້ໄຂ</span>
                                </button>
                            @else
                                <button type="button" class="btn btn-danger">
                                    <span>ບໍສາມາດແກ້ໄຂໄດ້</span>
                                </button>
                            @endif
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
    <!--end  Modal add Room -->



    <!-- Modal show room status == 0 -->
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
                            <th>ປະເພດຫ້ອງ:</th>
                            <td>
                                {{ $view_room_type }}
                            </td>
                        </tr>

                        <tr>
                            <th>ເລກທີ່:</th>
                            <td>{{ $view_room_no }}</td>
                        </tr>
                        <tr>
                            <th>ສະຖານະຫ້ອງ:</th>
                            @if ($view_room_status == 0)
                                <td><strong>ຫ່ວາງ</strong></td>
                            @endif
                            @if ($view_room_status == 1)
                                <td><strong>ຈອງແລ້ວ</strong></td>
                            @endif
                            @if ($view_room_status == 2)
                                <td><strong>Check In ແລ້ວ</strong></td>
                            @endif
                        </tr>
                    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ປິດ</button>
                </div>
            </div>
        </div>
    </div>
    <!--end Modal show room status == 0 -->


    {{-- modal-check_in --}}
    <div class="modal fade" id="modal_check_in" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="Set_Check_in_data">
                    <div class="modal-header bg-info">
                        <h4>ການ Cheak In</h4>


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">


                            <tr>
                                <th>ຊື່ລູກຄ້າ:</th>
                                <td>
                                    {{ $customer_name }}
                                </td>
                            </tr>

                            <tr>
                                <th>ປະເພດຫ້ອງ:</th>
                                <td> {{ $view_room_type }}</td>
                            </tr>
                            <tr>
                                <th>ເລກຫ້ອງ:</th>
                                <td> {{ $view_room_no }}</td>
                            </tr>
                            <tr>
                                <th>ວັນທີ່ເຂົ້າພັກ:</th>
                                <td> {{ $booking_check_in }}</td>
                            </tr>
                            <tr>
                                <th>ວັນທີ່ອອກ:</th>
                                <td>{{ $booking_check_out }}</td>
                            </tr>
                            <tr>
                                <th>ລາຄາ:</th>
                                <td>{{ $booking_totalprice }} kip</td>
                            </tr>
                        </table>

                        <h5>ເງິນທີ່ຕ້ອງການຈ່າຍກ່ອນ</h5>
                        <div class="forn-group">

                            <input type="number" wire:model.defer="state.advance_payment" id="advance_payment"
                                name="advance_payment"
                                class="form-control @error('advance_payment') is-invalid @enderror"
                                aria-describedby="advance_payment" placeholder="ກະລຸນາປ້ອມຈຳນວນເງິນ">
                            @error('advance_payment')
                                <div class="invalid-feedback">
                                    ກະລຸນາປ້ອມຈຳນວນເງິນທີ່ຕ້ອງການຊຳລະກ່ອນ(ຖ້ມຍັງບໍທັງຊຳລະໃຫ້ປ້ອມ 0)
                                </div>
                            @enderror
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">ຈ່າຍເງິນ & ເຂົ້າພັກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal-check_in --}}


    {{-- modal-check_out --}}
    <div class="modal fade" id="modal_check_out" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="Set_Check_out_data">
                    <div class="modal-header bg-info">
                        <h4>ການ Check Out</h4>


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">


                            <tr>
                                <th>ຊື່ລູກຄ້າ:</th>
                                <td>
                                    {{ $customer_name }}
                                </td>
                            </tr>

                            <tr>
                                <th>ປະເພດຫ້ອງ:</th>
                                <td> {{ $view_room_type }}</td>
                            </tr>
                            <tr>
                                <th>ເລກຫ້ອງ:</th>
                                <td> {{ $view_room_no }}</td>
                            </tr>
                            <tr>
                                <th>ວັນທີ່ເຂົ້າພັກ:</th>
                                <td> {{ $booking_check_in }}</td>
                            </tr>
                            <tr>
                                <th>ວັນທີ່ອອກ:</th>
                                <td>{{ $booking_check_out }}</td>
                            </tr>
                            <tr>
                                <th>ເປັນເງິນທັງໜົດ:</th>
                                <td>{{ number_format($booking_totalprice, 2, '.', ',') }} kip</td>
                            </tr>
                            <tr>
                                <th>ເງິນທີ່ຈ່າຍກ່ອນແລ້ວ:</th>
                                <td>{{ number_format($Advance_Payment, 2, '.', ',') }} kip</td>
                            </tr>
                            <tr>
                                <th>ເງິນທີ່ຕ້ອງຈ່າຍທັງໜົດ:</th>
                                <td>{{ number_format($Remaining_Amount, 2, '.', ',') }} kip</td>
                            </tr>
                        </table>

                        <h5>ຈໍານວນເງິນ</h5>
                        <div class="forn-group">

                            <input type="number" wire:model.defer="state.Remaining_Amount" id="Remaining_Amount"
                                name="Remaining_Amount"
                                class="form-control @error('Remaining_Amount') is-invalid @enderror"
                                aria-describedby="Remaining_Amount" placeholder="ກະລຸນາປ້ອມຈຳນວນເງິນ">
                            @error('Remaining_Amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">ຈ່າຍເງິນ & ອອກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal-check_out --}}

    {{-- comfirmation --}}
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">

                        ລົບຫ້ອງ
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
                            class="fa fa-times mr-1"></i>ປິດ</button>
                    @if ($room_status_edit == 0)
                        <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i
                                class="fa fa-trash mr-1"></i>
                            ລົບ
                        </button>
                    @else
                        <button type="button"class="btn btn-danger"><i class="fa fa-trash mr-1"></i>
                            ບໍສາມາດລົບໄດ້
                        </button>
                    @endif


                </div>
            </div>
            </form>
        </div>
    </div>
    {{-- end comfirmatiom --}}


    {{-- print ບິນ --}}
    <div class="modal fade" id="printP" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-body">

                    <div class="head text-center">
                        <h4 class="mb-4">ຂອບໃຈທີ່ທ່ານໃຊ້ບໍລິການ</h4>

                    </div>
                    <p class="text-start">ຊື່ລູກຄ້າ: {{ $customer_name}} </p>
                    <div class="d-flex justify-content-between">
                        <p class="text-start">ເບີໂທ: {{ $customer_phone}} </p>
                        <p class="text-start">{{$date}}</p>
                    </div>

                    <table class="table text-start">
                        <tr>
                            <td>ວັນທີ່ເຂົ້າພັກ:</td>
                            <td> {{ $check_in}}</td>
                        </tr>
                        <tr>
                            <td>ວັນທີ່ອອກ:</td>
                            <td>{{ $check_out }}</td>
                        </tr>
                        <tr>
                            <td>ຈໍານວນມື້:</td>
                            <td>{{ $day}} ມື້</td>
                        </tr>
                        <tr>
                            <td>ລາຄາຫ້ອງ:</td>
                            <td>{{ number_format($room_price, 2, '.', ',') }} ກິບ</td>
                        </tr>
                        <tr>
                            <td>ລວມເປັນເງິນທັງໜົດ:</td>
                            <td>{{ number_format($room_tatol_p, 2, '.', ',') }} ກິບ</td>
                        </tr>

                    </table>

                    <p class="text-center">CIT SOLE CO.,LTD</p>
                </div>
                <div class="modal-footer">
                    <div class=" mt-4">
                        <div class="float-end d-print-none">
                            <a href="" onclick="printModal()" class="btn btn-success me-1">ພິມບິນ <i
                                    class="fa fa-print"></i></a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ປິດ</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    {{-- end print ບິນ--}}


    {{-- modal edit data with room --}}
    <div class="modal fade" id="modal_edit_data" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="Set_Check_in_data">
                    <div class="modal-header">
                        <h4>Edit</h4>


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">


                            <tr>
                                <th>ຊື່ລູກຄ້າ:</th>
                                <td>
                                    {{ $customer_name }}
                                </td>
                            </tr>

                            <tr>
                                <th>ປະເພດຫ້ອງ:</th>
                                <td> {{ $view_room_type }}</td>
                            </tr>
                            <tr>
                                <th>ເລກຫ້ອງ:</th>
                                <td> {{ $view_room_no }}</td>
                            </tr>
                            <tr>
                                <th>ວັນທີ່ເຂົ້າພັກ:</th>
                                <td> {{ $booking_check_in }}</td>
                            </tr>
                            <tr>
                                <th>ວັນທີ່ອອກ:</th>
                                <td>{{ $booking_check_out }}</td>
                            </tr>
                            <tr>
                                <th>ລາຄາ:</th>
                                <td>{{ $booking_totalprice }} kip</td>
                            </tr>
                        </table>

                        <h5>ເງິນທີ່ຕ້ອງການຈ່າຍກ່ອນ</h5>
                        <div class="forn-group">

                            <input type="number" wire:model.defer="state.advance_payment" id="advance_payment"
                                name="advance_payment"
                                class="form-control @error('advance_payment') is-invalid @enderror"
                                aria-describedby="advance_payment" placeholder="ກະລຸນາປ້ອມຈຳນວນເງິນ">
                            @error('advance_payment')
                                <div class="invalid-feedback">
                                    ກະລຸນາປ້ອມຈຳນວນເງິນທີ່ຕ້ອງການຊຳລະກ່ອນ(ຖ້ມຍັງບໍທັງຊຳລະໃຫ້ປ້ອມ 0)
                                </div>
                            @enderror
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">ຈ່າຍເງິນ & ເຂົ້າພັກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal-check_in --}}


</div>
<script>
    function printModal() {
        const modal = document.getElementById('printP'); // Replace 'modal' with the ID of your modal
        const modalContent = modal.innerHTML; // Get the HTML content of the modal
        const originalContent = document.body.innerHTML; // Save the original HTML content of the page
        document.body.innerHTML = modalContent; // Replace the HTML content of the page with the modal content
        window.print(); // Print the modal
        document.body.innerHTML = originalContent; // Restore the original HTML content of the page
    }
</script>