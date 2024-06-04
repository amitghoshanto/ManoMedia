<x-layouts.main :meta="$meta_tag">

    <body class=" d-flex flex-column">
        <div class="page page-center">
            <div class="container container-normal py-4">
                <div class="row align-items-center g-4 justify-content-center">
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="img-responsive img-responsive-4x1 card-img-top"
                                style="background-image: url({{ asset('artwork.jpg') }})">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Download the Smart Money Concepts Top Trading Secrets.</h3>
                                <p class="text-secondary">In order to download this free ebook, Please allow
                                    notifications, without allow notification you can't download file</p>
                                <a href="{{ route('download') }}" class="btn btn-dark  btn-lg w-100"
                                    id="downloadfilebutton">
                                    Download </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-layouts.main>
