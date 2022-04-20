<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-xl text-center text-gray-600">
            {{ __('Currently, access is disabled.') }}
        </div>

        @if (Auth::user()->status === \TwentySixB\LaravelAccountStatus\AccountStatus::QUEUED)
            <div class="mb-4 text-sm font-medium text-red-800">
                {{ __('We are still under heavy development, your account is queued for activation.') }}
            </div>

            <div class="mb-4 text-sm font-medium text-gray-600">
                {{ __('Thank you so much for your interest and please keep an eye on your e-mail. We will be in touch soon.') }}
            </div>
        @endif

        {{-- Example of how to handle more statuses. --}}
        @if (Auth::user()->status === \TwentySixB\LaravelAccountStatus\AccountStatus::SUSPENDED)
            <div class="mb-4 text-sm font-medium text-red-800">
                {{ __('You have been naughty. You cannot play anymore.') }}
            </div>
        @endif

    </x-jet-authentication-card>
</x-guest-layout>
