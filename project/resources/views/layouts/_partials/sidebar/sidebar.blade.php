<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('home') }}">
        {{ config('app.name') }}
      </a>
    </div>

    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('home') }}"><img src="/assets/img/favicon.ico" alt="" style="max-width: 80%"></a>
    </div>

      @include('layouts._partials.sidebar._partials.admin')

  </aside>
</div>