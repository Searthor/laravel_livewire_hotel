<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao+Looped:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
  <style>
    body{
      font-family: 'Noto Sans Lao Looped', sans-serif;
        }
  </style>
 
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed" >
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

    @include('layouts.partails.navbar')

  <!-- Main Sidebar Container -->
  @include('layouts.partails.aside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    {{ $slot }}
    
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  {{-- @include('layouts.partails.footer') --}}
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>



<script>
  $(document).ready(function(){
    toastr.options ={
      "positionClass": "toast-top-right",
      "progressBar":true,
    }
    window.addEventListener('hide-form',event =>{
        $('#addRoot').modal('hide');
        $('#modal_check_in').modal('hide');
        $('#modal_check_out').modal('hide');
        $('#addemployees').modal('hide');
        toastr.success(event.detail.message,'Success!');
    })

  })
</script>

<script>
  
    window.addEventListener('show-form',event =>{
        $('#addRoot').modal('show');
        $('#addemployees').modal('show');
        $('#print').modal('show');
        
    })

    window.addEventListener('show-form-check_in',event =>{
        $('#modal_check_in').modal('show');
        
    })

    
    window.addEventListener('show-form-check_out',event =>{
        $('#modal_check_out').modal('show');
        
    })
    window.addEventListener('show-form-print',event =>{
        $('#modal_check_out').modal('hide');
        toastr.success(event.detail.message,'Success!');
        $('#printP').modal('show');
        
    })
    window.addEventListener('show-form-detail',event =>{
        $('#showdetail').modal('show');
    })

    window.addEventListener('show-form-edit',event =>{
        $('#modal_edit_data').modal('show');
    })

    

    window.addEventListener('Error',event =>{
      toastr.error(event.detail.message,'Error!');
        
    })

    window.addEventListener('succuss',event =>{
      toastr.success(event.detail.message,'Success!');
        
    })

    window.addEventListener('show-form-delete',event =>{
        $('#confirmationModal').modal('show');
    })
    window.addEventListener('hide-delete-modal',event =>{
        $('#confirmationModal').modal('hide');
        toastr.success(event.detail.message,'Success!');
    })
    window.addEventListener('Booking_success',event =>{
       
        toastr.success(event.detail.message,'Success!');
    })

</script>

@livewireScripts
</body>
</html>
