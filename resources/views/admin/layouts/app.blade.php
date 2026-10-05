<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0">
            <div class="p-4 border-b border-gray-800">
                <h2 class="text-xl font-bold">Oyatillo<span class="text-indigo-400">.dev</span></h2>
                <p class="text-xs text-gray-400 mt-1">Admin Panel</p>
            </div>
            <nav class="mt-4 px-2 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-indigo-400' : '' }}">Dashboard</a>
                <a href="{{ route('admin.projects.index') }}" class="block py-2 px-3 rounded hover:bg-gray-800 {{ request()->routeIs('admin.projects.*') ? 'bg-gray-800 text-indigo-400' : '' }}">Projects</a>
                <a href="{{ route('admin.skills.index') }}" class="block py-2 px-3 rounded hover:bg-gray-800 {{ request()->routeIs('admin.skills.*') ? 'bg-gray-800 text-indigo-400' : '' }}">Skills</a>
                
                <form action="{{ route('admin.logout') }}" method="POST" class="absolute bottom-4 left-0 w-full px-4">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 px-3 rounded hover:bg-red-900/50 text-red-400">Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>