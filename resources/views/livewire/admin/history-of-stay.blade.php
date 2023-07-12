<div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ປະຫວັດການພັກເຊົາ</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ປະຫວັດການພັກເຊົາ</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="d-flex justify-content-start mb-2">
                        <a href="{{ Route('print') }}" target="_blank" class="btn btn-info ml-4"><i
                                class="fa fa-print"></i></a>

                    </div>

                    <div class="card ">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">No.</th>
                                        <th scope="col">ເລກຫ້ອງ</th>
                                        <th scope="col">ຊື່ລູກຄ້າ</th>
                                        <th scope="col">ເບີໂທ</th>
                                        <th scope="col">ວັນທີ່ເຂົ້າພັກ</th>
                                        <th scope="col">ວັນທີ່ອອກ</th>
                                        <th scope="col">ລາຄາ</th>
                                        <th scope="col">ພິມບິນ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->room_no }}</td>
                                            <td>{{ $data->customer_name }}</td>
                                            <td>{{ $data->customer_phone }}</td>
                                            <td>{{ date('d-m-Y', strtotime($data->check_in)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($data->check_out)) }}</td>
                                            <td>{{ number_format($data->total_price, 2, '.', ',') }}</td>
                                            {{-- <td class="text-center"><a href="{{ Route('print', ['id' => $data->id]) }}"
                                                    target="_blank" class="btn btn-info"><i class="fa fa-print"></i></a>
                                            </td> --}}
                                            <td class="text-center"><a href="" class="btn btn-info"
                                                    wire:click.prevent="print({{ $data->id }})"><i
                                                        class="fa fa-print"></i></a></td>
                                        </tr>
                                    @endforeach
                                    <tr>

                                        <td colspan="6" class="text-center table-info">
                                            <strong>ລວມເປັນເງິນທັງໜົດ</strong>
                                        </td>
                                        <td colspan="2" class="table-info">
                                            <strong>{{ number_format($tatol_price, 2, '.', ',') }}</strong>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer ">
                            {{ $booking->links() }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>







    <div class="modal fade " id="addRoot" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog " role="document">

            <div class="modal-content">
                <div class="modal-body">

                    <div class="head text-center">
                        <h4 class="mb-4">ຂອບໃຈທີ່ທ່ານໃຊ້ບໍລິການ</h4>

                    </div>
                    <p class="text-start">ຊື່ລູກຄ້າ: {{ $customer_name }} </p>
                    <div class="d-flex justify-content-between">
                        <p class="text-start">ເບີໂທ: {{ $customer_phone }} </p>
                        <p class="text-start">{{ $date }}</p>
                    </div>

                    <table class="table text-start">
                        <tr>
                            <td>ວັນທີ່ເຂົ້າພັກ:</td>
                            <td> {{ $check_in }}</td>
                        </tr>
                        <tr>
                            <td>ວັນທີ່ອອກ:</td>
                            <td>{{ $check_out }}</td>
                        </tr>
                        <tr>
                            <td>ຈໍານວນມື້:</td>
                            <td>{{ $day }} ມື້</td>
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


</div>
<script>
    function printModal() {
        const modal = document.getElementById('addRoot'); // Replace 'modal' with the ID of your modal
        const modalContent = modal.innerHTML; // Get the HTML content of the modal
        const originalContent = document.body.innerHTML; // Save the original HTML content of the page
        document.body.innerHTML = modalContent; // Replace the HTML content of the page with the modal content
        window.print(); // Print the modal
        document.body.innerHTML = originalContent; // Restore the original HTML content of the page
    }
</script>
