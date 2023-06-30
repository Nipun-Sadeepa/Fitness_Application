<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="fName" :value="__('First Name')" />
            <x-text-input id="fName" class="block mt-1 w-full" type="text" name="fName" :value="old('fName')" required autofocus autocomplete="fName" />
            <x-input-error :messages="$errors->get('fName')" class="mt-2" />
        </div> <br>

        <!-- Last Name -->
        <div>
            <x-input-label for="lName" :value="__('Last Name')" />
            <x-text-input id="lName" class="block mt-1 w-full" type="text" name="lName" :value="old('lName')" required autocomplete="lName" />
            <x-input-error :messages="$errors->get('lName')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div><br>

        <!-- Contact No -->
        <div>
            <x-input-label for="contactNo" :value="__('Contact No')" />
            <x-text-input id="contactNo" class="block mt-1 w-full" type="text" name="contactNo" :value="old('contactNo')" minlength="10" maxlength="10" required />
            <x-input-error :messages="$errors->get('contactNo')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
