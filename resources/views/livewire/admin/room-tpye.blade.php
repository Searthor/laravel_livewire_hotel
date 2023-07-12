<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rooms Manager</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Rooms type</a></li>
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
                        <button class="btn btn-primary" wire:click.prevent="addNew"><i class="fa fa-plus-circle"></i>
                            Add Type</button>
                        <div class="d-flex justify-content-center align-items-center border bg-white pr-2">
                            <input type="text" class="form-control border-0" placeholder="search...">

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ປະເພດຫ້ອງ</th>
                                        <th scope="col">ລາຄາ</th>
                                        <th scope="col">option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roomtypes as $roomtype)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                {{ $roomtype->room_types }}

                                            </td>
                                         
                                            <td>{{ number_format($roomtype->price, 2, '.', ',') }}</td>
                                            <td>
                                                <a href="" class="mr-3 btn btn-sm btn-info"
                                                    wire:click.prevent="showDetail({{ $roomtype }})">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="" class="btn btn-sm btn-warning"
                                                wire:click.prevent="edit({{ $roomtype }})">
                                                    <i class="fa fa-edit "></i>
                                                </a>

                                                <a class="ml-3 btn btn-sm btn-danger" href=""
                                                    wire:click.prevent="comfirmUserRemoval({{ $roomtype->id }})">
                                                    <i class="fa fa-trash "></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="4">NO results found</td>
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


    <!-- Modal -->
    <div class="modal fade" id="addRoot" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" 
            wire:submit.prevent="{{ $showEditModal ? 'update' : 'create' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        @if ($showEditModal)
                            <h4>Edit Room-type</h4>
                        @else
                            <h4>Add Room-type</h4>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="forn-group">
                            <label for="room_types">Room Type</label>
                            <input type="text" wire:model.defer="state.room_types"
                                class="form-control @error('room_types') is-invalid @enderror" id="room_types"
                                aria-describedby="room_types" placeholder="Enter name">
                            @error('room_types')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="forn-group">
                            <label for="price">Price</label>
                            <input type="text" wire:model.defer="state.price"
                                class="form-control @error('price') is-invalid @enderror" id="price"
                                aria-describedby="price" placeholder="Price">

                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                           
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            @if ($showEditModal)
                                <span>Save Changes</span>
                            @else
                                <span>Save</span>
                            @endif
                        </button>
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
                <div class="modal-header">

                    <h4>detail Room-type</h4>


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Room Type:</th>
                            <td>{{ $view_room_type }}</td>
                        </tr>

                        <tr>
                            <th>price:</th>
                            <td>{{ $view_room_price }}</td>
                        </tr>
                    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

      <!--cofirm Modal -->
      <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
      wire:ignore.self>
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           
                          Delate Room-type                             
                        </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                     <h4>Are you sure you want to delete ?</h4>                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                        
                        <button type="button" wire:click.prevent="delete"
                         class="btn btn-danger"><i class="fa fa-trash mr-1"></i>
                          Delete 
                        </button>
                    </div>
                </div>
            </form>
        </div>
      </div>



</div>
