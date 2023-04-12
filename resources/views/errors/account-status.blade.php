<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-xl text-center text-gray-600">
            {{ $exception->getMessage() }}
        </div>

        {{-- Example of how to handle QUEUED accounts. --}}
        @if ($status === \TwentySixB\LaravelAccountStatus\AccountStatus::QUEUED)
            <div class="mb-4 text-sm font-medium text-red-800 text-center">
                {{ __('We are still under heavy development, your account is queued for activation.') }}
            </div>

            <div class="mb-4 text-sm font-medium text-gray-600 text-center">
                {{ __('Thank you so much for your interest and please keep an eye on your e-mail. We will be in touch soon.') }}
            </div>
        @endif

        {{-- Example of how to handle SUSPENDED accounts. --}}
        @if ($status === \TwentySixB\LaravelAccountStatus\AccountStatus::SUSPENDED)
            <div class="mb-4 text-sm font-medium text-red-800 text-center">
                {{ __('Your account is suspended. You cannot play anymore.') }}
            </div>
        @endif

    </x-authentication-card>
</x-guest-layout>
