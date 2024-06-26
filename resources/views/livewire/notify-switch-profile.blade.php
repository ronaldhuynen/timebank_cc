<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200 h-30">

                <!-- Photo -->
                <img class="mt-8 mr-8 relative float-right w-24 h-24 rounded-full object-cover shadow" src="{{ Storage::url(Session('activeProfilePhoto')) }}" alt="{{ Session('activeProfileName') }}" />

                <div class="mt-8 text-lg">
                    {{ __('You are now acting as:') }}
                </div>
                <div class="mt-2 text-2xl">
                    {{ Session('activeProfileName') }}
                </div>

                <div class="my-6 text-gray-500">
                    {{__('You have selected a new active profile. All your browser sessions have switched to this profile.')}}
                </div>

            </div>
        </div>
    </div>
</div>


