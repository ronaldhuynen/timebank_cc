<div class="mt-12">


    <!-- Action buttons -->
    <button wire:click.prevent="create"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ __('Add new post') }}
    </button>
    <button wire:click.prevent="deleteSelected"
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            class="@if ($bulkDisabled) opacity-50 @endif bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
        {{ __('Delete selected') }}
    </button>

    <table class="table min-w-full mt-6 border-white">


        <!-- Table head -->
        <thead>
        <tr>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Id') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Category') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Language') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Title') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Start date') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('End date') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
        </tr>
        </thead>


        <!-- Table body -->
        <tbody >
        @forelse ($posts as $post)
        @if (($post->translations->count() === 0))
        {{-- Do not show post without any translation --}}
        @else
        <tr>
            <td colspan="9">
                    @foreach($post->translations as $key => $translation)
                        <tr class="transition duration-300 ease-in-out hover:bg-gray-100 dark:bordergray-600 dark:hover:bg-gray-600">
                            <td class="px-6 py34 whitespace-no-wrap border-b border-white text-sm leading-5">
                                <input type="checkbox" wire:model="bulkSelected" value="{{ $translation->id }}">
                            </td>
                            <td class="px-6 py-3 whitespace-no-wrap border-b border-white text-sm leading-5">
                                {{ $post->id }}
                            </td>
                            <td class="px-6 py-3 whitespace-no-wrap border-b border-white text-sm leading-5">
                                @if (($post->category->translations->first()))
                                     {{ $post->category->translations->first()->name }}
                                @endif
                            </td>
                            <td class="px-6 py-3 whitespace-no-wrap border-b border-white text-sm leading-5">
                                {{ $translation->locale }}
                            </td>
                            <td class="px-6 py-3 whitespace-no-wrap border-b border-white text-sm leading-5">
                                {{ $translation->title }}
                            </td>
                            <td class="px-6 py-3 whitespace-no-wrap border-b border-white text-sm leading-5">
                                @if ($translation->start)
                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($translation->start))->isoFormat('LL'); }}
                                @endif
                            </td>
                            <td class="px-6 py-3 whitespace-no-wrap border-b border-white text-sm leading-5">
                                @if ($translation->stop)
                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($translation->stop))->isoFormat('LL'); }}
                                @endif
                            </td>


                            <!-- Row buttons -->
                            <td class="py-2.5 whitespace-no-wrap border-b border-white text-sm leading-5">
                            @if ($translation->start < \Carbon\Carbon::now() && $translation->start !== null)
                                @if ($translation->stop > \Carbon\Carbon::now() || $translation->stop === null)
                                    <button
                                        class="inline-flex items-center px-4 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"
                                        wire:click.prevent="stop({{ $translation->id }})"
                                        onclick="confirm('Do you want to end the publication of this post?') || event.stopImmediatePropagation()"> {{ __('Stop') }}
                                    </button>
                                @endif
                            @endif
                            </td>
                            <td class="py-2.5 whitespace-no-wrap border-b border-white text-sm leading-5">
                                <button
                                    class="inline-flex items-center px-4 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"
                                    wire:click.prevent="edit({{ $translation->id }})"> {{ __('Edit') }}
                                </button>
                            </td>


                        </tr>
                    @endforeach
                @endif
            @empty
                <tr>
                    <td colspan="9">
                        {{ __('No posts found.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
<hr>


    <!-- Pagination links -->
    {{ $posts->links() }}


    <!-- Edit modal -->
    <div
        class="@if (!$showModal) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded-lg w-1/2">
            <form wire:submit.prevent="save" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="flex items-center w-full pb-4">
                        <div class="text-gray-900 font-medium text-lg">{{ $postId ? __('Edit post') : __('Create new post') }}</div>
                        <svg wire:click="close"
                             class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                        </svg>
                    </div>
                      <div class="flex py-2 space-x-12">
                            <livewire:category-selectbox  key="{{ Str::random() }}" :categorySelected="$categoryId" />  <!-- Use the key to keep track of component that are in a loop -->
                        @error('categoryId')
                        <p class="mt-2 text-sm text-red-600" id="category-error">{{ $message }}</p>
                        @enderror
                            <livewire:language-selectbox  key="{{ Str::random() }}" :locale="$locale" :exclude="$localeExclude" />  <!-- Use the key to keep track of component that are in a loop -->
                        @error('locale')
                        <p class="mt-2 text-sm text-red-600" id="locale-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="py-2 w-full">
                        <label class="block font-medium text-sm text-gray-700">
                            {{ __('Title') }}
                        </label>
                        <input wire:model.debounce.500ms="post.title"
                               class="mt-2 text-sm sm:text-base text-xl pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"/>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600" id="title-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="py-2 w-full">
                        <label class="block font-medium text-sm text-gray-700">
                            {{ __('Slug') }}
                        </label>
                        <input wire:model.lazy="post.slug"
                               class="mt-2 text-sm sm:text-base text-xl pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"/>
                        @error('post.slug')
                            <p class="mt-2 text-sm text-red-600" id="slug-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="py-2 w-full">
                        <x-textarea wire:model.defer="post.excerpt" label="{{ __('Intro')}}" placeholder="" />
                        @error('post.excerpt')
                            <p class="mt-2 text-sm text-red-600" id="excerpt-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="py-2 w-full">
                        <x-textarea wire:model.debounce.500ms="post.content" label="{{ __('Content')}}" placeholder="" />
                        @error('post.content')
                            <p class="mt-2 text-sm text-red-600" id="content-error">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex space-x-12">
                        <div class="flex-auto my-6 z-50">
                            <x-datetime-picker label="{{ __('Start of publication') }}" placeholder="{{ __('Select a date') }}" wire:model="start" :without-time="true" display-format="DD-MM-YYYY" />
                        </div>
                        <div class="flex-auto my-6 z-50">
                            <x-datetime-picker label="{{ __('End of publication') }}" placeholder="{{ __('Select a date') }}" wire:model="stop" :without-time="true" display-format="DD-MM-YYYY" />
                        </div>
                    </div>
                        @if ($start < \Carbon\Carbon::now() && $start !== null)
                            @if ($stop > \Carbon\Carbon::now() || $stop === null)
                            <div class="text-right mb-3">
                                {{ __('Warning') . ': ' . __('post will be published immeditely!')}}
                            </div>
                            @endif
                        @else
                            <div class="text-right mb-3">
                            </div>
                        @endif

                    <div class="ml-auto mt-6">

                        @if ($createTranslation === true)
                            <button class="bg-black hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                type="submit">{{ $postId ? __('Add Translation') : __('Save') }}
                            </button>
                        @else
                            <button class="bg-black hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                type="submit">{{ $postId ? __('Update') : __('Save') }}
                            </button>
                        @endif
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
