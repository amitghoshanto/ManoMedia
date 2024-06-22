<x-layouts.admin :meta="$meta_tag">
    <x-breadcrumb.panel :title="$meta_tag['title']" />
    <!-- Page body -->



    <div class="page-body">
        <div class="container-xl">

            {{-- @if ($errors->any())


                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif --}}



            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="row row-deck row-cards justify-content-center">
                <div class="col-md-6">





                    <div class="card">


                        <div class="card-body">
                            <h2> Send Notification</h2>

                            <form action="{{ route('admin.send_category_wise', [$category]) }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">{{ Str::ucfirst($category) }}</label>
                                    <select class="form-select @error('category_data') is-invalid @enderror"
                                        name="category_data">
                                        <option value="">Select {{ $category }}</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->$category }}">{{ Str::ucfirst($item->$category) }}
                                                | Users :
                                                {{ $item->count }}</option>
                                        @endforeach



                                    </select>

                                    @error('category_data')
                                        <small class="form-hint text-danger">{{ Str::ucfirst($category) }} select is
                                            required</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label ">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title') }}">

                                    @error('title')
                                        <small class="form-hint text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label ">Message</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="5">{{ old('body') }}</textarea>

                                    @error('body')
                                        <small class="form-hint text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image Link</label>
                                    <input type="text" class="form-control" name="image"
                                        value="https://manomedia.shop/favicon/apple-icon-180x180.png">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Full URL</label>
                                    <input type="text" class="form-control @error('full_url') is-invalid @enderror"
                                        name="full_url" value="{{ old('full_url') }}">


                                    @error('full_url')
                                        <small class="form-hint text-danger">{{ $message }}</small>
                                    @enderror




                                </div>


                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </form>
                        </div>


                    </div>



                    {{-- <div class="card">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">ID </th>
                                        <th>{{ $category }}</th>
                                        <th>User Count</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="apenddata">
                                    @php
                                        $i = 1;
                                    @endphp
                                    

                                </tbody>
                            </table>
                        </div>

                    </div> --}}
                </div>
            </div>
        </div>
    </div>




</x-layouts.admin>
