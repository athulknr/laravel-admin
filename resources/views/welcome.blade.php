<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page - Grid Layout</title>
    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">

        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >Log in</a>@if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background: #128cd3;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .blog {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .blog:hover {
            transform: translateY(-5px);
        }
        .blog img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .blog h2 {
            color: #333;
            font-size: 20px;
            margin: 10px 0;
        }
        .blog p {
            color: #555;
        }
        .read-more {
            color: #128cd3;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }
        .read-more:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>Blogs</h1>
</header>

<div class="container">
    <div class="blog">
        <h2>Blog Title 1</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean suscipit...</p>
        <a href="#" class="read-more">Read More</a>
    </div>

    <div class="blog">
        <h2>Blog Title 2</h2>
        <p></p>
        <a href="#" class="read-more">Read More</a>
    </div>

    <div class="blog">
        <h2>Blog Title 3</h2>
        <p>Nullam eget felis ut nulla vehicula tincidunt sit amet non est...</p>
        <a href="#" class="read-more">Read More</a>
    </div>

    <div class="blog">
        <h2>Blog Title 4</h2>
        <p>Donec et sapien eget lacus facilisis interdum. Vestibulum ante ipsum...</p>
        <a href="#" class="read-more">Read More</a>
    </div>
</div>

</body>
</html>
