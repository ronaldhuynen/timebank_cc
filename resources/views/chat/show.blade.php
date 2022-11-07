<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timebank chat messenger') }}

        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        {{-- TODO change into canMessage --}}
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())

        @extends('messenger::messenger')


        @switch($mode)
        @case(0)
        @push('Messenger-load')
        ThreadManager : {
        type : 0,
        setup : true,
        online_status_setting : {{messenger()->getProviderMessenger()->online_status}},
        thread_id : '{{$thread_id}}',
        src : 'ThreadManager.js'
        },
        @endpush
        @break
        @case(3)
        @push('Messenger-load')
        ThreadManager : {
        type : 3,
        online_status_setting : {{messenger()->getProviderMessenger()->online_status}},
        setup : true,
        id : '{{$id}}',
        alias : '{{$alias}}',
        src : 'ThreadManager.js'
        },
        @endpush
        @break
        @case(5)
        @push('Messenger-load')
        ThreadManager : {
        type : 5,
        online_status_setting : {{messenger()->getProviderMessenger()->online_status}},
        setup : true,
        src : 'ThreadManager.js'
        },
        @endpush
        @break
        @endswitch
        @push('Messenger-modules')
        ThreadTemplates : {src : 'ThreadTemplates.js'},
        MessengerSettings : {src : 'MessengerSettings.js'},
        EmojiPicker : {src : 'EmojiPicker.js'},
        ThreadBots : {src : 'ThreadBots.js'},
        @endpush

        {{-- --}}
        @endif


    </div>




    </div>

</x-app-layout>
