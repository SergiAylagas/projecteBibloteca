<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-lg font-bold">Admin Panel</h1>
                <nav class="mt-4">
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a></li>
                        <li><a href="{{ route('admin.users') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Users</a></li>
                        <li><a href="{{ route('admin.settings') }}" class="block py-2 px-4 hover:bg-gray-700">Settings</a></li>
                    </ul>
                </nav>
            </div>
        </aside>
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>