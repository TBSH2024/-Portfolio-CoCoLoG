<x-guest-layout>
    <div class="w-full max-w-xl mx-auto px-6 py-4 bg-white shadow-lg rounded-lg">
        @section('title', 'CocoLog / 会員登録')
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h1 class="text-4xl mt-4 font-bold text-green-600 text-center">CocoLog</h1>
            <h2 class="mt-4 mb-4 text-xl font-bold text-center">会員登録</h2>

            <!-- Name -->
            <div class="flex items-center">
                <x-input-label for="name" :value="__('Name')" class="mr-2" />
                <span class="text-xs text-pink-500">必須</span>
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <!-- Email Address -->
            <div class="mt-4 flex items-center">
                <x-input-label for="email" :value="__('Email')" class="mr-2" />
                <span class="text-xs text-pink-500">必須</span>
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <!-- Password -->
            <div class="mt-4 flex items-center">
                <x-input-label for="password" :value="__('Password')" class="mr-2" />
                <span class="text-xs text-pink-500">必須（8文字以上）</span>
            </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Confirm Password -->
            <div class="mt-4 flex items-center">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mr-2" />
                <span class="text-xs text-pink-500">必須</span>
            </div>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
