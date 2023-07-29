<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900">
            {{ $category }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6 sm:px-20">

                    <div class="mt-12">
                        @if ($media != null)
                            {{ $media('4_3') }}
                        @endif
                    </div>
                    <div class="mb-2 mt-6 flex justify-between">
                        <span class="text-sm font-thin text-gray-500">{{ __('Updated on') }} {{ $update }}</span>
                    </div>
                    <div class="mt-8 text-5xl font-bold text-gray-900">
                        {{ $post->translations->first()->title }}
                    </div>
                    @if (isset($post->meeting->from))
                        <div class="mt-8 text-5xl font-bold text-gray-900">
                            {{ Illuminate\Support\Carbon::parse($post->meeting->from)->isoFormat('dddd D MMMM H:m') . ' ' . __('h.') }}
                        </div>
                    @endif
                    @if (isset($post->translations->first()->excerpt))
                        <div class="mt-6">
                            <div class="px-0 py-2 text-xl font-bold text-gray-900">
                                {{ $post->translations->first()->excerpt }}
                            </div>
                        </div>
                    @endif
                    @if (isset($post->translations->first()->content))
                        <div class="my-6 text-lg text-gray-900">
                            {!! $post->translations->first()->content !!}
                        </div>
                    @endif
                    @if (isset($post->meeting))
                        @if (isset($post->meeting->address))
                            <div class="text-lg font-bold text-gray-900">
                                {{ $post->meeting->address }}
                            </div>
                        @endif
                        @if (isset($post->meeting->meetingable->name) && isset($post->meeting->meetingable->profile_photo_path))
                            <div class="text-lg font-bold text-gray-900">
                                {{ __('Organizer') }} :
                                {{ $post->meeting->meetingable->name }}<img
                                    src="{{ url(Storage::url($post->meeting->meetingable->profile_photo_path)) }}"
                                    class="w-10 rounded-full">
                            </div>
                        @endif
                    @endif
                <div class="mb-6 mt-12 flex justify-between">
                    <span
                        class="text-sm font-thin text-gray-500">{{ __('Written by') . ' ' . $post->postable->name . ' ' . __('on') . ' ' . $update }}</span>
                    <div class="flex justify-end">
                        <span class="mb-2 hidden font-bold text-gray-900 sm:block">{{ __('More articles') }}</span>
                        <div class="ml-1 mt-1">
                            <svg viewBox="0 0 20 20" class="h-4 w-4">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
