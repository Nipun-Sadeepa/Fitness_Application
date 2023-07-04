<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Application</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .custom-bg {
            background-color: #b1bbc4;
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-light">

        <main>

            <nav class="navbar navbar-expand-lg custom-bg border">
                <div class="collapse navbar-collapse d-flex" id="navbarNav">
                    <h2>Fitness Application</h2>
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item">
                                @if(auth()->user()->role=="manager")
                                <a class="nav-link active btn btn-primary" aria-current="page" href="/manager">Home</a>
                                @elseif(auth()->user()->role=="trainer")
                                <a class="nav-link active btn btn-primary" aria-current="page" href="/trainer">Home</a>
                                @else(auth()->user()->role=="member")
                                <a class="nav-link active btn btn-primary" aria-current="page" href="/user">Home</a>
                                @endif
                            </li>&nbsp&nbsp
                            <li class="nav-item">
                                <a class="nav-link active btn btn-primary" aria-current="page" href="/logout">LogOut</a>
                            </li>&nbsp&nbsp
                            <li class="nav-item">
                                <a class="nav-link active btn btn-primary" aria-current="page" href="javascript:window.history.back()">Back</a>
                            </li>&nbsp&nbsp

                        @else
                            <li class="nav-item">
                                <a class="nav-link active btn btn-primary" aria-current="page" href="/guest">Home</a>
                            </li>&nbsp&nbsp
                            <li class="nav-item">
                                <a class="nav-link active btn btn-primary" aria-current="page" href="/">Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
            <br>

            @yield('content')

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>