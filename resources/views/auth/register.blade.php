<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h3 class="welcome-title">Time2Share</h3>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />

                <x-input id="address" class="block mt-1 w-full" type="text" name="address" placeholder="streetname 1" :value="old('address')" required />
            </div>

            <!-- Place -->
            <div class="mt-4">
                <x-label for="place" :value="__('Place')" />

                <x-input id="place" class="block mt-1 w-full" type="text" name="place" placeholder="Amsterdam" :value="old('place')" required />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phonenumber" :value="__('Phonenumber')" />

                <x-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" placeholder="0612345678" :value="old('phonenumber')" maxlength="10"/>
            </div>

            <!-- Birthday -->
            <div class="mt-4">
                <x-label for="birthday" :value="__('Birthday')" />

                <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4" style="background-color: rgb(59 130 246) !important;">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
<style>
    .welcome-title {
        font-weight: bold !important;
        font-size: 300% !important;
        font-family: 'Courier New', Courier, monospace;
        text-align: center;
        margin-top: 10%;
    }
</style>