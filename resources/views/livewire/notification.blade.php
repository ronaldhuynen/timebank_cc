<div class="pt-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        @if ( session('notification.secondary') )
            <div class="my-2">
            <x-alert title="{{ __(session('notification.secondary')) }}" secondary flat>
                <x-slot name="slot">
                    {{ __(session('notification.secondary.details')) }}
                </x-slot>
            </x-alert>
            </div>
        @endif

        @if ( session('notification.success') )
            <div class="my-2">
            <x-alert title="{{ __(session('notification.success')) }}" positive flat>
                <x-slot name="slot">
                    {{ __(session('notification.success.details')) }}
                </x-slot>
            </x-alert>
            </div>
        @endif

        @if ( session('notification.error') )
            <div class="my-2">
            <x-alert title="{{ __(session('notification.error')) }}" negative flat>
                <x-slot name="slot">
                    {{ __(session('notification.error.details')) }}
                </x-slot>
            </x-alert>
            </div>
        @endif

        @if ( session('notification.alert') )
            <div class="my-2">
            <x-alert title="{{ __(session('notification.alert')) }}" warning flat>
                <x-slot name="slot">
                    {{ __(session('notification.alert.details')) }}
                </x-slot>
            </x-alert>
            </div>
        @endif

        @if ( session('notification.info') )
            <div class="my-2">
            <x-alert title="{{ __(session('notification.info')) }}" info flat>
                <x-slot name="slot">
                    {{ __(session('notification.info.details')) }}
                </x-slot>
            </x-alert>
            </div>
        @endif
        
    </div>
</div>