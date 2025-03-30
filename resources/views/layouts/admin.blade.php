// resources/views/layouts/admin.blade.php
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - NGO Platform</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white p-4">
            <h2 class="text-xl font-bold">Admin Panel</h2>
            <ul class="mt-4">
                <li><a href="{{ route('dashboard') }}" class="block py-2 hover:bg-gray-700">Dashboard</a></li>
                <li><a href="{{ route('causes.index') }}" class="block py-2 hover:bg-gray-700">Causes</a></li>
                <li><a href="{{ route('donations.index') }}" class="block py-2 hover:bg-gray-700">Donations</a></li>
                <li><a href="{{ route('services.index') }}" class="block py-2 hover:bg-gray-700">Services</a></li>
                <li><a href="{{ route('testimonials.index') }}" class="block py-2 hover:bg-gray-700">Testimonials</a></li>
                <li><a href="{{ route('teams.index') }}" class="block py-2 hover:bg-gray-700">Team</a></li>
                <li><a href="{{ route('users.index') }}" class="block py-2 hover:bg-gray-700">Users</a></li>
                <li><a href="{{ route('audit-logs.index') }}" class="block py-2 hover:bg-gray-700">Audit Logs</a></li>
                <li><a href="{{ route('logout') }}" class="block py-2 hover:bg-gray-700">Logout</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>
    @livewireScripts
</body>
</html>
