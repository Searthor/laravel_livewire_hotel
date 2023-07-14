<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ລາຍຮັບ-ລາຍຈ່າຍ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ລາຍຮັບ-ລາຍຈ່າຍ</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content" wire:ignore.self>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header bg-info">
                            <h4 class="text-center">ເພີ່ມລາຍການໃໜ່</h4>
                        </div>
                        <form>
                            <div class="card-body " >
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-grop">
                                            <label for="">ລາຍຮັບ-ລາຍຈ່າຍ</label>
                                            <select name="" id="" class="form-control"
                                                wire:model='type'>
                                                <option value="0">ລາຍຮັບ</option>
                                                <option value="1">ລາຍຈ່າຍ</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-grop">
                                            <label for="price" class="form-label">ຈຳນວນ</label>
                                            <input type="number" wire:model="amount" class="form-control  @error('amount') is-invalid @enderror" onkeypress='validate(event)'>
                                        </div>
                                        @error('amount')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-grop">
                                            <label for="dec" class="form-label">ລາຍລະອຽດ</label>
                                            <textarea type="text" wire:model="des" id="dec" class="form-control @error('des') is-invalid @enderror"></textarea>
                                        </div>
                                        @error('des')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                        <div class="card-footer">

                            <button type="button" wire:click="save" class="btn btn-success">SAVE</button>
                            <button type="button" class="btn btn-secondary" wire:click="resetfil">RESET</button>

                        </div>
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">ປະເພດ</th>
                                        <th scope="col">ຈຳນວນ</th>
                                        <th scope="col">ລາຍລະອຽດ</th>
                                        <th scope="col">ຜູ້ສ້າງ</th>
                                        <th scope="col">ວັນທີ່ສ້າງ</th>
                                        <th scope="col">option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            @if ($data->type==0)
                                            <span class="text-success">ລາຍຮັບ</span>
                                                
                                            @else
                                            <span class="text-danger">ລາຍຈ່າຍ</span>
                                                
                                            @endif
                                        </td>
                                        
                                        <td>{{ number_format($data->amount, 2, '.', ',')}}</td>
                                        <td>{{ $data->des}}</td>
                                        <td>{{ $data->name}}</td>
                                        <td>{{ date('d/m/Y', strtotime($data->created_at))}}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-warning fa fa-edit"></a>
                                        </td>
                                    </tr>
                                        
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="card-footer ">
                            {{ $datas ->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    


</div>


@push('script')
<script>
    function validate(evt) {
    var theEvent = evt || window.event;
    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}


</script>
    
@endpush
