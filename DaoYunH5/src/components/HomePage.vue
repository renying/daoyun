<template>
  <div>
    <!-- Navigation Bar-->
    <header id="topnav">
      <div class="topbar-main">
        <div class="container-fluid">

          <!-- Logo container-->
          <div class="logo">
              <!-- Text Logo -->
              <!--<a href="index.html" class="logo">-->
              <!--Admiria-->
              <!--</a>-->
              <!-- Image Logo -->
              <a href="pages-home.html" class="logo">
                  <img src="assets/images/DaoYun-Logo.png" alt="" height="50">
              </a>

          </div>
          <!-- End Logo container-->

          <div class="menu-extras topbar-custom">

            <!-- Search input -->
            <div class="search-wrap" id="search-wrap">
                <div class="search-bar">
                    <input class="search-input" type="search" placeholder="Search" />
                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                        <i class="mdi mdi-close-circle"></i>
                    </a>
                </div>
            </div>

                  <ul class="list-inline float-right mb-0">
                    <!-- Search -->
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                            <i class="mdi mdi-magnify noti-icon"></i>
                        </a>
                    </li>
                    <!-- Fullscreen -->
                    <li class="list-inline-item dropdown notification-list hide-phone">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="mdi mdi-fullscreen noti-icon"></i>
                        </a>
                    </li>
                    <!-- language-->
                    <li class="list-inline-item dropdown notification-list hide-phone">
                      <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                        English <img src="assets/images/flags/us_flag.jpg" class="ml-2" height="16" alt=""/>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right language-switch">
                        <a class="dropdown-item" href="#"><img src="assets/images/flags/germany_flag.jpg" alt="" height="16"/><span> German </span></a>
                        <a class="dropdown-item" href="#"><img src="assets/images/flags/italy_flag.jpg" alt="" height="16"/><span> Italian </span></a>
                        <a class="dropdown-item" href="#"><img src="assets/images/flags/french_flag.jpg" alt="" height="16"/><span> French </span></a>
                        <a class="dropdown-item" href="#"><img src="assets/images/flags/spain_flag.jpg" alt="" height="16"/><span> Spanish </span></a>
                        <a class="dropdown-item" href="#"><img src="assets/images/flags/russia_flag.jpg" alt="" height="16"/><span> Russian </span></a>
                      </div>
                    </li>
                    <!-- notification-->
                    <li class="list-inline-item dropdown notification-list">
                      <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                          aria-haspopup="false" aria-expanded="false">
                          <i class="ion-ios7-bell noti-icon"></i>
                          <span class="badge badge-danger noti-icon-badge">3</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>Notification (3)</h5>
                        </div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                            <p class="notify-details"><b>Your order is placed</b><small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                            <p class="notify-details"><b>New Message received</b><small class="text-muted">You have 87 unread messages</small></p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info"><i class="mdi mdi-martini"></i></div>
                            <p class="notify-details"><b>Your item is shipped</b><small class="text-muted">It is a long established fact that a reader will</small></p>
                        </a>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            View All
                        </a>

                      </div>
                    </li>
                    <!-- User-->
                    <li class="list-inline-item dropdown notification-list">
                      <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                          aria-haspopup="false" aria-expanded="false">
                        <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                      </a>
                      <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted"></i> My Wallet</a>
                        <a class="dropdown-item" href="#"><span class="badge badge-success pull-right m-t-5">5</span><i class="dripicons-gear text-muted"></i> Settings</a>
                        <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted"></i> Logout</a>
                      </div>
                    </li>
                    <li class="menu-item list-inline-item">
                      <!-- Mobile menu toggle-->
                      <a class="navbar-toggle nav-link">
                        <div class="lines">
                          <span></span>
                          <span></span>
                          <span></span>
                        </div>
                      </a>
                      <!-- End mobile menu toggle-->
                    </li>
                  </ul>
                </div>
                <!-- end menu-extras -->
              <div class="clearfix"></div>
            </div> <!-- end container -->
          </div>
          <!-- end topbar-main -->

          <!-- MENU Start -->
          <div class="navbar-custom">
            <div class="container-fluid">
              <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-view-dashboard"></i>系统管理</a>
                        <ul class="submenu">
                          <li><a href="pages-home.html">用户角色管理</a></li>
                          <li><a href="pages-home.html">用户信息管理</a></li>
                          <li><a href="pages-home.html">系统页面管理</a></li>
                          <li><a href="pages-home.html">用户权限设置</a></li>
                          <li><a href="pages-home.html">字典信息配置</a></li>
                          <li><a href="pages-home.html">我的信息</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-view-dashboard"></i>班课管理</a>
                  <ul class="submenu">
                    <li><a href="pages-home.html">班课信息</a></li>
                    <li><a href="pages-home.html">我的班课</a></li>
                    <li><a href="pages-home.html">签到管理</a></li>
                    <li><a href="pages-home.html">通知管理</a></li>
                  </ul>
                </li>
                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-view-dashboard"></i>关于我们</a>
                    <ul class="submenu">
                        <li><a href="pages-home.html">关于我们</a></li>
                    </ul>
                </li>
            </ul>
            <!-- End navigation menu -->
          </div> <!-- end #navigation -->
        </div> <!-- end container -->
      </div> <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->

    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group pull-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">28</a></li>
                                <li class="breadcrumb-item active">首页</li>
                            </ol>
                        </div>
                        <h4 class="page-title">这是首页</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

        </div> <!-- end container -->
    </div>
    <!-- end wrapper -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    2019 © 工程实践28组 <span class="text-muted d-none d-sm-inline-block float-right"></span>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
  </div>
</template>

<script>
import '@/assets/css/icons.css'
import '@/assets/css/style.css'
import '@/assets/css/bootstrap.min.css'
export default {
  name: 'HelloWorld',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
