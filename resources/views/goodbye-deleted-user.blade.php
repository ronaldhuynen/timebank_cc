<x-guest-layout>
    @if (session('deleted_at'))
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900">
            {{ __('Goodbye')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6 sm:px-20">

                    <div class="mt-12">
                        <!-- TODO: insert goodbye image here -->

                        <div class="mt-8 text-5xl font-bold text-gray-900">
                            {{ __('Your profile has been deleted') }}
                        </div>
                    </div>
                    <div class="mb-12 mt-6 flex justify-between">
                        <p class="text-xl font-bold text-gray-900">{{ __('All your personal data, including all your uploaded files and messages havejust been permanently deleted.') }}</p>
                    </div>
                    <div class="mb-12 mt-6 flex justify-between">
                        <p class="text-lg text-gray-900">{{ __('Your profile has been deleted on:') }} {{ session('deleted_at') }}</p>
                    </div>
                    <div class="mb-12 mt-6 flex justify-between">
                        <p class="text-lg text-gray-900">{{ __('On behalf of the Timebank.cc team, hope to see you next time!') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- No session('deleted_at') present --> 
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
    @endif
</x-guest-layout>