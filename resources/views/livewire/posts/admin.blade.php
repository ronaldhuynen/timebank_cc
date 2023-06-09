<div>
    <button wire:click.prevent="create"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Add new post
    </button>

    <table class="table min-w-full mt-4">
        <thead>
        <tr>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">{{ __('Id') }}</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">{{ __('Title') }}</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">{{ __('Start date') }}</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">{{ __('End date') }}</th>
        </tr>
        </thead>
        <tbody>
                {{-- {{ dd($posts)}} --}}

        @forelse ($posts as $post)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                    {{ $post->id }}
                </td>
                @forelse($post->translations as $translation)
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                {{ $translation->title }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                    @if ($translation->start)
                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($translation->start))->isoFormat('LL'); }}
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                    @if ($translation->stop)
                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($translation->stop))->isoFormat('LL'); }}
                    @endif
                </td>
                @empty
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                    [ {{ __('without translation') }} ]
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                </td>
                @endforelse
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                    <button
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"
                        wire:click.prevent="edit({{ $post->id }})">{{ __('Edit') }}
                    </button>
                    <button
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"
                        wire:click.prevent="stop({{ $translation->id }})"
                        onclick="confirm('Do you want to end the publication of this post?') || event.stopImmediatePropagation()">{{ __('Stop') }}
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">{{ __('No posts found.') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}

    <div
        class="@if (!$showModal) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded-lg w-1/2">
            <form wire:submit.prevent="save" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="flex items-center w-full pb-4">
                        <div class="text-gray-900 font-medium text-lg">{{ $postId ? 'Edit Post' : 'Add New Post' }}</div>
                        <svg wire:click="close"
                             class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                        </svg>
                    </div>
                    <div class="py-2 w-full">
                    {{-- TODO: Create form using $index to update all locales --}}
                    @foreach ($post->translations as $index => $translation)

                        <label class="block font-medium text-sm text-gray-700">
                            {{ __('Title') }}
                        </label>
                        <input wire:model.defer="post.title"
                               class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"/>
                        @error('post.title')
                            <p class="mt-2 text-sm text-red-600" id="title-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="py-2 w-full">
                        <x-textarea wire:model="post.excerpt" label="{{ __('Intro')}}" placeholder="" />
                        @error('post.excerpt')
                            <p class="mt-2 text-sm text-red-600" id="content-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="py-2 w-full">
                        <x-textarea wire:model="post.content" label="{{ __('Content')}}" placeholder="" />
                        @error('post.content')
                            <p class="mt-2 text-sm text-red-600" id="content-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="py-2 w-full">
                    <x-textarea wire:model="post.content" label="{{ __('Content')}}" placeholder="" />
                    @error('post.locale')
                        <p class="mt-2 text-sm text-red-600" id="content-error">{{ $message }}</p>
                    @enderror
                    </div>


                        <div class="flex space-x-12">
                            <div class="flex-none w-1/4 my-6">
                                <x-input wire:model="search" right-icon="search" label="{{ __('Category') }}" placeholder="Select a publication category" :clearable="true" />
                            </div>
                            <div class="flex-auto my-6 z-50">
                                <x-datetime-picker label="{{ __('Start of publication') }}" placeholder="{{ __('Select a date') }}" wire:model.defer="start" :without-time="true" display-format="DD-MM-YYYY" />
                            </div>
                            <div class="flex-auto my-6 z-50">
                                <x-datetime-picker label="{{ __('End of publication') }}" placeholder="{{ __('Select a date') }}" wire:model.defer="stop" :without-time="true" display-format="DD-MM-YYYY" />
                            </div>
                        </div>

                    @endforeach


                    <div class="ml-auto border-t mt-6">
                        <button class="bg-black hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                type="submit">{{ $postId ? __('Update') : __('Save') }}
                        </button>
                        <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                                wire:click="close"
                                type="button"
                                data-dismiss="modal">{{ __('Close') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
