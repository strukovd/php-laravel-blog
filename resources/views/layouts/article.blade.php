<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Блог</title>
    @yield('cssPlace')
    @yield('jsPlace')
</head>
<body>
    <header class="header">
        @yield('header')
    </header>

    <main>
        <div class="main-content">
        @yield('main-content')
        </div>
    </main>

    <footer class="footer">
        @yield('footer')
    </footer>
</body>
</html>
