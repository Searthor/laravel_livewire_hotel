<x-admin-layout>
    <div>
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
        
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <!-- Info boxes -->
              <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bed"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">ຫ້ອງທັງໜົດ</span>
                      <span class="info-box-number">
                       {{ $all_room}}
                        <small>ຫ້ອງ</small>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bookmark"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">ການຈອງ</span>
                      <span class="info-box-number">{{$booking_room}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
        
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
        
                <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">ພະນັກງານທັງໜົດ</span>
                      <span class="info-box-number">{{ $employees}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
        

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bed"></i></span>
          
                      <div class="info-box-content">
                        <span class="info-box-text">Check in ແລ້ວ</span>
                        <span class="info-box-number">{{ $check_in }}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>



                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-circle"></i></span>
          
                      <div class="info-box-content">
                        <span class="info-box-text">ຫ້ອງຫວ່າງ</span>
                        <span class="info-box-number">{{ $guest_room}}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
             
                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-money-bill"></i></span>
          
                      <div class="info-box-content">
                        <span class="info-box-text">ລາຍຮັບທັງໝົດ/ເດືອນ</span>
                        <span class="info-box-number">{{ number_format($income, 2, '.', ',')}} ກິບ</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>

                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-credit-card"></i></span>
          
                      <div class="info-box-content">
                        <span class="info-box-text">ລາຍຈ່າຍທັງໜົດ/ເດືອນ</span>
                        <span class="info-box-number">{{ number_format($expenditure, 2, '.', ',')}} ກິບ</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div><!--/. container-fluid -->
          </section>


          <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between mb-2">
                            <button class="btn btn-primary">ຫ້ອງຫວ່າງທັງໜົດ</button>
                         
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
                                                
                                                <td><button class="btn btn-info">ຫ່ວາງ</button></td>
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
          <!-- /.content -->
    </div>
</x-admin-layout>