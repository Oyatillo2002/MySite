<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-gray-800 p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Admin Login</h2>
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-400 text-sm mb-2">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-indigo-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-400 text-sm mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-indigo-500">
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition">Sign In</button>
        </form>
    </div>
</body>
</html>