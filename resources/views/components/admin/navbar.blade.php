<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('home') }}">
                {{ config('app.name') }}
            </a>
        </h1>


        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0 show" data-bs-toggle="dropdown"
                    aria-label="Open user menu" aria-expanded="true">

                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->user()->name }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" data-bs-popper="none">
                    <a href="{{ route('admin.logout') }}" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">


                <li class="nav-item  @if (request()->routeIs('admin.dashboard')) active @endif">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-tabler-layout-dashboard class="icon" />
                        </span>
                        <span class="nav-link-title">Home</span>
                    </a>
                </li>


                <li class="nav-item  @if (request()->routeIs('admin.send_to_all')) active @endif">
                    <a class="nav-link" href="{{ route('admin.send_to_all') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-tabler-send class="icon" />
                        </span>
                        <span class="nav-link-title">Send To All</span>
                    </a>
                </li>



                <li class="nav-item dropdown "> <a class="nav-link dropdown-toggle " href="#navbar-help"
                        data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false"> <span
                            class="nav-link-icon d-md-none d-lg-inline-block"> <x-tabler-send class="icon" /> </span>
                        <span class="nav-link-title">Send Particular</span> </a>
                    <div class="dropdown-menu ">
                        @php
                            $array = ['country', 'timezone', 'device', 'platform', 'browser', 'language'];
                        @endphp

                        @foreach ($array as $item)
                            <a class="dropdown-item " href="{{ route('admin.category_wise', ['category' => $item]) }}">
                                {{ ucfirst($item) }} Wise </a>
                        @endforeach




                    </div>
                </li>


                <li class="nav-item  @if (request()->routeIs('admin.notification_history')) active @endif">
                    <a class="nav-link" href="{{ route('admin.notification_history') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-tabler-list class="icon" />
                        </span>
                        <span class="nav-link-title">Notification History</span>
                    </a>
                </li>










            </ul>
        </div>
    </div>
</aside>
<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">


                <div class="nav-item dropdown d-none d-md-flex" title="Country change" data-bs-toggle="tooltip"
                    data-bs-placement="top">

                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0 show" data-bs-toggle="dropdown"
                    aria-label="Open user menu" aria-expanded="true">

                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->user()->name }}</div>
                        {{-- <div class="mt-1 small text-muted">ADMIN</div> --}}
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" data-bs-popper="none">
                    <a href="{{ route('admin.logout') }}" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div>

            </div>
        </div>
    </div>
</header>
