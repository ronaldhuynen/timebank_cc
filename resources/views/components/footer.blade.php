<footer class="mx-auto bg-black pt-4">

    <div class="container py-6">

        <div class="grid grid-cols-1 gap-6 text-xs sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <div>
                <p class="font-semibold text-white dark:text-white">{{ __('Help') }}</p>

                <div class="mt-1 flex flex-col items-start space-y-2">
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-getting-started') }}">{{ __('Getting started') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-faq') }}">{{ __('FAQ') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-organizations') }}">{{ __('Organizations') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-principles') }}">{{ __('Timebank principles') }}</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-white dark:text-white">{{ __('Projects') }} </p>

                <div class="mt-1 flex flex-col items-start space-y-2">
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-the-hague') }}">{{ __('The Hague') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-lekkernassuh') }}">{{ __('Lekkernassûh') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-amst-brus-lisb') }}">{{ __('Amsterdam, Brussels, Lisbon') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">{{ __('Work with us') }}</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-white dark:text-white">{{ __('Who we are') }}</p>

                <div class="mt-1 flex flex-col items-start space-y-2">
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-philosophy') }}">{{ __('Our philosophy') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-association') }}">{{ __('The association') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-history') }}">{{ __('History') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-press-media') }}">{{ __('Press and media') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-research') }}">{{ __('Research') }}</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-white dark:text-white">{{ __('Contact us') }}</p>

                <div class="mt-1 flex flex-col items-start space-y-2">
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-team') }}">{{ __('Meet the team') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="{{ route('static-team') }}">{{ __('Chat messenger') }}</a>
                    <a class="text-gray-100 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">info@timebank.cc</a>
                </div>
            </div>
        </div>

        <!-- Bottom Section: Application Mark and Text -->
        <div class="mt-1 flex w-full flex-col items-end justify-end space-y-2">
            <div class="invert-100 flex flex-col items-center justify-center">
                <a href="{{ route('dashboard') }}">
                    <x-jetstream.application-mark class="block h-9 w-auto" />
                </a>

                <p class="text-2xs font-semibold text-gray-800 dark:text-gray-100">
                    {{ __('Your time is currency') }}
                </p>
            </div>
        </div>

    </div>
</footer>
