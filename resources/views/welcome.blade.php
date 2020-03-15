<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'ZA Mobile Numbers Validator') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <main class="main-content text-center mt-5">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="heading">
                    <h1>{{ config('app.name', 'ZA Mobile Numbers Validator') }}</h1>
                </div>
                <!-- Handle CSV Upload -->
                <div class="container-fluid text-center mt-5">
                    <form class="form-inline" method="post" action="{{ route('csv_upload') }}" enctype="multipart/form-data">
                        @csrf
                        <label class="my-1 mr-2" for="exampleFormControlFile1">
                            Upload a csv file with mobile numbers to check:
                        </label>
                        <input
                            type="file"
                            class="form-control-file"
                            name="csv_file"
                            id="csv_file"
                        />
                        <button class="btn btn-primary">Submit</button>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <!-- React Main App Component -->
                    <div class="mt-5" id="app"></div>
                </div>
            </div>
        </main>
    </body>
</html>
