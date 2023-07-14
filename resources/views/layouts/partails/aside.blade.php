<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="display: flex">
      <p style="color: rgb(235, 122, 2)">Hotel</p>
      <span class="brand-text font-weight-light" style="margin-left: 1rem">Management System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
     

      <!-- Sidebar Menu -->
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ Route('dashboard')}}" class="nav-link {{request()->is('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
             
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                ຫ້ອງ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('manage_rooms')}}" class="nav-link {{request()->is('manage_rooms') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    ຈັດການຫ້ອງ
                  
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ Route('rooms_type')}}" class="nav-link {{request()->is('rooms_type') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    ຈັດການປະເພດຫ້ອງ
                  
                  </p>
                </a>
              </li>

              

              <li class="nav-item">
                <a href="{{ Route('reservation')}}" class="nav-link {{request()->is('reservation') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    ການຈອງຫ້ອງພັກ
                   
                  </p>
                </a>
              </li>
         
            </ul>
          </li>

          
          
          <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa-sharp fa-solid fa-layer-group"></i>
              <p>
                ໂມດຸນ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('expenses')}}" class="nav-link {{request()->is('expenses') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-money-bill"></i>
                  <p>
                    ລາຍຮັບ-ລາຍຈ່າຍ
                  </p>
                </a>
              </li>

              

              <li class="nav-item menu-open">
                <a href="{{ Route('staff')}}" class="nav-link {{request()->is('staff') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    ພະນັກງານ
                  </p>
                </a>
              </li>
              
            </ul>
          </li>


          <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa-sharp fa-solid fa-layer-group"></i>
              <p>
                ລາຍງານ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('history-of-stay')}}" class="nav-link {{request()->is('history-of-stay') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    ປະຫວັດການພັກເຊົາ
                  </p>
                </a>
              </li>
             
              
            </ul>
          </li>
         
          
          
          <li class="nav-item menu-open">
            <form method="post" action="{{ route('logout') }}"  class="nav-link nav-item menu-open">
              @csrf
              <a href="" onclick="return confirm('Are you sure??') ">
                <button type="submit" style="background: none;border:none;color:aliceblue" >
                  <i class="fa-solid fa-right-from-bracket"></i> <p>ອອກ</p>
                </button>
              </a>
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>