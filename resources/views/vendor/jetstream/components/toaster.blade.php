@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}"
            :class="{ 'fixed bottom-0 left-0 right-0 bg-green-100': style == 'success', 'fixed bottom-0 left-0 right-0 bg-red-100': style == 'danger', 'fixed bottom-0 left-0 right-0 bg-gray-100': style != 'success' && style != 'danger' }"



            style="display: none;"
            x-show="show && message"
            x-transition:leave.opacity.duration.1000ms
            x-init="
                document.addEventListener('toaster-message', event => {
                    style = event.detail.style;
                    message = event.detail.message;
                    show = true;
                    timeout = setTimeout(() => { show = false }, 4000);
                });
            ">
    <div class="mx-auto py-4 px-6 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg" :class="{ 'bg-green-100': style == 'success', 'bg-red-100': style == 'danger' }">
                    <svg x-show="style == 'success'" class="h-5 w-5 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="style == 'danger'" class="h-5 w-5 text-red-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="style != 'success' && style != 'danger'" class="h-5 w-5 text-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>

                <p class="ml-3 font-medium text-sm text-dark truncate" x-text="message"></p>
            </div>

            <div class="shrink-0 sm:ml-3">
                <button
                    type="button"
                    class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition"
                    :class="{ 'hover:bg-green-300 focus:bg-green-300': style == 'success', 'hover:bg-red-300 focus:bg-red-300': style == 'danger' }"
                    aria-label="Dismiss"
                    x-on:click="show = false">
                    <svg class="h-5 w-5 text-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
