 <div class="py-12">
     <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

         <section>

             <div class="relative rounded-lg border-gray-600 bg-black border-1 px-12 py-16 shadow-xl dark:border-gray-700">

                 <div class="mt-3 flex justify-between">
                 @if ($isOnline)
                    <img class="h-60 w-60 flex-shrink-0 rounded-full object-cover ring-4 ring-green-400 sm:mx-4"
                        src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}">
                @elseif ($isAway)
                    <img class="h-60 w-60 flex-shrink-0 rounded-full object-cover ring-4 ring-sky-400 sm:mx-4"
                        src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}">
                @else
                    <img class="h-60 w-60 flex-shrink-0 rounded-full object-cover ring-4 ring-gray-300 sm:mx-4"
                        src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}">
                @endif
                     <div class="pl-4 sm:mx-4 sm:mt-0">

                         <div class="flex justify-between">
                             <h1
                                 class="text-4xl font-extrabold text-gray-100 group-hover:text-white dark:text-white ">
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

                         <div
                             class="mt-4 grid grid-cols-3 gap-1 text-gray-400 dark:text-gray-200 md:grid-cols-3 xl:grid-cols-3">

                             <div class="">
                                 <a class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500"
                                     href="{{ $location['link'] }}">
                                     <svg aria-label="location pin icon" class="h-8 w-8 fill-current pr-2"
                                         viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" clip-rule="evenodd"
                                             d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                         <path fill-rule="evenodd" clip-rule="evenodd"
                                             d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                     </svg>
                                     {{ $location['name'] }}
                                 </a>
                             </div>

                            @if ($friend && $phone)
                            <div class="">
                                <a class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-8 w-8 pr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                    {{ $phone }}
                                </a>
                            </div>
                            @endif

                            <!-- Friend request buttons only visible if the active profile is not the model -->
                            @if (session('activeProfileType') === $user::class && session('activeProfileId') !== $user->id || session('activeProfileType') !== $this->user::class)   

                                <div class="">
                                    @if (count($friend) < 1 && count($pendingFriend) < 1)
                                        <!-- Not a friend -->
                                        <a wire:click="friendRequest" class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500" 
                                            onclick="FriendsManager.action({dropdown : true, provider_id : '{{$user->id}}', action : 'add', provider_alias : 'user'}); 
                                            return false;" 
                                            href="#"><i class="fas fa-user-plus"></i><br/> 
                                            {{ __('Friend request') }}</a>
                                    @elseif (count($pendingFriend) > 0 )
                                        <!-- Pending friend -->
                                        <a wire:click="cancelFriendRequest" class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500" 
                                            onclick="FriendsManager.action({dropdown : true, provider_id : '{{$user->id}}', action : 'cancel', sent_friend_id : '{{ $pendingFriend->first()->id }}', provider_alias : 'user'}); return false;" href="#"><i class="fas fa-ban"></i> 
                                            <br/> 
                                            {{ __('Cancel friend request') }}</a>
                                    @else
                                        <!-- Is a friend -->
                                        <a wire:click="cancelFriendRequest" class="text-lg font-bold text-gray-400 underline hover:text-gray-100 dark:text-gray-500" 
                                            onclick="FriendsManager.action({dropdown : true, provider_id : '{{$user->id}}', action : 'remove', friend_id : '{{ $friend->first()->id }}', provider_alias : 'user'}); return false;" href="#"><i class="fas fa-user-times"></i> 
                                            <br/> 
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
                        <a href="#" @click.prevent="showAboutFullText = !showAboutFullText"
                         class="text-sm text-gray-300 underline transition-colors duration-100 hover:text-gray-100 hover:underline dark:text-gray-400 dark:hover:text-gray-100">
                
                            <span x-show="!showAboutFullText" class="underline inline-flex items-center">{{__('Read more')}}...
                             <svg class="mx-1 h-4 w-4 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd"
                                     d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                     clip-rule="evenodd"></path>
                             </svg>
                             </span>
                            
                            <span x-show="showAboutFullText" class="underline inline-flex items-center">
                                <svg class="mx-1 h-4 w-4 transform scale-x-[-1]" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
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
                         <a href="#"
                             class="flex transform items-center text-sm text-gray-300 underline transition-colors duration-100 hover:text-gray-100 hover:underline dark:text-gray-400 dark:hover:text-gray-100">
                             <span>Read more...</span>
                             <svg class="mx-1 h-4 w-4 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd"
                                     d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                     clip-rule="evenodd"></path>
                             </svg>
                         </a>
                     </p>



                     <div class="item-center mt-8 flex justify-between">

                         <div class="flex">
                             <a href="#"
                                 class="mx-2 text-gray-300 hover:text-gray-100 group-hover:text-white dark:text-gray-300 dark:hover:text-gray-300"
                                 aria-label="Reddit">
                                 <svg class="h-12 w-12 fill-current" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM6.807 10.543C6.20862 10.5433 5.67102 10.9088 5.45054 11.465C5.23006 12.0213 5.37133 12.6558 5.807 13.066C5.92217 13.1751 6.05463 13.2643 6.199 13.33C6.18644 13.4761 6.18644 13.6229 6.199 13.769C6.199 16.009 8.814 17.831 12.028 17.831C15.242 17.831 17.858 16.009 17.858 13.769C17.8696 13.6229 17.8696 13.4761 17.858 13.33C18.4649 13.0351 18.786 12.3585 18.6305 11.7019C18.475 11.0453 17.8847 10.5844 17.21 10.593H17.157C16.7988 10.6062 16.458 10.7512 16.2 11C15.0625 10.2265 13.7252 9.79927 12.35 9.77L13 6.65L15.138 7.1C15.1931 7.60706 15.621 7.99141 16.131 7.992C16.1674 7.99196 16.2038 7.98995 16.24 7.986C16.7702 7.93278 17.1655 7.47314 17.1389 6.94094C17.1122 6.40873 16.6729 5.991 16.14 5.991C16.1022 5.99191 16.0645 5.99491 16.027 6C15.71 6.03367 15.4281 6.21641 15.268 6.492L12.82 6C12.7983 5.99535 12.7762 5.993 12.754 5.993C12.6094 5.99472 12.4851 6.09583 12.454 6.237L11.706 9.71C10.3138 9.7297 8.95795 10.157 7.806 10.939C7.53601 10.6839 7.17843 10.5422 6.807 10.543ZM12.18 16.524C12.124 16.524 12.067 16.524 12.011 16.524C11.955 16.524 11.898 16.524 11.842 16.524C11.0121 16.5208 10.2054 16.2497 9.542 15.751C9.49626 15.6958 9.47445 15.6246 9.4814 15.5533C9.48834 15.482 9.52348 15.4163 9.579 15.371C9.62737 15.3318 9.68771 15.3102 9.75 15.31C9.81233 15.31 9.87275 15.3315 9.921 15.371C10.4816 15.7818 11.159 16.0022 11.854 16C11.9027 16 11.9513 16 12 16C12.059 16 12.119 16 12.178 16C12.864 16.0011 13.5329 15.7863 14.09 15.386C14.1427 15.3322 14.2147 15.302 14.29 15.302C14.3653 15.302 14.4373 15.3322 14.49 15.386C14.5985 15.4981 14.5962 15.6767 14.485 15.786V15.746C13.8213 16.2481 13.0123 16.5208 12.18 16.523V16.524ZM14.307 14.08H14.291L14.299 14.041C13.8591 14.011 13.4994 13.6789 13.4343 13.2429C13.3691 12.8068 13.6162 12.3842 14.028 12.2269C14.4399 12.0697 14.9058 12.2202 15.1478 12.5887C15.3899 12.9572 15.3429 13.4445 15.035 13.76C14.856 13.9554 14.6059 14.0707 14.341 14.08H14.306H14.307ZM9.67 14C9.11772 14 8.67 13.5523 8.67 13C8.67 12.4477 9.11772 12 9.67 12C10.2223 12 10.67 12.4477 10.67 13C10.67 13.5523 10.2223 14 9.67 14Z">
                                     </path>
                                 </svg>
                             </a>

                             <a href="#"
                                 class="mx-2 text-gray-300 hover:text-gray-100 group-hover:text-white dark:text-gray-300 dark:hover:text-gray-300"
                                 aria-label="Facebook">
                                 <svg class="h-12 w-12 fill-current" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M2.00195 12.002C2.00312 16.9214 5.58036 21.1101 10.439 21.881V14.892H7.90195V12.002H10.442V9.80204C10.3284 8.75958 10.6845 7.72064 11.4136 6.96698C12.1427 6.21332 13.1693 5.82306 14.215 5.90204C14.9655 5.91417 15.7141 5.98101 16.455 6.10205V8.56104H15.191C14.7558 8.50405 14.3183 8.64777 14.0017 8.95171C13.6851 9.25566 13.5237 9.68693 13.563 10.124V12.002H16.334L15.891 14.893H13.563V21.881C18.8174 21.0506 22.502 16.2518 21.9475 10.9611C21.3929 5.67041 16.7932 1.73997 11.4808 2.01722C6.16831 2.29447 2.0028 6.68235 2.00195 12.002Z">
                                     </path>
                                 </svg>
                             </a>

                             <a href="#"
                                 class="mx-2 text-gray-300 hover:text-gray-100 group-hover:text-white dark:text-gray-300 dark:hover:text-gray-300"
                                 aria-label="Github">
                                 <svg class="h-12 w-12 fill-current" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M12.026 2C7.13295 1.99937 2.96183 5.54799 2.17842 10.3779C1.395 15.2079 4.23061 19.893 8.87302 21.439C9.37302 21.529 9.55202 21.222 9.55202 20.958C9.55202 20.721 9.54402 20.093 9.54102 19.258C6.76602 19.858 6.18002 17.92 6.18002 17.92C5.99733 17.317 5.60459 16.7993 5.07302 16.461C4.17302 15.842 5.14202 15.856 5.14202 15.856C5.78269 15.9438 6.34657 16.3235 6.66902 16.884C6.94195 17.3803 7.40177 17.747 7.94632 17.9026C8.49087 18.0583 9.07503 17.99 9.56902 17.713C9.61544 17.207 9.84055 16.7341 10.204 16.379C7.99002 16.128 5.66202 15.272 5.66202 11.449C5.64973 10.4602 6.01691 9.5043 6.68802 8.778C6.38437 7.91731 6.42013 6.97325 6.78802 6.138C6.78802 6.138 7.62502 5.869 9.53002 7.159C11.1639 6.71101 12.8882 6.71101 14.522 7.159C16.428 5.868 17.264 6.138 17.264 6.138C17.6336 6.97286 17.6694 7.91757 17.364 8.778C18.0376 9.50423 18.4045 10.4626 18.388 11.453C18.388 15.286 16.058 16.128 13.836 16.375C14.3153 16.8651 14.5612 17.5373 14.511 18.221C14.511 19.555 14.499 20.631 14.499 20.958C14.499 21.225 14.677 21.535 15.186 21.437C19.8265 19.8884 22.6591 15.203 21.874 10.3743C21.089 5.54565 16.9181 1.99888 12.026 2Z">
                                     </path>
                                 </svg>
                             </a>
                         </div>



                         <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-1">
                             <div class="bg-gray-white flex items-center justify-end gap-8 py-3 text-right">

                                 <button
                                     class="items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700 focus:border-gray-900 focus:outline-none focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25">{{ __('Pay') }}</button>

                                 <button
                                 wire:click="startMessenger"  
                                     class="transition0 items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700 focus:border-gray-900 focus:outline-none focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25">{{ __('Send Message') }}</button>
                             
                             
                             
                             
                             
                             </div>
                         </div>
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
