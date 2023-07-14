<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ການຈອງຫ້ອງພັກ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ການຈອງຫ້ອງພັກ</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12" wire:ignore.self>
                    <form class=" needs-validation" autocomplete="off" wire:submit.prevent="booking">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="text-center">ຂໍ້ມູນຫ້ອງ</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">ປະເພດຫ້ອງ</label>

                                        <select type="text"
                                            class="form-control @error('room_type') is-invalid @enderror" required
                                            wire:change="handleCheckRoom_type_DateChange($event.target.value)"
                                            wire:model.defer="state.room_type" id="room_type">

                                            <option selected value="null">ກະລຸນາເລືອກປະເພດຫ້ອງ</option>

                                            @foreach ($room_type as $room_type)
                                                <option value="{{ $room_type->id }}">{{ $room_type->room_types }}
                                                </option>
                                            @endforeach


                                        </select>


                                        @error('room_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">ເລກຫ້ອງ</label>
                                        <select type="text"
                                            class="form-control @error('room_no') is-invalid @enderror" required
                                            wire:model.defer="state.room_no" id="room_no">
                                            @if ($Room_type != null)
                                                <option selected >ກະລຸນາເລືອກຫ້ອງ</option>
                                                @foreach ($room as $roomNO)
                                                    <option value="{{ $roomNO->id }}">
                                                        {{ $roomNO->room_no }}
                                                    </option>
                                                @endforeach
                                                
                                            @else
                                                <option selected class="text-info">ກະລຸນາເລືອກປະເພດຫ້ອງກ່ອນ</option>
                                            @endif
                                        </select>
                                        @error('room_no')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>ວັນທີ່ເຂົ້າພັກ:</label>

                                            <input type="date"
                                                class="form-control  @error('check_in_date') is-invalid @enderror"
                                                wire:model.defer="state.check_in_date" id="check_in_date"
                                                wire:change="handleCheckInDateChange($event.target.value)">
                                            @error('check_in_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>ວັນທີ່ອອກ:</label>
                                            <input type="date"
                                                class="form-control @error('check_out_date') is-invalid @enderror"
                                                wire:model.defer="state.check_out_date" id="check_out_date"
                                                wire:change.defer="handleCheckOutDateChange($event.target.value)">
                                            @error('check_out_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h4 style="font-weight: bold">ຈຳນວນມື້ທັງໝົດ: <span
                                                id="staying_day">{{ $day }}</span>
                                            ມື້
                                        </h4>
                                        <h4 style="font-weight: bold">ລາຄາ: <span
                                                id="price"></span>{{ number_format($room_price, 2, '.', ',') }}/-
                                        </h4>
                                        <h4 style="font-weight: bold">ລາຄາລວມ : <span
                                                id="total_price">{{ number_format($total_price, 2, '.', ',') }}</span> /-
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="text-center">ຂໍ້ມູນຂອງລູກຄ້າ:</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">ຊື່</label>
                                        <input type="text" placeholder="ຊື່ລູກຄ້າ"
                                            class="form-control @error('customer_name') is-invalid @enderror"
                                            wire:model.defer="state.customer_name" aria-describedby="customer_name">

                                        @error('customer_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>


                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">ນາມສະກຸນ</label>
                                        <input type="text" placeholder="ນາມສະກຸນ"
                                            class="form-control @error('customer_lastname') is-invalid @enderror"
                                            wire:model.defer="state.customer_lastname"
                                            aria-describedby="customer_lastname">

                                        @error('customer_lastname')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">ເບີໂທລະສັບ</label>
                                        <input type="number" placeholder="ເບີຕິດຕໍ່"
                                            class="form-control @error('customer_phone') is-invalid @enderror"
                                            wire:model.defer="state.customer_phone" aria-describedby="customer_phone"
                                            id="customer_phone">

                                        @error('customer_phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>


                                </div>

                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">ຈອງ</button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
