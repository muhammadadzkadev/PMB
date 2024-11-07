<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-teal-800 mb-2">
            Welcome Back
        </h2>
        <p class="text-sm text-teal-600">Sign in to access your medical records</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-teal-700 mb-1">Email Address</label>
            <input id="email" name="email" type="email" autocomplete="email" required 
                   class="appearance-none rounded-md block w-full px-3 py-2 border border-teal-300 placeholder-teal-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                   placeholder="Enter your email" value="{{ old('email') }}">
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-teal-700 mb-1">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required 
                   class="appearance-none rounded-md block w-full px-3 py-2 border border-teal-300 placeholder-teal-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                   placeholder="Enter your password">
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox" 
                       class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-teal-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-teal-700">
                    Remember me
                </label>
            </div>
            @if (Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-teal-600 hover:text-teal-500 transition duration-150 ease-in-out">
                        Forgot password?
                    </a>
                </div>
            @endif
        </div>

        <div>
            <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-teal-500 to-blue-500 hover:from-teal-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out">
                Sign in
            </button>
        </div>
    </form>

    <!-- Display any errors -->
    @if ($errors->any())
        <div class="mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md" role="alert">
            <p class="font-bold">Error</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
</x-guest-layout>