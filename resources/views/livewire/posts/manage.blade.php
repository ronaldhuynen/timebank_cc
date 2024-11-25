<div class="mt-12">


    <!-- Action buttons -->
    <div class="ml-auto mt-6 flex space-x-4">
        <button wire:click.prevent="create"
            class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-gray-900 px-4 py-1 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700 focus:border-gray-900 focus:outline-none active:bg-gray-950 disabled:opacity-25">
            {{ __('New') }}
        </button>
        <button @if ($bulkDisabled) disabled="true" @endif wire:click.prevent="deleteSelected"
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-1 text-xs font-semibold uppercase tracking-widest text-white focus:border-gray-900 focus:outline-none disabled:opacity-25">
            {{ __('Delete') }}
        </button>
    </div>


    <!-- Table -->
    <table class="mt-6 border-t-white table min-w-full">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Id') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Category') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Language') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Title') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Editor') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('From') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Till') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
        </tr>
    </thead>

    <!-- Table body -->
    <tbody> 
        @forelse ($posts as $post)
            @if ($post->translations->count() === 0)
                {{-- Do not show post without any translation --}}
            @else
            <tr>
                    @foreach ($post->translations as $translation)
                    <tr class="border-white hover:bg-gray-50">
                        <td class="border-white whitespace-no-wrap px-6 text-sm leading-5">
                            <input type="checkbox" wire:model.live="bulkSelected" value="{{ $translation->id }}">
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{ $post->id }}
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            @if ($post->category->translations->first())
                                {{ $post->category->translations->first()->name }}
                            @endif
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{ $translation->locale }}
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{ $translation->title }}
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            @if ($translation->updated_by_user)
                            <div class="relative block cursor-pointer" onclick="window.location='{{ url('user/' . $translation->updated_by_user->id) }}'">
                                    <img alt="profile"
                                        class="mx-auto h-6 w-6 rounded-full object-cover outline outline-1 outline-offset-0 outline-gray-600"
                                        src="{{ $translation->updated_by_user->profile_photo_path ? Storage::url($translation->updated_by_user->profile_photo_path) : Storage::url(config('timebank-cc.profiles.user.profile_photo_path_default')) }}" />
                            </div>
                            @endif
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            @if ($translation->from)
                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($translation->from))->isoFormat('LL') }}
                            @endif
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            @if ($translation->till)
                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($translation->till))->isoFormat('LL') }}
                            @endif
                        </td>

                        <!-- Row buttons -->
                        <td class="border-white whitespace-no-wrap text-sm leading-5">
                            <a class="mb-2 hidden font-bold text-gray-900 sm:block"
                                href="{{ url($translation->locale . '/post/' . $translation->slug) }}"
                                target="_blank">
                                <x-icon class="h-5 w-5" mini name="arrow-top-right-on-square" />
                            </a>
                        </td>
                        <td class="border-white whitespace-no-wrap py-2.5 text-sm leading-5">
                        {{-- {{dump($translation->from)}} --}}
                                                {{-- {{dump($translation->till > \Carbon\Carbon::now() )}} --}}

                            @if ($translation->from < \Carbon\Carbon::now() && $translation->from !== null)
                                @if ($translation->till > \Carbon\Carbon::now() || $translation->till === null)
                                    <button
                                        class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-red-600 px-2 py-1 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:border-gray-900 focus:outline-none disabled:opacity-25"
                                        wire:click="openStopPublicationModal({{ $translation->id }})">
                                        {{ __('Stop') }}
                                    </button>
                                @endif
                            @endif
                        </td>
                        <td class="border-white whitespace-no-wrap py-2.5 text-sm leading-5">
                            <button
                                class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-gray-900 px-2 py-1 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:border-gray-900 focus:outline-none active:bg-gray-950 disabled:opacity-25"
                                wire:click.prevent="edit({{ $translation->id }})"> {{ __('Edit') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
                <td colspan="11" class=" my-6 py-1 border-b-gray-700"></td>
            @endif
        </tr>
    
        @empty
            <tr>
                <td colspan="11" class="pb-20">
                    {{ __('No results found') }}
                </td>
            </tr>
        @endforelse

    </tbody>
</table>
    

<!-- Pagination -->
<div class="flex justify-between items-center relative mb-4">
    <!-- Left Side: perPage Dropdown -->
    <div class="flex items-center">
        <select class="w-20 rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-700 shadow-sm focus:border-gray-500 focus:outline-none focus:ring focus:ring-gray-500 sm:text-sm"
                wire:model.live="perPage">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
        </select>
        <span class="ml-2 text-gray-500">{{ __('per page') }}</span>
    </div>

    <!-- Right Side: Paginator -->
    @if ($posts)
        {{ $posts->links('livewire.long-paginator') }}
    @endif
</div>


    <!----Stop puplication modal ---->
    <x-jetstream.dialog-modal wire:model.live="modalStopPublication">
        <x-slot name="title">
            {{ __('Stop the publication?') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Do you want to end the publication of this post?') }} <br>
            {{ __('You can edit the post later to publish it again.')}}
        </x-slot>
        <x-slot name="footer">
            <x-jetstream.secondary-button class="ml-3 w-32 justify-center"  wire:click="$toggle('modalStopPublication')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jetstream.secondary-button>
            <x-jetstream.secondary-button  class="ml-3 w-32 justify-center"  wire:click.prevent="stopPublication({{ $selectedTranslationId }})" wire:loading.attr="disabled">
                {{ __('Ok') }}
            </x-jetstream.secondary-button>
        </x-slot>
    </x-jetstream.dialog-modal>




    <!-- Edit modal -->
    <div
        class="@if (!$showModal) hidden @endif fixed bottom-0 left-0 flex h-full w-full items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="h-5/6 w-3/5 overflow-scroll rounded-lg bg-white">
            <form wire:submit="save" class="w-ful">
                <div class="flex flex-col items-start p-4">
                    <div class="flex w-full items-center bg-white pb-4">
                        <div wire:model.live="language" class="text-lg font-medium text-gray-900">
                            @if ($postId)
                                @if ($createTranslation)
                                    {{ __('Add translation') .':' . ' ' . __('messages.' . $language) }}
                                @else
                                    {{ __('Edit post') . ':' . ' ' . __('messages.' . $language) }}
                                @endif
                            @else
                                {{  !$language ? __('Create new post') : __('Create new post') . ':' . ' ' . __('messages.' . $language) }}
                            @endif
                        </div>
                        <svg wire:click="close" class="ml-auto h-6 w-6 cursor-pointer fill-current text-gray-700"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>
                    <div class="required flex space-x-12 py-2">
                        <livewire:category-selectbox key="category-selectbox-{{ $categoryId }}" :categorySelected="$categoryId" />
                        <!-- Use the key to keep track of component that are in a loop -->
                        <livewire:add-translation-selectbox key="add-translation-selectbox-{{$locale}}" :locale="$locale" :options="$localesOptions" />
                        <!-- Use the key to keep track of component that are in a loop -->
                    </div>
                    <div class="w-full py-4">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Title') }}
                            @if ($language)
                            {{ '(' . __($language) . ')' }}
                            @endif
                        </label>
                        <input wire:model.live.debounce.800ms="title"
                            class="mt-2 w-full rounded-lg border border-gray-400 py-2 pl-2 pr-4 text-sm text-xl focus:border-blue-400 focus:outline-none sm:text-base" />
                        @error('title')
                            <p class="mt-2 text-sm text-red-600" id="title-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full py-4">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Slug') }}
                            @if ($language)
                            {{ '(' . __($language) . ')' }}
                            @endif
                        </label>
                        <input wire:model.blur="post.slug"
                            class="mt-2 w-full rounded-lg border border-gray-400 py-2 pl-2 pr-4 text-sm text-xl focus:border-blue-400 focus:outline-none sm:text-base" />
                        @error('post.slug')
                            <p class="mt-2 text-sm text-red-600" id="slug-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full py-4">
                        <x-textarea wire:model="post.excerpt" label="{{ __('Intro') . ' (' . __($language) . ')' }}" placeholder="" />
                        @error('post.excerpt')
                            <p class="mt-2 text-sm text-red-600" id="excerpt-error">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Content --- WYSIWYG editor (Trix editor) -->
                    <label class="form-label mt-4">
                    {{ __('Content') }}
                        @if ($language)
                        {{ '(' . __($language) . ')' }}
                        @endif
                    </label>
                    <livewire:trix-editor :value="$post['content']" />
                    @error('content')
                        <p class="mt-2 text-sm text-red-600" id="locale-error">{{ $message }}</p>
                    @enderror

                    <div class="w-full py-2">


                        <!-- Image upload -->
                        <div class="w-1/2">
                            <label class="form-label mt-6">{{ __('Image') }}</label>

                            @if ($image === null)
                                <img src="{{ $media }}"
                                    class="mb-2 h-48 w-64 rounded-md border border-gray-600 object-cover">
                            @else
                                <!-- Preview image -->
                                {{-- Make sure that that object cover class w and h is 4 by 3 proportion as images will later be cropped in 4 by 3 proportions --}}
                                <img src="{{ $image->temporaryUrl() }}"
                                    class="mb-2 h-48 w-64 rounded-md border border-gray-600 object-cover">
                            @endif
                            <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false; progress = 5"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <!-- File Input -->
                                <input type="file" wire:model.live="image">
                                <!-- Progress Bar -->
                                <div x-show.transition="isUploading"
                                    class="flex-start my-6 flex h-4 w-64 overflow-hidden rounded bg-gray-100 font-sans text-xs font-medium">
                                    <progress max="100" x-bind:value="progress"
                                        class="flex h-full items-baseline justify-center overflow-hidden break-all text-white"
                                        x-bind:style="`width:${progress}%`"></progress>
                                </div>
                            </div>
                            @error('image')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Event details -->
                        @if ($meetingShow)
                            <!-- Event date pickers: from and till -->
                            <div class="flex space-x-12">
                                <div class="my-6 flex-auto">
                                    <x-datetime-picker label="{{ __('Start of the event') }}"
                                        placeholder="{{ __('Select a date and time') }}" wire:model.live="meetingFrom"
                                        time-format="24" display-format="DD-MM-YYYY @ H:mm"
                                        parse-format="YYYY-MM-DD HH:mm" />
                                </div>
                                <div class="my-6 flex-auto">
                                    <x-datetime-picker label="{{ __('End of the event') }}"
                                        placeholder="{{ __('Select a date and time') }}" wire:model.live="meetingTill"
                                        time-format="24" display-format="DD-MM-YYYY @ H:mm"
                                        parse-format="YYYY-MM-DD HH:mm" />
                                </div>
                            </div>

                            <div class="my-6 flex-auto">
                                <label class="block text-sm font-medium text-gray-700">
                                    {{ __('Event address') }}
                                </label>
                                <input wire:model="meetingAddress"
                                    class="mt-2 w-full rounded-lg border border-gray-400 py-2 pl-2 pr-4 text-sm text-xl focus:border-blue-400 focus:outline-none sm:text-base" />
                                @error('meetingAddress')
                                    <p class="mt-2 text-sm text-red-600" id="meeting-address-error">{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="my-6 w-1/3 flex-auto">

                                <!--- Eevent organizer --->
                                <livewire:posts.select-organizer>

                            </div>
                        @endif

                        <!-- Publication from and till -->
                        <div class="flex space-x-12">
                            <div class="my-6 flex-auto">
                            @php 
                                if ($language) {
                                    $labelStart = __('Start of publication') . ' (' . __($language) . ')';
                                    $labelEnd = __('End of publication') . ' (' . __($language) . ')';
                                } else {
                                    $labelStart = __('Start of publication');
                                    $labelEnd = __('End of publication');
                                }
                            @endphp
                                <x-datetime-picker label="{{ $labelStart }}"
                                    placeholder="{{ __('Select a date') }}" wire:model.live="from" time-format="24"
                                    display-format="DD-MM-YYYY @ H:mm" parse-format="YYYY-MM-DD HH:mm" />
                            </div>
                            <div class="my-6 flex-auto">
                                <x-datetime-picker label="{{ $labelEnd }}"
                                    placeholder="{{ __('Select a date') }}" wire:model.live="till" time-format="24"
                                    display-format="DD-MM-YYYY @ H:mm" parse-format="YYYY-MM-DD HH:mm" />
                            </div>
                        </div>

                        <!-- Publication warning -->
                        @if ($from < \Carbon\Carbon::now() && $from !== null)
                            @if ($till > \Carbon\Carbon::now() || $till === null)
                                <div class="mb-3 text-right text-red-600">
                                    {{ __('Warning: post will be published immediately!') }}
                                </div>
                            @endif
                        @else
                            <div class="mb-3 text-right">
                            </div>
                        @endif

                        <!-- List of validation errors -->
                        <x-errors />

                        <div class="ml-auto mt-6 flex space-x-4">
                            @if ($createTranslation === true)
                                <button class="rounded bg-gray-900 px-4 py-2 font-bold text-white hover:bg-gray-700"
                                    type="submit">{{ $postId ? __('Add Translation') : __('Save') }}
                                </button>
                            @else
                                <button class="rounded bg-gray-900 px-4 py-2 font-bold text-white hover:bg-gray-700"
                                    type="submit">{{ $postId ? __('Update') : __('Save') }}
                                </button>
                            @endif
                            <button class="rounded bg-gray-500 px-4 py-2 font-bold text-white hover:bg-gray-600"
                                wire:click="close" type="button" data-dismiss="modal">{{ __('Cancel') }}
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
