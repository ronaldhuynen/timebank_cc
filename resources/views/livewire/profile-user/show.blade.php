 <div class="py-12">
     <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

         <section>

             <div class="relative rounded-lg border-gray-600 bg-black border-1 px-12 py-16 shadow-xl dark:border-gray-700">

                 <div class="mt-3 flex justify-between">
                     @if ($isOnline)
                     <img class="h-60 w-60 flex-shrink-0 rounded-full object-cover ring-4 ring-green-400 sm:mx-4" src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}">
                     @elseif ($isAway)
                     <img class="h-60 w-60 flex-shrink-0 rounded-full object-cover ring-4 ring-sky-400 sm:mx-4" src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}">
                     @else
                     <img class="h-60 w-60 flex-shrink-0 rounded-full object-cover ring-4 ring-gray-300 sm:mx-4" src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}">
                     @endif
                     <div class="pl-4 sm:mx-4 sm:mt-0">

                         <div class="flex justify-between">
                             <h1 class="text-4xl font-extrabold text-gray-100 group-hover:text-white dark:text-white ">
                                 {{ $user->name }}
                             </h1>
                             <!--- Online status -->
                             @if ($isOnline)
                             <span class="flex justify-between">
                                 <span class="rounded bg-black border-green-400 border-2 px-3 py-1 mt-2 mr-2 h-7 font-extrabold text-green-300 text-2xs">{{ __('Online') }}</span>
                                 @elseif ($isAway)
                                 <span class="flex justify-between">
                                     <span class="rounded bg-black border-sky-400 border-2 px-3 py-1 mt-2 mr-2 h-7 font-extrabold text-sky-300 text-2xs">{{ __('Online') }}</span>
                                     @endif

                                     <!--- Like button -->
                                     @livewire('like-button', ['model' => $user, 'likedCounter' => $user->likedCounter, 'typeName' => 'Star'])

                                 </span>

                         </div>

                         <h3 class="mt-2 text-2xl text-gray-300 group-hover:text-gray-100 dark:text-gray-300">
                             {{ $user->motivation }}</h3>

                         <div class="mt-4 grid grid-cols-3 gap-1 text-gray-400 dark:text-gray-200 md:grid-cols-3 xl:grid-cols-3">

                             <div class="">
                                 <a class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500" href="{{ $location['link'] }}">
                                     <svg aria-label="location pin icon" class="h-8 w-8 fill-current pr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                     </svg>
                                     {{ $location['name'] }}
                                 </a>
                             </div>

                             @if ($friend && $phone)
                             <div class="">
                                 <a class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500" href="#">
                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 pr-2">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                     </svg>
                                     {{ $phone }}
                                 </a>
                             </div>
                             @endif

                             <!-- Friend request buttons only visible if the active profile is not the model -->
                             @if (session('activeProfileType') === $user::class && session('activeProfileId') !== $user->id || session('activeProfileType') !== $this->user::class)

                             <div class="">
                                 @if (count($friend) < 1 && count($pendingFriend) < 1) <!-- Not a friend -->
                                     <a wire:click="friendRequest" class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500" onclick="FriendsManager.action({dropdown : true, provider_id : '{{$user->id}}', action : 'add', provider_alias : 'user'}); 
                                            return false;" href="#"><i class="fas fa-user-plus"></i><br />
                                         {{ __('Friend request') }}</a>
                                     @elseif (count($pendingFriend) > 0 )
                                     <!-- Pending friend -->
                                     <a wire:click="cancelFriendRequest" class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500" onclick="FriendsManager.action({dropdown : true, provider_id : '{{$user->id}}', action : 'cancel', sent_friend_id : '{{ $pendingFriend->first()->id }}', provider_alias : 'user'}); return false;" href="#"><i class="fas fa-ban"></i>
                                         <br />
                                         {{ __('Cancel friend request') }}</a>
                                     @else
                                     <!-- Is a friend -->
                                     <a wire:click="cancelFriendRequest" class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500" onclick="FriendsManager.action({dropdown : true, provider_id : '{{$user->id}}', action : 'remove', friend_id : '{{ $friend->first()->id }}', provider_alias : 'user'}); return false;" href="#"><i class="fas fa-user-times"></i>
                                         <br />
                                         {{ __('Remove as Friend') }}</a>
                                     @endif
                             </div>

                             @endif


                         </div>
                     </div>
                 </div>

                 <!-- About -->
                 <!-- Note that we need Alpine to show/hide the full text as Livewire 2 loses track of trans() keys in subsequent request. These are uses to translate the $languages properties  -->

                 @if ($user->about && strlen($user->about) > 300 )
                 <div x-data="{ showAboutFullText: false }">
                     <p class="mt-4 text-gray-300 group-hover:text-gray-100 dark:text-gray-300">
                         <span x-show="!showAboutFullText">
                             {{ Illuminate\Support\Str::limit($user->about ?? '', 300) }}
                         </span>
                         <span x-show="showAboutFullText">
                             {{ $user->about ?? '' }}
                         </span>
                         <a href="#" @click.prevent="showAboutFullText = !showAboutFullText" class="text-sm text-gray-300 underline transition-colors duration-100 hover:text-gray-100 hover:underline dark:text-gray-400 dark:hover:text-gray-100">

                             <span x-show="!showAboutFullText" class="underline inline-flex items-center">{{__('Read more')}}...
                                 <svg class="mx-1 h-4 w-4 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                 </svg>
                             </span>

                             <span x-show="showAboutFullText" class="underline inline-flex items-center">
                                 <svg class="mx-1 h-4 w-4 transform scale-x-[-1]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                 </svg>
                                 {{__('Show less')}}...
                             </span>
                         </a>
                     </p>
                 </div>
                 @else
                 <div>
                     <p class="mt-4 text-gray-300 group-hover:text-gray-100 dark:text-gray-300">

                         {{ $user->about ?? '' }}
                     </p>
                 </div>
                 @endif


                 <!--- Languages -->
                 <div class="mt-6 flex items-center text-gray-400 dark:text-gray-200">
                     @foreach($user->languages as $language)
                     <p class="pr-2">{{ $language['flag'] }}</p>
                     <p class="pr-2">{{ trans($language['name']) }}, {{ trans($language->competence_name) }}</p>
                     @if (!$loop->last)
                     <p class="pr-2">|</p>
                     @endif
                     @endforeach
                 </div>
                 @if($user->lang_preference)
                 <div class="-mt-4 flex items-center text-gray-400 dark:text-gray-200">
                     {{ trans($user->lang_preference) }} {{ __('is preferred') }}
                 </div>
                 @endif

                 <!--- Skills -->
                 <div class="mt-2 flex-wrap gap-2 sm:flex">
                     @foreach($skills->sortBy('category_color') as $skill)
                     <span class="flex-shrink-0 rounded bg-{{ $skill['category_color'] . '-300' }} px-2 py-1 text-gray-900 lg:block" title="{{ $skill['category_path'] }}" style="cursor: default;">{{ $skill['name'] }}</span>
                     @endforeach
                 </div>
                 <div class="mt-6 flex items-center text-xl text-gray-300 group-hover:text-gray-100 dark:text-gray-300">
                     <p class="mr-12">{{ tbFormat($accountsTotals['sumBalances']) }} {{ __('available') }}</p>
                     @if ($accountsTotals['transfersReceived'] === 1)
                     <p class="mr-12">{{ $accountsTotals['transfersReceived'] }} {{__('exchange received past year')}}</p>
                     @else
                     <p class="mr-12">{{ $accountsTotals['transfersReceived'] }} {{__('exchanges received past year')}}</p>
                     @endif
                     @if($accountsTotals['transfersGiven'] === 1)
                     <p class="mr-12">{{ $accountsTotals['transfersGiven'] }} {{__('exchange given past year')}}</p>
                     @else
                     <p class="mr-12">{{ $accountsTotals['transfersGiven'] }} {{__('exchanges given past year')}}</p>
                     @endif
                 </div>
                 <div class="text-gray-400">
                     @if ($lastLoginAt)
                     <div>
                         {{ __('Last login') . ': ' . $lastLoginAt }}
                     </div>
                     @else
                     <div>
                         <div>
                             @endif
                             @if ($lastExchangeAt)
                             <div>
                                 {{ __('Last exchange') . ': ' . $lastExchangeAt }}
                             </div>
                             @endif
                             <div>{{ __('Registered since') . ': ' . $registeredSince }}</div>

                         </div>
                         <div>

                             <div class="mt-6 sm:mx-4 sm:mt-0">
                             </div>
                             <p class="mt-4 text-gray-300 group-hover:text-gray-300 dark:text-gray-300">
                                 Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                 pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                 mollit
                                 anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                 aliquip ex ea commodo consequat.
                                 <a href="#" class="flex transform items-center text-sm text-gray-300 underline transition-colors duration-100 hover:text-gray-100 hover:underline dark:text-gray-400 dark:hover:text-gray-100">
                                     <span>Read more...</span>
                                     <svg class="mx-1 h-4 w-4 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                     </svg>
                                 </a>
                             </p>


                             <!--- Social media -->
                             <div class="item-center mt-8 flex justify-between">
                                 @foreach($socials as $value)
                                 <div class="flex">
                                     <a href="{{ (str_starts_with($value->pivot->user_on_social, 'https://') ? $value->pivot->user_on_social :
                                    str_replace('#', $value->pivot->server_of_social, $value->url_structure)  . $value->pivot->user_on_social )}}" target="_blank" class="mx-2 text-gray-300 hover:text-gray-100 group-hover:text-white dark:text-gray-300 dark:hover:text-gray-300" aria-label="{{ $value->name }}">
                                         <img src="{{  Storage::url($value->icon) }}" alt="{{ $value->name }}" class="h-10 w-10 invert opacity-75 hover:opacity-100" />
                                     </a>
                                     @endforeach
                                 </div>
                             </div>

                                                       
                         </div>

   <div class="">
                                 <div class="bg-gray-white flex items-center justify-end gap-8 py-3 text-right">
                                     <button class="items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700 focus:border-gray-900 focus:outline-none focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25">{{ __('Pay') }}</button>
                                     <button wire:click="startMessenger" class="transition0 items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700 focus:border-gray-900 focus:outline-none focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25">{{ __('Send Message') }}</button>
                                 </div>
                             </div>


                     </div>

         </section>




         {{--
        <!--- Skill color examples, uncomment for  Laravel Mix to compile all skill colors! -->
         <div class="mt-24"></div>

         <div class="flex flex-wrap">
             <!-- Red -->
             <div class="w-1/2 bg-red-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Red-200</div>

             <!-- Orange -->
             <div class="w-1/2 bg-orange-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Orange-200</div>

             <!-- Yellow -->
             <div class="w-1/2 bg-amber-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Amber-200</div>

             <!-- Green -->
             <div class="w-1/2 bg-yellow-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Yellow-200</div>

             <!-- Teal -->
             <div class="w-1/2 bg-lime-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Lime-200</div>

             <!-- Blue -->
             <div class="w-1/2 bg-green-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Green-200</div>

             <!-- Indigo -->
             <div class="w-1/2 bg-emerald-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Emerald-200</div>

             <!-- Purple -->
             <div class="w-1/2 bg-teal-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Teal-200</div>

             <!-- Pink -->
             <div class="w-1/2 bg-cyan-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Cyan-200</div>

             <!-- Red-200 -->
             <div class="w-1/2 bg-sky-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Sky-200</div>

             <!-- Orange-200 -->
             <div class="w-1/2 bg-blue-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Blue-200</div>

             <!-- Yellow-200 -->
             <div class="w-1/2 bg-indigo-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Indigo-200</div>

             <!-- Green-200 -->
             <div class="w-1/2 bg-violet-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Violet-200</div>

             <!-- Teal-200 -->
             <div class="w-1/2 bg-purple-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Purple-200</div>

             <!-- Blue-200 -->
             <div class="w-1/2 bg-fuchsia-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Fuchsia-200</div>

             <!-- Indigo-200 -->
             <div class="w-1/2 bg-pink-200 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Pink-200</div>



   
         </div>

         <div class="flex flex-wrap">
             <!-- Red -->
             <div class="w-1/2 bg-red-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Red-300</div>

             <!-- Orange -->
             <div class="w-1/2 bg-orange-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Orange-300</div>

             <!-- Yellow -->
             <div class="w-1/2 bg-amber-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Amber-300</div>

             <!-- Green -->
             <div class="w-1/2 bg-yellow-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Yellow-300</div>

             <!-- Teal -->
             <div class="w-1/2 bg-lime-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Lime-300</div>

             <!-- Blue -->
             <div class="w-1/2 bg-green-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Green-300</div>

             <!-- Indigo -->
             <div class="w-1/2 bg-emerald-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Emerald-300</div>

             <!-- Purple -->
             <div class="w-1/2 bg-teal-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Teal-300</div>

             <!-- Pink -->
             <div class="w-1/2 bg-cyan-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Cyan-300</div>

             <!-- Red-300 -->
             <div class="w-1/2 bg-sky-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Sky-300</div>

             <!-- Orange-300 -->
             <div class="w-1/2 bg-blue-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Blue-300</div>

             <!-- Yellow-300 -->
             <div class="w-1/2 bg-indigo-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Indigo-300</div>

             <!-- Green-300 -->
             <div class="w-1/2 bg-violet-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Violet-300</div>

             <!-- Teal-300 -->
             <div class="w-1/2 bg-purple-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Purple-300</div>

             <!-- Blue-300 -->
             <div class="w-1/2 bg-fuchsia-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Fuchsia-300</div>

             <!-- Indigo-300 -->
             <div class="w-1/2 bg-pink-300 p-4 text-gray-900 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6">Pink-300</div>
   
         </div> --}}





     </div>