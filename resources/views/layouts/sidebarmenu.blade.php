<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-accordion-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            @if (
                Gate::check('home index')       ||
                Gate::check('histories index')  ||
                Gate::check('patients index')   ||
                Gate::check('attentions index') 
            )

            <li class="nav-item start 
                {{    
                    request()->is('home')       ||
                    request()->is('histories')  ||
                    request()->is('patients')   ||
                    request()->is('attentions')
                    ? 'active open' : '' 
                }}">

                <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-h-square"></i>
                    <span class="title">Admisión</span>
                    <span class="arrow 
                        {{   
                            request()->is('home')       ||
                            request()->is('histories')  ||
                            request()->is('patients')   ||
                            request()->is('attentions') 
                         ? 'open' : '' 
                        }}">
                    </span>
                </a>

                <ul class="sub-menu">
                @can('home index')
                    <li class="nav-item start {{ request()->is('home') ? 'active open' : '' }}">
                        <a href="{{ route('home') }}" class="nav-link">
                            <span class="title">Inicio</span>
                        </a>
                    </li>
                @endcan
                
                @can('patients index')
                    <li class="nav-item start {{ request()->is('patients') ? 'active open' : '' }}">
                        <a href="{{ route('patients.index') }}" class="nav-link">
                            <span class="title">Pacientes</span>
                        </a>
                    </li>
                @endcan

                @can('histories index')
                <li class="nav-item start {{ request()->is('histories') ? 'active open' : '' }}">
                    <a href="{{ route('histories.index') }}" class="nav-link">
                        <span class="title">Historiales</span>
                    </a>
                </li>
                @endcan

                @can('attentions index')
                    <li class="nav-item start {{ request()->is('attentions') ? 'active open' : '' }}">
                        <a href="{{ route('attentions.index') }}" class="nav-link">
                            <span class="title">Atenciones</span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>

            @endif

            @if (
                Gate::check('triages index') ||
                Gate::check('records index')
            )

            <li class="nav-item 
                {{  
                    request()->is('triages') ||
                    request()->is('records')
                    ? 'active open' : '' 
                }}">

                <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-user-md"></i>
                    <span class="title">Clínica</span>
                    <span class="arrow 
                        {{  
                            request()->is('triages') ||
                            request()->is('records')
                         ? 'open' : '' 
                        }}">
                    </span>
                </a>
                <ul class="sub-menu">
                @can('triages index')
                    <li class="nav-item start {{ request()->is('triages') ? 'active open' : '' }}">
                        <a href="{{ route('triages.index') }}" class="nav-link">
                            <span class="title">Triajes</span>
                        </a>
                    </li>
                @endcan

                @can('records index')
                    <li class="nav-item start {{ request()->is('records') ? 'active open' : '' }}">
                        <a href="{{ route('records.index') }}" class="nav-link">
                            <span class="title">Historias</span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>

            @endif

            @if (
                Gate::check('surgeries index') ||
                Gate::check('labs index')
            )

            <li class="nav-item
                {{    
                    request()->is('surgeries') ||
                    request()->is('labs')
                    ? 'active open' : '' 
                }}">

                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-heartbeat"></i>
                    <span class="title">Informe</span>
                    <span class="selected"></span>
                    <span class="arrow 
                    {{   
                        request()->is('surgeries*') ||
                        request()->is('labs*')
                         ? 'open' : '' 
                    }}">
                    </span>
                </a>
                <ul class="sub-menu">
                @can('surgeries index')
                    <li class="nav-item {{ request()->is('surgeries') ? 'active open' : '' }}">
                        <a href="{{ route('surgeries.index') }}" class="nav-link">
                            <span class="title">Quirúrgicos</span>
                        </a>
                    </li>
                @endcan

                @can('labs index')
                    <li class="nav-item {{ request()->is('labs') ? 'active open' : '' }}">
                        <a href="{{ route('labs.index') }}" class="nav-link">
                            <span class="title">Laboratoriales</span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>

            @endif

            @if (
                Gate::check('services index') || 
                Gate::check('iagnoses index') ||
                Gate::check('users index')    ||
                Gate::check('roles index')
            )

            <li class="nav-item
                {{    
                    request()->is('services') ||
                    request()->is('diagnoses') ||
                    request()->is('users') ||
                    request()->is('roles')
                    ? 'active open' : '' 
                }}">

                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-stethoscope"></i>
                    <span class="title">Mantenimiento</span>
                    <span class="selected"></span>
                    <span class="arrow 
                    {{   
                        request()->is('services') ||
                        request()->is('diagnoses') ||
                        request()->is('users') ||
                        request()->is('roles')
                         ? 'open' : '' 
                    }}">
                    </span>
                </a>
                <ul class="sub-menu">
                @can('roles index')
                    <li class="nav-item {{ request()->is('roles') ? 'active open' : '' }}">
                        <a href="{{ route('roles.index') }}" class="nav-link">
                            <span class="title">Accesos</span>
                        </a>
                    </li>
                @endcan

                @can('services index')
                    <li class="nav-item {{ request()->is('services') ? 'active open' : '' }}">
                        <a href="{{ route('services.index') }}" class="nav-link">
                            <span class="title">Servicios</span>
                        </a>
                    </li>
                @endcan

                @can('diagnoses index')
                    <li class="nav-item {{ request()->is('diagnoses') ? 'active open' : '' }}">
                        <a href="{{ route('diagnoses.index') }}" class="nav-link">
                            <span class="title">Diagnósticos</span>
                        </a>
                    </li>
                @endcan

                @can('users index')
                    <li class="nav-item {{ request()->is('users') ? 'active open' : '' }}">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <span class="title">Especialistas</span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            
            @endif

            @if (Gate::check('Super Admin'))
            <li class="nav-item {{  request()->is('audits') ? 'active open' : '' }}">

                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-database"></i>
                    <span class="title">Sistema</span>
                    <span class="selected"></span>
                    <span class="arrow {{ request()->is('audits') ? 'open' : ''  }}">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ request()->is('audits') ? 'active open' : '' }}">
                        <a href="{{ route('audits.index') }}" class="nav-link">
                            <span class="title">Auditorias</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->