  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href={{ route("admin.dashboard") }} class="brand-link">
      <img src={{ asset("dist/img/AdminLTELogo.png") }} alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Shopping Cart</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src={{ asset("dist/img/user2-160x160.jpg") }} class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Aman Punjabi</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.configuration.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Configurations 
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{ route('admin.banners.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
              Banner
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.category.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories 
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview  ">
            <a href="#" class="nav-link  ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Product
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.product-attributes.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Attributes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.brands.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.coupons.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Coupons</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.orders.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Orders 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.cms.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Manage Pages 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.email.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Email Templates 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.contact.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Contacts 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.report.sales') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
              Report 
              </p>
            </a>
          </li>
          <li class="nav-item">
           <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           <i class="nav-icon fas fa-sign-out-alt"></i>
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>