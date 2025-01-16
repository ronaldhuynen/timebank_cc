<div class="mt-12">


    <!-- Search box -->
    <div class="flex items-center mb-4">
        <!-- Input and Reset Button Container -->
        <div class="relative w-1/3">
            <input type="text" wire:model="search" placeholder="{{__('Search keywords') . '...'}}"
            wire:keydown.enter="handleSearchEnter"
                class="w-full rounded-md border border-gray-300 px-3 py-1 text-gray-700 shadow-sm focus:border-gray-500 focus:outline-none focus:ring focus:ring-gray-500 sm:text-sm pr-10">
            
            <!-- Reset Button -->
            @if($search)
                <button wire:click.prevent="resetSearch"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-600 focus:outline-none">
                    <x-icon name="backspace" mini solid />
                </button>
            @endif
        </div>
        
        <!-- Search Button -->
        <button wire:click.prevent="searchTags"
            class="ml-4 focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-gray-900 px-4 py-1 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700 focus:border-gray-900 focus:outline-none active:bg-gray-950 disabled:opacity-25">
            {{ __('Search') }}
        </button>
    </div>

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
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Language') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Tag') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Example') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Category') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Editor') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Updated') }}</th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
        </tr>
    </thead>

    <!-- Table body -->
    <tbody> 
        @forelse ($tags as $tag)
            @if (!$tag)
                {{-- Do not show tag without any locale --}}
            @else
            <tr>
                @php
                    // If $tag->locales exists and is not empty, use it;
                    // otherwise, fallback to an array containing $tag->locale
                    $taggableTags = !empty($tag->locales) ? $tag->locales : [$tag->locale];
                @endphp

                {{-- TODO NEXT: Check Test Neun? En of alles correct gewist wordt! --}}

                @foreach ($taggableTags as $taggable_tag)
                    <tr class="border-white hover:bg-gray-50">
                        <td class="border-white whitespace-no-wrap px-6 text-sm leading-5">
                            <input type="checkbox" wire:model.live="bulkSelected" value="{{ $taggable_tag->id }}">
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{ $taggable_tag->locale }}
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{ $taggable_tag->name }}
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{ $taggable_tag->example }}
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            @if ($tag->categories)
                                {{ \App\Models\Category::find($tag->categories[0]['id'])->translation->name }}
                            @else
                                {{ __('Untitled category')}}
                            @endif
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            @if ($taggable_tag->updated_by_user)
                            <div class="relative block cursor-pointer" onclick="window.location='{{ route('user.show', ['id' => $taggable_tag->updated_by_user]) }}'">
                                    <img alt="profile"
                                        class="mx-auto h-6 w-6 rounded-full object-cover outline outline-1 outline-offset-0 outline-gray-600"
                                        src="{{ \App\Models\User::find($taggable_tag->updated_by_user)->profile_photo_path ? Storage::url(\App\Models\User::find($taggable_tag->updated_by_user)->profile_photo_path) : Storage::url(config('timebank-cc.profiles.user.profile_photo_path_default')) }}" />
                            </div>
                            @endif
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            @if ($taggable_tag->updated_at)
                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($taggable_tag->updated_at))->diffForHumans()  }}
                            @endif
                        </td>

                        <!-- Row buttons -->

                        <td class="border-white whitespace-no-wrap py-2.5 text-sm leading-5">
                            <button
                                class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-red-600 px-2 py-1 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:border-gray-900 focus:outline-none disabled:opacity-25"
                                wire:click="openDeleteTagModal({{ $taggable_tag->id }})">
                                {{ __('Delete') }}
                            </button>
                        </td>
                        <td class="border-white whitespace-no-wrap py-2.5 text-sm leading-5">
                            <button
                                class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-gray-900 px-2 py-1 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:border-gray-900 focus:outline-none active:bg-gray-950 disabled:opacity-25"
                                wire:click="edit({{ $taggable_tag->id }})"> {{ __('Edit') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
                <td colspan="12" class=" my-6 py-1 border-b-gray-700"></td>
            @endif
        </tr>
    
        @empty
            <tr>
                <td colspan="12" class="pb-20">
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
    @if ($tags)
        {{ $tags->links('livewire.long-paginator') }}
    @endif
</div>


    <!----Delete modal ---->
    @if ($selectedDeleteTag)
    <x-jetstream.dialog-modal wire:model.live="modalDeleteTag">
        <x-slot name="title">
            {{ __('Please confirm') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Do you want to permanently delete this tag?') . ':' }}
            <div class='my-3 text-xl'>
            {{ $selectedDeleteTag->name }} <br>
            </div>
            <div class="flex flex-col space-y-2 mb-2">
                <div class="flex">
                    <div class="w-1/3">{{ __('Example') }}:</div>
                    <div class="flex-1">{{ $selectedDeleteTag->locale->example }}</div>
                </div>
                <div class="flex">
                    <div class="w-1/3">{{ __('Category') }}:</div>
                    <div class="flex-1">{{ \App\Models\Category::find($selectedDeleteTag->categories[0]['id'])->translation->name }}</div>
                </div>
                <div class="flex">
                @php
                    $lang = \DB::table('languages')
                        ->where('lang_code', $selectedDeleteTag->locale->locale)
                        ->value('name');
                @endphp
                    <div class="w-1/3">{{ __('Language') }}:</div>
                    <div class="flex-1">{{ trans('messages.' . $lang) }}</div>
                </div>
                <div class="flex">
                    <div class="w-1/3">{{ __('Andere talen aanwezig') }}:</div>
                    <div class="flex-1">
                @foreach ($selectedDeleteTag->translations() as $translation)
                    @if ($translation->locale != $selectedDeleteTag->locale->locale)
                        {{ trans('messages.' . \DB::table('languages')->where('lang_code', $translation->locale)->value('name')) }}: {{ $translation->name }}<br>
                    @endif
               @endforeach
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/3">{{ __('In use by number of profiles') }}:</div>
                    <div class="flex-1">{{ $countTotal }}</div>
                </div>
            </div>
            @if ($countTotal > 0)
                <div class="text-red-500">
                    {{ __('Deleting this tag, will remove this tag from all profiles.')}}
                </div>
            @endif
            {{ __('This can not be undone!')}}
        </x-slot>
        <x-slot name="footer">
            <x-jetstream.secondary-button class="ml-3 w-32 justify-center"  wire:click="resetForm"  wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jetstream.secondary-button>
            <x-jetstream.secondary-button  class="ml-3 w-32 justify-center"  wire:click.prevent="deleteTag({{ $selectedDeleteTagId }})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jetstream.secondary-button>
        </x-slot>
    </x-jetstream.dialog-modal>
    @endif




    <!-- Edit modal -->

</div>
