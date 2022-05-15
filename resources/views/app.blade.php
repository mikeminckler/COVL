<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>COVL</title>

    <script src="{{ mix('/js/app.js') }}" defer></script>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link href="/css/v-calendar.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/633491a977.js" crossorigin="anonymous"></script>

</head>
<body class="relative h-full flex flex-col min-h-[100vh]">

    <div id="app" class="relative flex-1 flex items-center flex-col">

        @auth
        <div class="flex items-end my-2 border-b border-slate-300 p-2">
            <a href="/" class="mx-2"><img src="/images/covl_logo.png" class="h-[75px]" /></a>
            @foreach ([ 'game-days', 'leagues', 'teams', 'seasons' ] as $route)
                <a href="{{ route($route) }}" class="mx-4 p-2 mb-2">{{ Illuminate\Support\Str::title($route) }}</a>
            @endforeach
            <div class="mb-3 mx-4">
                <form action="/logout" method="POST" class="contents">
                    @csrf
                    <button class="bg-transparent text-amber-500 font-light">Logout</button>
                </form>
            </div>
        </div>
        @endauth

        <div class="items-center flex-1 flex flex-col relative w-full p-8">
            @yield ('content')
        </div>

    </div>

</body>
</html>
