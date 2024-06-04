<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    {{ $title }}
                </h2>

            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">

                    <a href="{{ route('home') }}" class="btn btn-primary  d-sm-inline-block" target="_blank">
                        <x-tabler-eye class="icon" />

                        View Site
                    </a>

                    @if (request()->routeIs('admin.notification_history'))
                        <a href="{{ route('admin.clear_history') }}" class="btn btn-danger  d-sm-inline-block">Clear
                            History</a>
                    @endif



                    <a href="{{ route('home') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="View Website">
                        <x-tabler-eye class="icon" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
