<div class="mt-12">

    <!-- Search box -->
    <div class="mb-4 flex items-center">
        <!-- Input and Reset Button Container -->
        <div class="relative w-1/3">
            <input class="w-full rounded-md border border-gray-300 px-3 py-1 pr-10 text-gray-700 shadow-sm focus:border-gray-500 focus:outline-none focus:ring focus:ring-gray-500 sm:text-sm"
                   placeholder="{{ __('Search keywords') . '...' }}" type="text" wire:keydown.enter="handleSearchEnter"
                   wire:model="search">

            <!-- Reset Button -->
            @if ($search)
                <button class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-600 focus:outline-none"
                        wire:click.prevent="resetSearch">
                    <x-icon mini name="backspace" solid />
                </button>
            @endif
        </div>

        <!-- Search Button -->
        <button class="focus:shadow-outline-gray ml-4 inline-flex items-center rounded-md border border-transparent bg-gray-900 px-4 py-1 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700 focus:border-gray-900 focus:outline-none active:bg-gray-950 disabled:opacity-25"
                wire:click.prevent="searchTags">
            {{ __('Search') }}
        </button>
    </div>

    <!-- Action buttons -->
    <div class="ml-auto mt-6 flex space-x-4">
        <button class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-gray-900 px-4 py-1 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700 focus:border-gray-900 focus:outline-none active:bg-gray-950 disabled:opacity-25"
                wire:click.prevent="create">
            {{ __('New') }}
        </button>
        <button @if ($bulkDisabled) disabled="true" @endif
                class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-1 text-xs font-semibold uppercase tracking-widest text-white focus:border-gray-900 focus:outline-none disabled:opacity-25"
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                wire:click.prevent="deleteSelected">
            {{ __('Delete') }}
        </button>
    </div>

    <!-- Table -->
    <table class="mt-6 table min-w-full border-t-white">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider"></th>
                <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Id') }}</th>
                <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Language') }}</th>
                <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Tag') }}</th>
                <th class="px-6 py-3 text-left text-sm leading-4 tracking-wider">{{ __('Comment') }}</th>
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
                    <tr class="border-white hover:bg-gray-50">
                        <td class="whitespace-no-wrap border-white px-6 text-sm leading-5">
                            <input type="checkbox" value="{{ $taggable_tag->tag_id }}" wire:model.live="bulkSelected">
                        </td>
                        <td class="whitespace-no-wrap mt-3 border-white px-6 text-sm leading-5">
                            {{ $taggable_tag->tag_id }}
                        </td>
                        <td class="whitespace-no-wrap mt-3 border-white px-6 text-sm leading-5">
                            {{ $taggable_tag->locale->locale }}
                        </td>
                        <td class="whitespace-no-wrap mt-3 border-white px-6 text-sm leading-5">
                            @php
                                $categoryColor =
                                    (new \App\Models\Tag())->translateTagIdWithContext($taggable_tag->tag_id)[
                                        'category_color'
                                    ] ?? 'gray';
                                $categoryPath =
                                    (new \App\Models\Tag())->translateTagIdWithContext($taggable_tag->tag_id)[
                                        'category_path'
                                    ] ?? '';
                            @endphp
                            <span
                                  class="bg-{{ $categoryColor }}-300 inline-flex items-center rounded-md px-2 py-1 text-sm font-normal">
                                {{ $taggable_tag->name }}
                            </span>
                        </td>
                        <td class="whitespace-no-wrap mt-3 border-white px-6 text-sm leading-5">
                            {{ $taggable_tag->locale->comment }}
                        </td>
                        <td class="whitespace-no-wrap mt-3 border-white px-6 text-sm leading-5">
                            {{ $categoryPath }}
                        </td>
                        <td class="whitespace-no-wrap mt-3 border-white px-6 text-sm leading-5">
                            @if ($taggable_tag->locale->updated_by_user)
                                <div class="relative block cursor-pointer"
                                     onclick="window.location='{{ route('user.show', ['id' => $taggable_tag->locale->updated_by_user]) }}'">
                                    <img alt="profile"
                                         class="mx-auto h-6 w-6 rounded-full object-cover outline outline-1 outline-offset-0 outline-gray-600"
                                         src="{{ \App\Models\User::find($taggable_tag->locale->updated_by_user)->profile_photo_path ? Storage::url(\App\Models\User::find($taggable_tag->locale->updated_by_user)->profile_photo_path) : Storage::url(config('timebank-cc.profiles.user.profile_photo_path_default')) }}" />
                                </div>
                            @endif
                        </td>
                        <td class="whitespace-no-wrap mt-3 border-white px-6 text-sm leading-5">
                            @if ($taggable_tag->locale->updated_at)
                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($taggable_tag->locale->updated_at))->diffForHumans() }}
                            @endif
                        </td>

                        <!-- Row buttons -->
                        <td class="whitespace-no-wrap border-white py-2.5 text-sm leading-5">
                            <button class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-red-600 px-2 py-1 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:border-gray-900 focus:outline-none disabled:opacity-25"
                                    wire:click="openDeleteTagModal({{ $taggable_tag->tag_id }})">
                                {{ __('Delete') }}
                            </button>
                        </td>
                        <td class="whitespace-no-wrap border-white py-2.5 text-sm leading-5">
                            <button class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-gray-900 px-2 py-1 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:border-gray-900 focus:outline-none active:bg-gray-950 disabled:opacity-25"
                                    wire:click="openEditTagModal({{ $taggable_tag->tag_id }})">
                                {{ __('Edit') }}
                            </button>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td class="pb-20" colspan="12">
                        {{ __('No results found') }}
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
    <!-- Pagination -->
    <div class="relative mb-4 flex items-center justify-between">
        <!-- Left Side: perPage Dropdown -->
        <div class="flex items-center">
            <select class="w-20 rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-700 shadow-sm focus:border-gray-500 focus:outline-none focus:ring focus:ring-gray-500 sm:text-sm"
                    wire:model.live="perPage">
                <option value="10"> 10 </option>
                <option value="20"> 20 </option>
                <option value="50"> 50 </option>
            </select>
            <span class="ml-2 text-gray-500">{{ __('tags') }} {{ __('per page') }}</span>
        </div>

        <!-- Right Side: Paginator -->
        @if ($tags)
            {{-- {{ $tags->links('livewire.long-paginator') }} --}}
            {{-- {{ $tags->onEachSide(1)->links() }} --}}

            <div wire:key="paginator-{{ $tags->currentPage() }}-{{ $tags->total() }}">
                {{ $tags->links('livewire.long-paginator') }}
            </div>
        @endif

    </div>

    <!----Delete modal ---->
    @if ($selectedTag)
        <x-jetstream.dialog-modal wire:model.live="modalDeleteTag">
            <x-slot name="title">
                {{ __('Are you sure?') }}
            </x-slot>

            @php
                $categoryColor =
                    (new \App\Models\Tag())->translateTagIdWithContext($selectedTag->tag_id)['category_color'] ??
                    'gray';
                $categoryPath =
                    (new \App\Models\Tag())->translateTagIdWithContext($selectedTag->tag_id)['category_path'] ?? '';
            @endphp

            <x-slot name="content">
                {{ __('Do you want to permanently delete this tag?') }}
                <div class='my-3 text-xl'>
                    <span
                          class="bg-{{ $categoryColor }}-300 inline-flex items-center rounded-md px-3 py-2 text-sm font-normal">
                        {{ $selectedTag->name }}
                    </span>
                </div>
                <div class="mb-2 flex flex-col space-y-2">
                    <div class="flex">
                        <div class="w-1/3">{{ __('Comment') }}:</div>
                        <div class="flex-1">{{ $selectedTag->locale->comment }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-1/3">{{ __('Category') }}:</div>
                        <div class="flex-1">
                            <span class="bg-{{ $categoryColor }}-300 mr-2 inline-block h-3 w-3 rounded-full"></span>
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
                        <div class="w-1/3">{{ __('Other languages present') }}:</div>
                        <div class="flex-1">
                            @foreach ($selectedTag->translations() as $translation)
                                @if ($translation->locale != $selectedTag->locale->locale)
                                    {{ trans('messages.' . \DB::table('languages')->where('lang_code', $translation->locale)->value('name')) }}:
                                    {{ $translation->name }}<br>
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
                        {{ __('Profiles affected') }}: {{ $countTotal }}
                    </div>
                @endif
                {{ __('This can not be undone') }}!
            </x-slot>
            <x-slot name="footer">
                <x-jetstream.secondary-button class="ml-3 w-32 justify-center" wire:click="resetForm"
                                              wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jetstream.secondary-button>
                <x-jetstream.danger-button class="ml-3 w-32 justify-center"
                                           wire:click.prevent="deleteTag({{ $selectedTagId }})"
                                           wire:loading.attr="disabled">
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
                $categoryColor =
                    (new \App\Models\Tag())->translateTagIdWithContext($selectedTag->tag_id)['category_color'] ??
                    'gray';
                $categoryPath =
                    (new \App\Models\Tag())->translateTagIdWithContext($selectedTag->tag_id)['category_path'] ?? '';
            @endphp

            <x-slot name="content">
                {{ __('Always make sure that the exact meaning of a tag never changes!') }}
                <div class='my-3 text-xl'>
                    <span
                          class="bg-{{ $categoryColor }}-300 inline-flex items-center rounded-md px-3 py-2 text-sm font-normal">
                        {{ $selectedTag->name }}
                    </span>
                </div>
                <div class="mb-2 flex flex-col space-y-2">
                    <div class="flex">
                        <div class="w-1/3">{{ __('Name') }}:</div>
                        <div class="flex-1">
                            <input class="w-full rounded-md border border-gray-300 px-3 py-1 pr-10 text-gray-700 shadow-sm focus:border-gray-500 focus:outline-none focus:ring focus:ring-gray-500 sm:text-sm"
                                   type="text" wire:model.lazy="editTag.name">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-1/3">{{ __('Comment') }}:</div>
                        <div class="flex-1">
                            <textarea class="w-full rounded-md border border-gray-300 px-3 py-1 pr-10 text-gray-700 shadow-sm focus:border-gray-500 focus:outline-none focus:ring focus:ring-gray-500 sm:text-sm"
                                      rows="3" wire:model.lazy="editTag.comment">
                        </textarea>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-1/3">{{ __('Category') }}:</div>
                        <div class="flex-1">
                            <x-select :options="$categoryOptions" class="placeholder-gray-300" id="category"
                                      option-label="name" option-value="category_id"
                                      placeholder="{{ __('Select a category') }}"
                                      wire:model.live="editTag.category" />
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
                                    {{ trans('messages.' . \DB::table('languages')->where('lang_code', $translation->locale)->value('name')) }}:
                                    {{ $translation->name }}<br>
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
                        {{ __('Profiles affected') }}: {{ $countTotalContext }}
                    </div>
                @elseif ($editTagChanged && $countTotal > 0)
                    <div class="text-red-500">
                        {{ __('Profiles affected') }}: {{ $countTotal }}
                    </div>
                @endif
                {{ __('This can not be undone') }}!
            </x-slot>
            <x-slot name="footer">
                <x-jetstream.secondary-button class="ml-3 w-32 justify-center" wire:click="resetForm"
                                              wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jetstream.secondary-button>
                <x-jetstream.danger-button class="ml-3 w-32 justify-center"
                                           wire:click.prevent="updateTag({{ $selectedTagId }})"
                                           wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jetstream.danger-button>
            </x-slot>
        </x-jetstream.dialog-modal>
    @endif

</div>
