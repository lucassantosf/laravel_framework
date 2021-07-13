<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Acesso geral</li>
                <li @if(Route::is('dashboard')) class="active" @endif>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i><span> Dashboard </span>
                    </a>
                </li>

                @if($auth->role->id == 1)
                <li @if(Route::is('especialidades.index') || Route::is('especialidades.create') || Route::is('especialidades.edit') || Route::is('especialidades.busca')) class="active" @endif>
                    <a href="javascript:void(0)" class="waves-effect"><i class="fas fa-user-graduate"></i> <span> Especialidades <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('especialidades.index')}}">Listar especialidades</a></li>
                        <li><a href="{{route('especialidades.create')}}">Adicionar nova especialidade</a></li>
                    </ul>
                </li>

                <li @if(Route::is('pacotes.index') || Route::is('pacotes.create') || Route::is('pacotes.edit') || Route::is('pacotes.busca')) class="active" @endif>
                    <a href="javascript:void(0)" class="waves-effect"><i class="fas fa-comment-dots"></i> <span> Pacotes <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('pacotes.index')}}">Listar pacotes</a></li>
                        <li><a href="{{route('pacotes.create')}}">Adicionar novo pacote</a></li>
                    </ul>
                </li>

                <li @if(Route::is('usuarios.index') || Route::is('usuarios.create') || Route::is('usuarios.edit')) class="active" @endif>
                    <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-account-multiple"></i> <span> Usuários <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('usuarios.index')}}">Listar usuários</a></li>
                        <li><a href="{{route('usuarios.create')}}">Adicionar novo usuário</a></li>
                    </ul>
                </li>

                <li @if(Route::is('informacoes.edit')) class="active" @endif>
                    <a href="{{route('informacoes.edit', 1)}}" class="waves-effect"><i class="mdi mdi-information"></i> <span> Informações</span> </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
