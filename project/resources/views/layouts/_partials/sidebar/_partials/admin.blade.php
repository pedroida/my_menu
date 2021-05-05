<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ request()->is('home*', '/') ? 'active' : null }}">
        <a class="nav-link" href="{{ route('home') }}" data-toggle="tooltip" data-placement="right"
           title="Dashboard Geral">
            <i class="fas fa-fire"></i>
            <span>Dashboard Geral</span>
        </a>
    </li>

    <li class="menu-header">@lang('headings.common.registration')</li>

    <li class="{{ is_active('categories.index') }}">
        <a class="nav-link" href="{{ route('categories.index') }}" data-toggle="tooltip" data-placement="right"
           title="@lang('headings.common.categories')">
            <i class="fas fa-building"></i>
            <span>@lang('headings.common.categories')</span>
        </a>
    </li>

    <li class="{{ is_active('units.index') }}">
        <a class="nav-link" href="{{ route('units.index') }}" data-toggle="tooltip" data-placement="right"
           title="@lang('headings.common.units')">
            <i class="fas fa-building"></i>
            <span>@lang('headings.common.units')</span>
        </a>
    </li>
</ul>
