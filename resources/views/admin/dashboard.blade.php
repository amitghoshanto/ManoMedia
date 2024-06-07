<x-layouts.admin :meta="$meta_tag">
    <x-breadcrumb.panel :title="$meta_tag['title']" />
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                <div class="container-tight">
                    <div class="card mb-2">
                        <div class="card-body">
                            <h2> Welcome to Admin Panel</h2>
                            <h3>Total Notification Alllowed -  {{ $count_allowed }}</h3>
                            <h3>Total Notification Decline -  {{ $count_decline }}</h3>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>


</x-layouts.admin>
