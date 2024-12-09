<footer class="mx-auto mt-24 py-4">

    <hr class="border-gray-300 dark:border-gray-200">

    <div class="container py-6">

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Quick Link</p>

                <div class="mt-1 flex flex-col items-start space-y-2">
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">Home</a>
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">Who We Are</a>
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">Our Philosophy</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Industries</p>

                <div class="mt-1 flex flex-col items-start space-y-2">
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">Retail & E-Commerce</a>
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">Information Technology</a>
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">Finance & Insurance</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Services</p>

                <div class="mt-1 flex flex-col items-start space-y-2">
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">Translation</a>
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">Proofreading & Editing</a>
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">Content Creation</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Contact Us</p>

                <div class="mt-1 flex flex-col items-start space-y-2">
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">+880 768 473 4978</a>
                    <a class="text-gray-700 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-600 dark:hover:text-blue-400"
                       href="#">info@merakiui.com</a>
                </div>
            </div>
        </div>

        <!-- Bottom Section: Application Mark and Text -->
        <div class="mt-10 flex w-full flex-col items-end justify-end space-y-2">
            <div class="flex flex-col items-center justify-center">
                <a href="{{ route('dashboard') }}">
                    <x-jetstream.application-mark class="block h-9 w-auto" />
                </a>

                <p class="text-2xs text-gray-900 dark:text-gray-300">
                    {{ __('Your time is currency') }}
                </p>
            </div>
        </div>

    </div>
</footer>
