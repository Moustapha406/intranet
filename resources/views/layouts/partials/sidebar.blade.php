<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('/') }}"> <img alt="image" src="{{asset('assets/img/logo patisen.png')}}" class="header-logo" /> <span
                    class="logo-name"></span>
            </a>
        </div>
         
        <ul class="sidebar-menu">
            <li class="menu-header">Paramétrage</li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <span class="material-symbols-outlined">groups</span><span>Gestion des utilisateurs</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('users.index')}}">Utilisateurs</a></li>

                    <li><a class="nav-link" href="{{route('roles.index')}}">Rôles</a></li>
                    <li><a class="nav-link" href="{{route('permissions.index')}}">Permissions</a></li>
                    
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <span class="material-symbols-outlined">menu</span><span>Gestion des menus</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Menu</a></li>

                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <span class="material-symbols-outlined">lists</span><span>Répertoire</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="">Utilisateur</a></li>
                    <li><a class="nav-link" href="">Fournisseur</a></li>
                </ul>
            </li>
            
            {{--            @endcan--}}

            <li class="menu-header">Apps</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <span class="material-symbols-outlined">donut_small</span><span>TRG</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('article.index') }}">Article</a></li>
                    <li><a class="nav-link" href="{{ route('atelier.index') }}">Atelier</a></li>
                    <li><a class="nav-link" href="{{ route('production.index') }}">Production</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <span class="material-symbols-outlined"><span class="material-symbols-outlined">add_reaction</span></span><span>X3</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="">Services</a></li>
                    <li><a class="nav-link" href="">Sites</a></li>
                    <li><a class="nav-link" href="">Pays</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <span class="material-symbols-outlined">garage</span></i><span>Garage</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="">Services</a></li>
                    <li><a class="nav-link" href="">Sites</a></li>
                    <li><a class="nav-link" href="">Pays</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <span class="material-symbols-outlined">monetization_on</span></i><span>Finances</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="">Services</a></li>
                    <li><a class="nav-link" href="">Sites</a></li>
                    <li><a class="nav-link" href="">Pays</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            {{-- @foreach ($list_menus as $menu )
                @includeIf('layouts.partials.menu-item')
            @endforeach --}}
         </ul>
    </aside>
</div>
