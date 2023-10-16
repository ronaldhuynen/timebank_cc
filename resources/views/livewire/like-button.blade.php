<div>
    <!-- If active profile is not the model, the profile can like the model -->
    @if (session('activeProfileType') === $model::class && session('activeProfileId')  !== $model->id || session('activeProfileType') !== $this->model::class)
        <!-- Model has likes, but not by current reacter -->
        @if ($count > 0 && !$likedByReacter)
            <button wire:click="like"
                class="text transform text-transparent stroke-yellow-200 stroke-width-1 transition-colors duration-10 hover:text-yellow-300 hover:stroke-gray-800 hover:stroke-width-1 focus:text-transparent focus:stroke-yellow-200 dark:bg-gray-700 dark:focus:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 1 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                </svg>
                <div class="text-sm font-extrabold text-yellow-300">{{ $count }}</span>
            </button>
        <!-- Model has likes, also from current reacter -->
        @elseif ($count > 0 && $likedByReacter)
            <button wire:click="unlike"
                class="text transform text-yellow-300 stroke-gray-700 stroke-width-1 transition-colors duration-10 hover:text-gray-900 hover:stroke-yellow-200 hover:stroke-width-1 focus:text-yellow-300 focus:stroke-gray-700 dark:bg-gray-700 dark:focus:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 1 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                </svg>
                <div class="text-sm font-extrabold text-yellow-300">{{ $count }}</span>
            </button>
        <!-- Model has not been liked -->
        @else
        <button wire:click="like"
        class="text transform text-transparent stroke-gray-400 stroke-width-1 transition-colors duration-10 hover:text-yellow-300 hover:stroke-gray-800 hover:stroke-width-1 focus:text-transparent focus:stroke-gray-400  dark:bg-gray-700 dark:focus:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 1 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                </svg>
                <div class="text-sm font-extrabold text-gray-400">{{ $count }}</span>
        </button>
        @endif
    <!-- Else the active profile is the model, therefore button is disabled -->
    @else
         <!-- Model has likes, but not by current reacter -->
        @if ($count > 0 && !$likedByReacter)
            <button disabled
                class="cursor-not-allowed text transform text-transparent stroke-yellow-200 stroke-width-1 transition-colors duration-10 hover:text-gray-900 hover:stroke-gray-600 hover:stroke-width-1 focus:text-transparent focus:stroke-yellow-200 dark:bg-gray-700 dark:focus:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 1 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                </svg>
                <div class="text-sm font-extrabold text-yellow-300">{{ $count }}</span>
            </button>
        <!-- Model has likes, also from current reacter -->
        @elseif ($count > 0 && $likedByReacter)
            <button disabled
                class="cursor-not-allowed text transform text-yellow-300 stroke-gray-700 stroke-width-1 transition-colors duration-10 hover:text-gray-900 hover:stroke-gray-200 hover:stroke-width-1 focus:text-yellow-300 focus:stroke-gray-700 dark:bg-gray-700 dark:focus:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 1 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                </svg>
                <div class="text-sm font-extrabold text-yellow-300">{{ $count }}</span>
            </button>
        <!-- Model has not been liked -->
        @else
        <button disabled
        class="cursor-not-allowed ext transform text-transparent stroke-gray-400 stroke-width-1 transition-colors duration-10 hover:text-gray-900 hover:stroke-gray-600 hover:stroke-width-1 focus:text-transparent focus:stroke-gray-400  dark:bg-gray-700 dark:focus:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 1 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                </svg>
                <div class="text-sm font-extrabold text-gray-400">{{ $count }}</span>
        </button>
        @endif
    @endif
</div>
