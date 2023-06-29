<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ $category }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                  <div class="mt-12">
                        {{ $media('4_3') }}
                    </div>
                        <div class="flex justify-between mb-2 mt-6">
                        <span class="font-thin text-sm text-gray-500">{{ __('Updated on')}} {{ $update }}</span>
                        </div>

                    <div class="mt-8 text-5xl font-bold text-gray-900">
                        {{ $post->translations->first()->title }}
                    </div>

                    <div class="mt-6">
                        <div class="px-0 py-2 text-gray-900 text-xl font-bold text-sm">
                            {{ $post->translations->first()->excerpt }}
                        </div>

                        <div class="text-gray-900 my-6 text-lg">
                            {!! $post->translations->first()->content !!}
                        </div>
                    </div>
                    <div class="flex justify-between mb-2 mt-6">
                        <span class="font-thin text-sm text-gray-500">{{ __('Written by')}} {{ $post->postable->name }}</span>
                        <div class="flex justify-end">
                            <span class="sm:block hidden mb-2 text-gray-900 font-bold">{{ __('More articles') }}</span>
                            <div class="ml-1 mt-1">
                                <svg viewBox="0 0 20 20" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
</x-app-layout>
