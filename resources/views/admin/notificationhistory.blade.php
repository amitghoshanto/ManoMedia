<x-layouts.admin :meta="$meta_tag">
    <x-breadcrumb.panel :title="$meta_tag['title']" />
    <!-- Page body -->



    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">ID </th>

                                        <th>Title</th>
                                        <th>Icon</th>
                                        <th>Image</th>
                                        <th>Body</th>
                                        <th>Short URL</th>
                                        <th>Long Url</th>
                                        <th>Click Count</th>
                                        <th>Created</th>
                                        <th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="apenddata">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                {{ $i }}
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->icon }}</td>
                                            <td><a href="{{ $item->image }}" target="_blank"> {{ $item->image }} </a>
                                            </td>
                                            <td>{{ $item->body }}</td>
                                            <td><a href="{{ $item->short_url }}" target="_blank"> {{ $item->short_url }}
                                                </a></td>
                                            <td><a href="{{ $item->full_url }}" target="_blank"> {{ $item->full_url }}
                                                </a></td>
                                            <td>


                                                @if ($item->shorturl_id)
                                                    @if (count($item->shorturl_id->visitcheck) > 0)
                                                        {{ count($item->shorturl_id->visitcheck) }}
                                                    @else
                                                        0
                                                    @endif
                                                @else
                                                    0
                                                @endif

                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif ($item->status == 2)
                                                    <span class="badge bg-danger text-white">Failed</span>
                                                @else
                                                    <span class="badge bg-success text-white">Success</span>
                                                @endif
                                            </td>


                                        </tr>





                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>




</x-layouts.admin>
