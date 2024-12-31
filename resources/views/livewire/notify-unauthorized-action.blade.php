<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200 h-30">

                <!-- Photo -->
                <img class="mt-8 mr-8 relative float-right w-24 h-24 rounded-full object-cover shadow" src="{{ Storage::url(session('activeProfilePhoto')) }}" alt="{{ __('Your email has been verified successfully') }}" />

                <div class="mt-8 text-lg">
                        {{ session('unauthorizedAction') }}
                </div>
            </div>
        </div>
    </div>
</div>

