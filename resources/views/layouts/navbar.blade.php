   <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
            <!--     <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ (auth()->user()->photo) ? auth()->user()->photo : asset('themes/admin/images/user.png') }}" class="user-image img-circle elevation-2" alt="User Image">

                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                </a> -->
          <!--       <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <li class="user-header bg-secondary">
                        <img src="{{ auth()->user()->photo }}" class="img-circle elevation-2" alt="User Image">
                        <p>
                            <small>Member since {{ date('M. Y', strtotime(auth()->user()->created_at)) }}</small>
                          name
                        </p>
                    </li>
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                            out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul> -->
            </li>
        </ul>
    </nav>