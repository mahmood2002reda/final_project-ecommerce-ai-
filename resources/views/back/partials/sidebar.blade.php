<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme   ">
          <div class="app-brand demo">
            <a href="{{route('back.index')}}" class="app-brand-link bg-dark   ">
              <span class="app-brand-logo demo">
                <img src="{{ asset('assets-back/img/logo/logo.jpg') }}" class="" width="160px" height="30px"  alt="New Image">
              </span>
              {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin</span> --}}
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          {{-- <div class="menu-inner-shadow"></div> --}}


          <ul class="menu-inner py-1 ">
            <!-- Dashboard -->
            <li class="menu-item  bg-light  ">
              <a href="{{route('back.index')}}" class="menu-link   shadow ">
                <i class="menu-icon tf-icons bx bx-home-circle  "></i>
                <div data-i18n="Analytics" class=" active"  >Home</div>
              </a>
            </li>

            <!-- Layouts -->


            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Pages</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category-alt"></i>
                <div data-i18n="Misc">Categories</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{url('back/category')}}" class="menu-link">
                    <div data-i18n="Error">All Categories</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{url('back/category/create')}}" class="menu-link">
                    <div data-i18n="Under Maintenance">Add Category</div>
                  </a>
                </li>
                </ul>
                </li>
                <li class="menu-item">
              <a href="" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Products</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{url('back/product')}}" class="menu-link">
                    <div data-i18n="Error">All Products</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{url('back/product/create')}}" class="menu-link">
                    <div data-i18n="Under Maintenance">Add Products</div>
                  </a>
                </li>
                </ul>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-tag-alt"></i>
                      <div data-i18n="Misc">brands</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="{{url('back/brands')}}" class="menu-link">
                          <div data-i18n="Error">All brands</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="menu-link">
                          <div data-i18n="Under Maintenance">Add brand</div>
                        </a>
                      </li>
                      </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons bx bx-palette"></i>
                          <div data-i18n="Misc">colors</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="{{url('back/colors')}}" class="menu-link">
                              <div data-i18n="Error">All colors</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="{{url('back/colors/create')}}" class="menu-link">
                                <div data-i18n="Under Maintenance">Add color</div>
                              </a>
                          </li>
                          </ul>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons bx bx-palette"></i>
                              <div data-i18n="Misc">Sizes</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="{{url('back/sizes')}}" class="menu-link">
                                  <div data-i18n="Error">All sizes</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="{{url('back/sizes/create')}}" class="menu-link">
                                    <div data-i18n="Under Maintenance">Add size</div>
                                  </a>
                              </li>
                              </ul>
                            </li>

                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                              <div data-i18n="Misc">Orders</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="{{url('back/orders')}}" class="menu-link">
                                  <div data-i18n="Error">All Orders</div>
                                </a>
                              </li>

                              </ul>
                              <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                  <i class="menu-icon tf-icons bx bx-user"></i>
                                  <div data-i18n="Misc">Users</div>
                                </a>
                                <ul class="menu-sub">
                                  <li class="menu-item">
                                    <a href="{{url('back/users')}}" class="menu-link">
                                      <div data-i18n="Error">All users</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="{{url('back/users/create')}}" class="menu-link">
                                        <div data-i18n="Under Maintenance">Add user</div>
                                      </a>
                                  </li>


                                  </ul>
                                  <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                      <i class="menu-icon tf-icons bx bx-store"></i>
                                      <div data-i18n="Misc">Vendors</div>
                                    </a>
                                    <ul class="menu-sub">
                                      <li class="menu-item">
                                        <a href="{{url('back/vendor')}}" class="menu-link">
                                          <div data-i18n="Error">All vendors</div>
                                        </a>
                                      </li>
                                      <li class="menu-item">
                                        <a href="{{url('back/vendor/create')}}" class="menu-link">
                                            <div data-i18n="Under Maintenance">Add vendor</div>
                                          </a>
                                      </li>


                                      </ul>
                                      @if(Auth::guard('admin')->user()->role->name === 'super_admin')
                                      <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                          <i class="menu-icon tf-icons bx bx-shield"></i>
                                          <div data-i18n="Misc">Admins</div>
                                        </a>
                                        <ul class="menu-sub">
                                          <li class="menu-item">
                                            <a href="{{url('back/Admins')}}" class="menu-link">
                                              <div data-i18n="Error">All admins</div>
                                            </a>
                                          </li>
                                          <li class="menu-item">
                                            <a href="{{url('back/vendor/create')}}" class="menu-link">
                                                <div data-i18n="Under Maintenance">Add admin</div>
                                              </a>
                                          </li>


                                          </ul>
                                          @endif
                {{-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Misc</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pages-misc-error.html" class="menu-link">
                    <div data-i18n="Error">Error</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-misc-under-maintenance.html" class="menu-link">
                    <div data-i18n="Under Maintenance">Under Maintenance</div>
                  </a>
                </li>
                </ul> --}}
                <li class="menu-item">
                    <a href="{{url('back/sliders')}}" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-slider"></i>
                      <div data-i18n="Account Settings"> Sliders</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="{{url('back/sliders')}}" class="menu-link">
                          <div data-i18n="Account">All sliders</div>
                        </a>
                      </li>
                    </ul>

            <li class="menu-item">
              <a href="{{url('back/sliders')}}" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Account Settings"> Settings</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{url('back/settings')}}" class="menu-link">
                    <div data-i18n="Account">App settings</div>
                  </a>
                </li>
                {{-- <li class="menu-item">
                  <a href="pages-account-settings-notifications.html" class="menu-link">
                    <div data-i18n="Notifications">Notifications</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-account-settings-connections.html" class="menu-link">
                    <div data-i18n="Connections">Connections</div>
                  </a>
                </li> --}}
              </ul>
            </li>
            {{-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Authentications</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="auth-login-basic.html" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Login</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="auth-register-basic.html" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Register</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Forgot Password</div>
                  </a>
                </li>
              </ul>
            </li>

              </ul>
            </li> --}}


            <!-- Extended components -->



            <!-- Forms & Tables -->



            <!-- Tables -->

            <!-- Misc -->


          </ul>
        </aside>
   <style>


.green-background-item {
  background-color: rgb(39, 228, 39);
}

.green-text {
  color: rgb(39, 228, 39);
}


   </style>

<style>
    body {
      position: relative;
      width: 100%;
      height: 100%;
      overflow-y: scroll;
    }
  </style>
<style>#layout-menu {
    height: 100vh; /* Set the height of the sidebar to 100% of the viewport height */
    overflow-y: auto; /* Enable vertical scrolling */
  }</style>

