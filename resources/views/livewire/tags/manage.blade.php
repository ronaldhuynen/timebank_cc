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
            <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Id') }}</th>
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
    {{-- {{dd($tags)}} --}}
        @forelse ($tags as $taggable_tag)
            @if (!$taggable_tag)
                {{-- Do not show tag without any locale --}}
            @else
            <tr>
                    <tr class="border-white hover:bg-gray-50">
                        <td class="border-white whitespace-no-wrap px-6 text-sm leading-5">
                            <input type="checkbox" wire:model.live="bulkSelected" value="{{ $taggable_tag->tag_id }}">
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{ $taggable_tag->tag_id }}
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{ $taggable_tag->locale }}
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            @php
                                $categoryColor = (new \App\Models\Tag)->translateTagIdWithContext($taggable_tag->tag_id)['category_color'] ?? 'gray';
                                $categoryPath = (new \App\Models\Tag)->translateTagIdWithContext($taggable_tag->tag_id)['category_path'] ?? '';
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-sm font-normal bg-{{$categoryColor}}-300">
                                {{ $taggable_tag->name }}
                            </span>
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{ $taggable_tag->example }}
                        </td>
                        <td class="border-white whitespace-no-wrap px-6 mt-3 text-sm leading-5">
                            {{$categoryPath}}
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
                                wire:click="openDeleteTagModal({{ $taggable_tag->tag_id }})">
                                {{ __('Delete') }}
                            </button>
                        </td>
                        <td class="border-white whitespace-no-wrap py-2.5 text-sm leading-5">
                            <button
                                class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-gray-900 px-2 py-1 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:border-gray-900 focus:outline-none active:bg-gray-950 disabled:opacity-25"
                                wire:click="openEditTagModal({{ $taggable_tag->tag_id }})"> 
                                {{ __('Edit') }}
                            </button>
                        </td>
                    </tr>
                {{-- @endforeach --}}
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
                <option value="10">5</option>
                <option value="20">10</option>
                <option value="50">30</option>
            </select>
            <span class="ml-2 text-gray-500">{{ __('tag sets') }} {{__('per page') }}</span>
        </div>

        <!-- Right Side: Paginator -->
        @if ($tags)
            {{ $tags->links('livewire.long-paginator') }}
        @endif
    </div>


    <!----Delete modal ---->
    @if ($selectedTag)
    <x-jetstream.dialog-modal wire:model.live="modalDeleteTag">
        <x-slot name="title">
            {{ __('Are you sure?') }}
        </x-slot>

        @php
            $categoryColor = (new \App\Models\Tag)->translateTagIdWithContext($selectedTag->tag_id)['category_color'] ?? 'gray';
            $categoryPath = (new \App\Models\Tag)->translateTagIdWithContext($selectedTag->tag_id)['category_path'] ?? '';
        @endphp

        <x-slot name="content">
            {{ __('Do you want to permanently delete this tag?') }}
            <div class='my-3 text-xl'>
            <span class="inline-flex items-center px-3 py-2 rounded-md text-sm font-normal bg-{{$categoryColor}}-300 ">
                {{ $selectedTag->name }}
            </span>
            </div>
            <div class="flex flex-col space-y-2 mb-2">
                <div class="flex">
                    <div class="w-1/3">{{ __('Example') }}:</div>
                    <div class="flex-1">{{ $selectedTag->locale->example }}</div>
                </div>
                <div class="flex">
                    <div class="w-1/3">{{ __('Category') }}:</div>
                    <div class="flex-1">
                        <span class="inline-block w-3 h-3 rounded-full bg-{{$categoryColor}}-300 mr-2"></span>
                        <span class="">
                            {{ $categoryPath }}
                        </span>
                   </div>
                </div>
                <div class="flex">
                @php
                    $lang = \DB::table('languages')
                        ->where('lang_code', $selectedTag->locale->locale)
                        ->value('name');
                @endphp
                    <div class="w-1/3">{{ __('Language') }}:</div>
                    <div class="flex-1">{{ trans('messages.' . $lang) }}</div>
                </div>
                <div class="flex">
                    <div class="w-1/3">{{ __('Andere talen aanwezig') }}:</div>
                    <div class="flex-1">
                @foreach ($selectedTag->translations() as $translation)
                    @if ($translation->locale != $selectedTag->locale->locale)
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
            <x-jetstream.danger-button  class="ml-3 w-32 justify-center"  wire:click.prevent="deleteTag({{ $selectedTagId }})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jetstream.danger-button>
        </x-slot>
    </x-jetstream.dialog-modal>
    @endif




    <!-- Edit modal -->
    @if ($selectedTag)
    <x-jetstream.dialog-modal wire:model.live="modalEditTag">
        <x-slot name="title">
            {{ __('Edit tag') }}
        </x-slot>

        @php
            $categoryColor = (new \App\Models\Tag)->translateTagIdWithContext($selectedTag->tag_id)['category_color'] ?? 'gray';
            $categoryPath = (new \App\Models\Tag)->translateTagIdWithContext($selectedTag->tag_id)['category_path'] ?? '';
        @endphp

        <x-slot name="content">
            {{ __('Always make sure that the exact meaning of a tag never changes!') }}
            <div class='my-3 text-xl'>
            <span class="inline-flex items-center px-3 py-2 rounded-md text-sm font-normal bg-{{$categoryColor}}-300 ">
                {{ $selectedTag->name }}
            </span>
            </div>
            <div class="flex flex-col space-y-2 mb-2">
                <div class="flex">
                    <div class="w-1/3">{{ __('Name') }}:</div>
                    <div class="flex-1">
                        <input type="text" 
                        class="w-full rounded-md border border-gray-300 px-3 py-1 text-gray-700 shadow-sm focus:border-gray-500 focus:outline-none focus:ring focus:ring-gray-500 sm:text-sm pr-10"
                        wire:model.lazy="editTag.name">
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/3">{{ __('Example') }}:</div>
                    <div class="flex-1">
                        <textarea
                            rows="3"
                            class="w-full rounded-md border border-gray-300 px-3 py-1 text-gray-700 shadow-sm focus:border-gray-500 focus:outline-none focus:ring focus:ring-gray-500 sm:text-sm pr-10"
                            wire:model.lazy="editTag.example">
                        </textarea>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/3">{{ __('Category') }}:</div>
                    <div class="flex-1">
                        <x-select :options="$categoryOptions" class="placeholder-gray-300" id="category"
                                    option-label="name" option-value="category_id"
                                    placeholder="{{ __('Select a category') }}" wire:model.live="editTag.category" />
                    </div>
                </div>
                <div class="flex">
                @php
                    $lang = \DB::table('languages')
                        ->where('lang_code', $selectedTag->locale->locale)
                        ->value('name');
                @endphp
                    <div class="w-1/3">{{ __('Language') }}:</div>
                    <div class="flex-1">{{ trans('messages.' . $lang) }}</div>
                </div>
                <div class="flex">
                    <div class="w-1/3">{{ __('Andere talen aanwezig') }}:</div>
                    <div class="flex-1">
                @foreach ($selectedTag->translations() as $translation)
                    @if ($translation->locale != $selectedTag->locale->locale)
                        {{ trans('messages.' . \DB::table('languages')->where('lang_code', $translation->locale)->value('name')) }}: {{ $translation->name }}<br>
                    @endif
                @endforeach
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/3">{{ __('Tag in use by number of profiles') }}:</div>
                    <div class="flex-1">{{ $countTotal }}</div>
                </div>
                <div class="flex">
                    <div class="w-1/3">{{ __('Tag and translations in use by number of profiles') }}:</div>
                    <div class="flex-1">{{ $countTotalContext }}</div>
                </div>
            </div>
            @if ($editTagContextChanged && $countTotalContext > 0)
                <div class="text-red-500">
                    {{ __('Profiles affected')}}: {{$countTotalContext}}
                </div>
            @elseif ($editTagChanged && $countTotal > 0)
                <div class="text-red-500">
                    {{ __('Profiles affected')}}: {{$countTotal}}
                </div>
            @endif
            {{ __('This can not be undone.')}}
        </x-slot>
        <x-slot name="footer">
            <x-jetstream.secondary-button class="ml-3 w-32 justify-center"  wire:click="resetForm"  wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jetstream.secondary-button>
            <x-jetstream.danger-button  class="ml-3 w-32 justify-center"  wire:click.prevent="updateTag({{ $selectedTagId }})" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jetstream.danger-button>
        </x-slot>
    </x-jetstream.dialog-modal>
    @endif

</div>
