@props(['meta'])
<!doctype html>
<html lang="en">

<head>
    <title>
        Admin Login
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/js/app.js'])

</head>

<body class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1674944800"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">




            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img
                        src="{{ asset('images/svg/header-logo.svg') }}" height="36" alt=""></a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Admin Login</h2>

                    @if ($errors->any())
                        <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                                    <!-- SVG icon code with class="alert-icon" -->
                                </div>
                                <div>
                                    <span>
                                        @foreach ($errors->all() as $error)
                                            <span>{{ $error }}</span>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            {{-- email admin2@thetolet.com --}}
                            <input type="email" class="form-control" placeholder="" autocomplete="off" name="email"
                                value="admin@gmail.com">





                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('pass') }} :</label>
                            <div class="input-group input-group-flat">
                                {{-- pass 1122 --}}
                                <input type="password" class="form-control" autocomplete="off" id="l-password"
                                    name="password" required="required" value="123456">
                                <span class="input-group-text">
                                    <a href="#" class="input-group-link" onclick="chnagePassType()"
                                        id="show_pass_button">Show password</a>
                                </span>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                </div>


            </div>

        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script>
        function chnagePassType() {
            var l_pass = document.getElementById("l-password");
            var show_pass_button = document.getElementById("show_pass_button");
            if (l_pass.type === "password") {
                l_pass.type = "text";
                show_pass_button.innerHTML = "Hide Password";
            } else {
                l_pass.type = "password";
                show_pass_button.innerHTML = "Show Password";
            }
        }
    </script>
</body>


</html>
