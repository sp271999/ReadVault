<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
               :value="old('email')" 
                required autofocus
                autocomplete="username"  />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" 
                class="block mt-1 w-full" 
                type="password" 
                name="password" 
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

       

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between mt-4">

            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    name="remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        <!-- Login button -->
        <div class="mt-4 flex justify-end">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>

