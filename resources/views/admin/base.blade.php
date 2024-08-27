<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @livewireStyles
</head>
@if(Route::is('admin.auth.login'))
<body>
    @yield('content')
</body>
@else
<body dir="rtl" x-data="{ page: 'formElements','darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
        x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
            $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}" >

    <div class="flex h-screen overflow-hidden">
        @include('admin.layouts.partials.sidebar')
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <header class="sticky top-0 z-999 flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none">
                @include('admin.layouts.partials.header')
            </header>
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    @vite('resources/js/app.js')
    @livewireScripts

    @yield('footer')
</body>
@endif
</html>
