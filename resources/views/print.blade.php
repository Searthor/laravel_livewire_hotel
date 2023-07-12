<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao+Looped:wght@100;200;300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Lao Looped', sans-serif;
        }

        .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 200px;

        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .detail {
            margin: 0 auto;
            text-align: center
        }

        .l {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .footer {
            padding: 2rem 10%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    @if ($id)
        <div class="container ">
            <div class="row">
                <div class="col-lg-6 text-center my-0 mx-auto border-1">
                    @foreach ($booking as $data)
                        <div class="head">
                            <h4 class="mb-4">ຂອບໃຈທີ່ທ່ານໃຊ້ບໍລິການ</h4>

                        </div>
                        <p class="text-start">ຊື່ລູກຄ້າ: {{ $data->customer_name }}</p>
                        <div class="d-flex justify-content-between">
                            <p class="text-start">ເບີໂທ: {{ $data->customer_phone }}</p>
                            <p class="text-start">{{ $date }}</p>
                        </div>

                        <table class="table text-start">
                            <tr>
                                <td>ວັນທີ່ເຂົ້າພັກ:</td>
                                <td>{{ $data->check_in }}</td>
                            </tr>
                            <tr>
                                <td>ວັນທີ່ອອກ:</td>
                                <td>{{ $data->check_out }}</td>
                            </tr>
                            <tr>
                                <td>ຈໍານວນມື້:</td>
                                <td>{{ $day }} ມື້</td>
                            </tr>
                            <tr>
                                <td>ລາຄາຫ້ອງ:</td>
                                <td>{{ number_format($data->price, 2, '.', ',') }} ກິບ</td>
                            </tr>
                            <tr>
                                <td>ລວມເປັນເງິນທັງໜົດ:</td>
                                <td>{{ number_format($data->total_price, 2, '.', ',') }} ກິບ</td>
                            </tr>

                        </table>
                    @endforeach
                    <p>CIT SOLE CO.,LTD</p>
                    <div class="d-print-none mt-4">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                    class="fa fa-print"></i></a>
                            <a href="#" class="btn btn-primary w-md">Send</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="header ">
                        <div class="logo ">
                            <img src="logo.png" width="50px" height="50px" alt="">
                            <p class="mt-2">ບໍລິສັດ ຊີໄອທີ ຈຳກັດຜູ້ດຽວ</p>
                            <h5>CIT SOLE CO.,LTD</h5>
                        </div>


                        <div class="">
                            <p>ເລກທີ່ CIT23292ຊອທ</p>
                            <p>ນະຄອນຫຼວງວຽງຈັນ,ວັນທີ່ 30/05/2023</p>
                        </div>
                    </div>

                    <div class="l">
                        <h6>ລາຍງານການພັກເຊົາ</h6>
                        <h6>ປະຈຳເດືອນ 7</h6>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">ເລກຫ້ອງ</th>
                                <th scope="col" class="text-center">ຊື່ລູກຄ້າ</th>
                                <th scope="col" class="text-center">ເບີໂທ</th>
                                <th scope="col" class="text-center">ວັນທີ່ເຂົ້າພັກ</th>
                                <th scope="col" class="text-center">ວັນທີ່ອອກ</th>
                                <th scope="col" class="text-center">ລາຄາ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($booking as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->room_no }}</td>
                                    <td>{{ $data->customer_name }}</td>
                                    <td>{{ $data->customer_phone }}</td>
                                    <td>{{ $data->check_in }}</td>
                                    <td>{{ $data->check_out }}</td>
                                    <td>{{ number_format($data->total_price, 2, '.', ',') }}</td>
                                </tr>
                            @endforeach
                            <tr>

                                <td colspan="6" class="text-center table-info "><strong>ລວມເປັນເງິນທັງໜົດ</strong>
                                </td>
                                <td class="table-info"><strong>{{ number_format($tatol_price, 2, '.', ',') }}</strong>
                                </td>

                            </tr>


                        </tbody>
                    </table>

                    <div class="footer">
                        <p>ຫົວໜ້າບໍລິສັດ</p>
                        <p>ຜູ້ສະຫຼຸບ</p>
                    </div>



                    <div class="d-print-none mt-4">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                    class="fa fa-print"></i></a>
                            <a href="#" class="btn btn-primary w-md">Send</a>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
        </div>

    @endif

</body>
<script>
    window.onload = () => {
        window.print()
        
    };
</script>

</html>
