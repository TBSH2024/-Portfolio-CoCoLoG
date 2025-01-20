<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-sky-50">
        <div class="w-full max-w-xl mx-auto px-6 py-4 bg-white rounded-lg shadow-lg">
        @section('title', 'CocoLog / ログイン')
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <img src="{{ asset('images/logo.png') }}" alt="CocoLogロゴ" class="w-60 h-auto mx-auto my-8">
            <h2 class="mt-4 mb-8 text-2xl font-bold text-center">ログイン</h2>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="w-3/4 mx-auto" />
                <x-text-input id="email" class="block mt-1 w-3/4 mx-auto" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="w-3/4 mx-auto" />
                <x-text-input id="password" class="block mt-1 w-3/4 mx-auto" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4 w-3/4 mx-auto">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="bg-blue-500 hover:bg-blue-700">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <div class="flex justify-center w-full mt-4">
                <a href=" {{route('register')}} " class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md mr-1">登録はこちら</a>
                <span class="text-sm text-gray-600">||</span>
                @if (Route::has('password.request'))
                    <a class="ml-1 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-center" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
        </div>
    </div>
</x-guest-layout>
