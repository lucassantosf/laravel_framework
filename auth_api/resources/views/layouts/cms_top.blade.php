<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{route('dashboard')}}" class="logo">
            <span>
                <img src="{{ URL::asset('assets/cms/images/logo.png')}}" alt="" height="30">
            </span>
            <i>
                 <img src="{{ URL::asset('assets/cms/images/logo.png')}}" alt="" height="30">
            </i>
        </a>
    </div>

    <nav class="navbar-custom">

        <ul class="navbar-right d-flex list-inline float-right mb-0">
            <li class="dropdown notification-list">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="@if($auth->image) {{$auth->image}} @else {{ URL::asset('assets/cms/images/profile_pic.png')}} @endif" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="pt-2 pb-2 text-center"><strong>{{$auth->name}}<br/><small>{{$auth->role->label}}</small></strong></div>
                        <a class="dropdown-item" href="{{route('usuarios.edit', $auth->id)}}"><i class="mdi mdi-settings m-r-5"></i> Editar dados</a>
                        <div class="dropdown-divider"></div>
                        <div class="text-center">
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-1 mb-2"><i class="mdi mdi-power text-white"></i> Logout</button>
                            </form>
                        </div>
                    </div>                                                                    
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>
<!-- Top Bar End -->