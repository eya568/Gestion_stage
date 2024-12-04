<section class="flex justify-center items-center h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <header class="mb-6 text-center">
            <h2 class="text-2xl font-semibold text-gray-900">
                {{ __('Update Password') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
            <style>
                .custom-button {
                    background-color: #ff5733;
                    color: #ffffff;
                }

                .custom-button:hover {
                    background-color: #c70039;
                }
            </style>

        </header>

        <form method="post" action="{{ route('password.update') }}" class="space-y-6 text-center">
            @csrf
            @method('put')

            <div class="flex flex-col items-center">
                <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-center" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full max-w-xs" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="flex flex-col items-center">
                <x-input-label for="update_password_password" :value="__('New Password')" class="text-center" />
                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full max-w-xs" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div class="flex flex-col items-center">
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-center" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full max-w-xs" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex justify-between items-center mt-4">
                <x-primary-button class=" shadow-md hover:bg-red-700 focus:ring focus:ring-red-300 transition duration-200 ease-in-out custom-button">
                    {{ __('Save') }}
                </x-primary-button>

                @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>