
<div class="pt-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

        @if (session('email-profile'))
            <div class="my-2">
                <x-alert title="{{ __('messages.email_of_profile_has_been_verified', ['profile_name' => session('email-profile')]) }}  " positive flat>
                </x-alert>
            </div>
        @else
            <div class="my-2">
                <x-alert title="{{ __('Your email has been verified successfully')}}" positive flat>
                </x-alert>
            </div>
        @endif
        
    </div>
</div>