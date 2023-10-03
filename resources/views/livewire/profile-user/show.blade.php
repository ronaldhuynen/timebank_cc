 <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}


                {{-- <div class="p-6 sm:px-20 bg-white border-b border-gray-200"> --}}

         <section>
	{{-- <div class="container px-60 py-10 mx-auto"> --}}

		{{-- <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-1"> --}}
			<div class="px-14 py-14 bg-black border rounded-lg shadow-xl dark:border-gray-700 relative">

				<div class="flex justify-between mt-3 item-center">
					<img class="flex-shrink-0 object-cover w-60 h-60 rounded-full sm:mx-4 ring-4 ring-green-400" src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}">

					<div class="mt-4 pl-4 sm:mx-4 sm:mt-0">

						<div class="flex justify-between mt-3 item-center">
							<h1 class="text-xl font-semibold text-gray-100 md:text-3xl dark:text-white group-hover:text-white">{{$user->name}}</h1>
							<button class="text text-gray-500 transition-colors duration-100 transform dark:bg-gray-700 focus:outline-none focus:bg-gray-700 dark:focus:bg-gray-600">

								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-10 h-10 hover:text-gray-100 ">
									<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
								</svg>

							</button>
						</div>

						<h3 class="mt-2 text-xl text-gray-500 dark:text-gray-300 group-hover:text-gray-300">{{$user->motivation}}</h3>

						<div class="flex items-center mt-4 text-gray-500 dark:text-gray-200">

							<svg aria-label="location pin icon" class="w-6 h-6 fill-current pr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
								<path fill-rule="evenodd" clip-rule="evenodd" d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
							</svg>

							<p class="pr-5 underline">{{$user->locations->first()->cities->first()->locale->name}}, , NL</p>

							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pr-2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
							</svg>

							<p class="pr-5 underline">Friend request</p>

						</div>

						<p class="mt-4 text-gray-300 capitalize dark:text-gray-300 group-hover:text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum nesciunt officia aliquam neque optio? Cumque facere numquam est. </p>
					</div>

				</div>

				<div class="flex items-center mt-12 text-gray-500 dark:text-gray-200">

					<p class="pr-2">🇳🇱</p>
					<p class="pr-2">Dutch, expert</p>
					<p class="pr-2">|</p>
					<p class="pr-2">🇬🇧</p>
					<p class="pr-2">English, expert</p>
					<p class="pr-2">|</p>
					<p class="pr-2">🇩🇪</p>
					<p class="pr-2">German, beginner</p>
				</div>

				<div class="mt-4 flex-wrap gap-2 sm:flex">
					<span class="flex-shrink-0 bg-green-200 py-1 px-3 rounded text-green-800">Available</span>

					<div class="hidden flex-shrink-0 border-l-2 border-gray-200 mx-1 lg:block"></div>

					<span class="hidden flex-shrink-0 bg-gray-500 py-1 px-2 rounded text-gray-50 lg:block">Metalworking</span>
					<span class="hidden flex-shrink-0 bg-gray-500 py-1 px-2 rounded text-gray-50 lg:block">Bicycle repairs</span>
					<span class="hidden flex-shrink-0 bg-gray-500 py-1 px-2 rounded text-gray-50 lg:block">Small scale CNC Woodworking</span>
					<span class="hidden flex-shrink-0 bg-gray-500 py-1 px-2 rounded text-gray-50 lg:block">Adobe Photoshop</span>
					<span class="hidden flex-shrink-0 bg-gray-500 py-1 px-2 rounded text-gray-50 lg:block">3d design (Sketchup)</span>
					<span class="hidden flex-shrink-0 bg-gray-500 py-1 px-2 rounded text-gray-50 lg:block">Canoe Canal Cruises</span>
					<span class="hidden flex-shrink-0 bg-gray-500 py-1 px-2 rounded text-gray-50 lg:block">Laravel PHP framework (beginner)</span>
					<span class="hidden flex-shrink-0 bg-blue-200 py-1 px-2 rounded text-blue-800 lg:block">Database Management</span>
					<span class="hidden flex-shrink-0 bg-red-200 py-1 px-2 rounded text-red-800 lg:block">Crafts</span>
					<span class="hidden flex-shrink-0 bg-indigo-200 py-1 px-2 rounded text-indigo-800 lg:block">Timebank Workshops</span>
					<span class="hidden flex-shrink-0 bg-yellow-200 py-1 px-2 rounded text-yellow-800 lg:block">Bicycle Transportation Advice</span>
					<span class="hidden flex-shrink-0 bg-pink-200 py-1 px-2 rounded text-pink-800 lg:block">Exhibition Design</span>
				</div>

				<div class="flex items-center mt-6 text-gray-500 dark:text-gray-200">
					<p class="mr-12 text-lg font-bold text-gray-100 dark:text-gray-200 md:text-xl">- H 78:15</p>
					<p class="mr-12 text-lg font-bold text-gray-100 dark:text-gray-200 md:text-xl">+ H 82:30</p>
					<p class="mr-12 text-lg font-bold text-gray-100 dark:text-gray-200 md:text-xl">34 exchanges</p>

				</div>

				<div class="mt-6 sm:mx-4 sm:mt-0">
				</div>
				<p class="mt-4 text-gray-300 dark:text-gray-300 group-hover:text-gray-300">
					Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p> <a href="#" class="flex items-center -mx-1 text-sm text-gray-300 underline transition-colors duration-100 transform dark:text-gray-400 hover:underline hover:text-gray-100 dark:hover:text-gray-100">
					<span class="mx-1">Read more...</span>
					<svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
					</svg>
				</a>

				<div class="flex mt-6 -mx-2">
					<a href="#" class="mx-2 text-gray-300 dark:text-gray-300 hover:text-gray-100 dark:hover:text-gray-300 group-hover:text-white" aria-label="Reddit">
						<svg class="w-12 h-12 fill-current" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM6.807 10.543C6.20862 10.5433 5.67102 10.9088 5.45054 11.465C5.23006 12.0213 5.37133 12.6558 5.807 13.066C5.92217 13.1751 6.05463 13.2643 6.199 13.33C6.18644 13.4761 6.18644 13.6229 6.199 13.769C6.199 16.009 8.814 17.831 12.028 17.831C15.242 17.831 17.858 16.009 17.858 13.769C17.8696 13.6229 17.8696 13.4761 17.858 13.33C18.4649 13.0351 18.786 12.3585 18.6305 11.7019C18.475 11.0453 17.8847 10.5844 17.21 10.593H17.157C16.7988 10.6062 16.458 10.7512 16.2 11C15.0625 10.2265 13.7252 9.79927 12.35 9.77L13 6.65L15.138 7.1C15.1931 7.60706 15.621 7.99141 16.131 7.992C16.1674 7.99196 16.2038 7.98995 16.24 7.986C16.7702 7.93278 17.1655 7.47314 17.1389 6.94094C17.1122 6.40873 16.6729 5.991 16.14 5.991C16.1022 5.99191 16.0645 5.99491 16.027 6C15.71 6.03367 15.4281 6.21641 15.268 6.492L12.82 6C12.7983 5.99535 12.7762 5.993 12.754 5.993C12.6094 5.99472 12.4851 6.09583 12.454 6.237L11.706 9.71C10.3138 9.7297 8.95795 10.157 7.806 10.939C7.53601 10.6839 7.17843 10.5422 6.807 10.543ZM12.18 16.524C12.124 16.524 12.067 16.524 12.011 16.524C11.955 16.524 11.898 16.524 11.842 16.524C11.0121 16.5208 10.2054 16.2497 9.542 15.751C9.49626 15.6958 9.47445 15.6246 9.4814 15.5533C9.48834 15.482 9.52348 15.4163 9.579 15.371C9.62737 15.3318 9.68771 15.3102 9.75 15.31C9.81233 15.31 9.87275 15.3315 9.921 15.371C10.4816 15.7818 11.159 16.0022 11.854 16C11.9027 16 11.9513 16 12 16C12.059 16 12.119 16 12.178 16C12.864 16.0011 13.5329 15.7863 14.09 15.386C14.1427 15.3322 14.2147 15.302 14.29 15.302C14.3653 15.302 14.4373 15.3322 14.49 15.386C14.5985 15.4981 14.5962 15.6767 14.485 15.786V15.746C13.8213 16.2481 13.0123 16.5208 12.18 16.523V16.524ZM14.307 14.08H14.291L14.299 14.041C13.8591 14.011 13.4994 13.6789 13.4343 13.2429C13.3691 12.8068 13.6162 12.3842 14.028 12.2269C14.4399 12.0697 14.9058 12.2202 15.1478 12.5887C15.3899 12.9572 15.3429 13.4445 15.035 13.76C14.856 13.9554 14.6059 14.0707 14.341 14.08H14.306H14.307ZM9.67 14C9.11772 14 8.67 13.5523 8.67 13C8.67 12.4477 9.11772 12 9.67 12C10.2223 12 10.67 12.4477 10.67 13C10.67 13.5523 10.2223 14 9.67 14Z">
							</path>
						</svg>
					</a>

					<a href="#" class="mx-2 text-gray-300 dark:text-gray-300 hover:text-gray-100 dark:hover:text-gray-300 group-hover:text-white" aria-label="Facebook">
						<svg class="w-12 h-12 fill-current" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M2.00195 12.002C2.00312 16.9214 5.58036 21.1101 10.439 21.881V14.892H7.90195V12.002H10.442V9.80204C10.3284 8.75958 10.6845 7.72064 11.4136 6.96698C12.1427 6.21332 13.1693 5.82306 14.215 5.90204C14.9655 5.91417 15.7141 5.98101 16.455 6.10205V8.56104H15.191C14.7558 8.50405 14.3183 8.64777 14.0017 8.95171C13.6851 9.25566 13.5237 9.68693 13.563 10.124V12.002H16.334L15.891 14.893H13.563V21.881C18.8174 21.0506 22.502 16.2518 21.9475 10.9611C21.3929 5.67041 16.7932 1.73997 11.4808 2.01722C6.16831 2.29447 2.0028 6.68235 2.00195 12.002Z">
							</path>
						</svg>
					</a>

					<a href="#" class="mx-2 text-gray-300 dark:text-gray-300 hover:text-gray-100 dark:hover:text-gray-300 group-hover:text-white" aria-label="Github">
						<svg class="w-12 h-12 fill-current" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12.026 2C7.13295 1.99937 2.96183 5.54799 2.17842 10.3779C1.395 15.2079 4.23061 19.893 8.87302 21.439C9.37302 21.529 9.55202 21.222 9.55202 20.958C9.55202 20.721 9.54402 20.093 9.54102 19.258C6.76602 19.858 6.18002 17.92 6.18002 17.92C5.99733 17.317 5.60459 16.7993 5.07302 16.461C4.17302 15.842 5.14202 15.856 5.14202 15.856C5.78269 15.9438 6.34657 16.3235 6.66902 16.884C6.94195 17.3803 7.40177 17.747 7.94632 17.9026C8.49087 18.0583 9.07503 17.99 9.56902 17.713C9.61544 17.207 9.84055 16.7341 10.204 16.379C7.99002 16.128 5.66202 15.272 5.66202 11.449C5.64973 10.4602 6.01691 9.5043 6.68802 8.778C6.38437 7.91731 6.42013 6.97325 6.78802 6.138C6.78802 6.138 7.62502 5.869 9.53002 7.159C11.1639 6.71101 12.8882 6.71101 14.522 7.159C16.428 5.868 17.264 6.138 17.264 6.138C17.6336 6.97286 17.6694 7.91757 17.364 8.778C18.0376 9.50423 18.4045 10.4626 18.388 11.453C18.388 15.286 16.058 16.128 13.836 16.375C14.3153 16.8651 14.5612 17.5373 14.511 18.221C14.511 19.555 14.499 20.631 14.499 20.958C14.499 21.225 14.677 21.535 15.186 21.437C19.8265 19.8884 22.6591 15.203 21.874 10.3743C21.089 5.54565 16.9181 1.99888 12.026 2Z">
							</path>
						</svg>
					</a>
				</div>

				<div class="flex justify-between mt-6 item-center">
					<div class="text-gray-500 dark:text-gray-200 md:text-sm">
						<div>Last login: 13 days ago</div>
						<div>Last exchange: 5 weeks ago</div>
						<div>Registered since: 4 years and 5 months</div>
					</div>

					<div class="grid grid-cols-2 gap-8 md:grid-cols-2 xl:grid-cols-2">

						<button class="px-6 py-3 text text-white uppercase transition-colors duration-100 transform bg-gray-600 rounded dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:bg-gray-700 dark:focus:bg-gray-600">Pay</button>

						<button class="px-6 py-3 text text-white uppercase transition-colors duration-100 transform bg-gray-600 rounded dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:bg-gray-700 dark:focus:bg-gray-600">Contact</button>
					</div>
				</div>

			</div>
			{{-- </div> --}}
            {{-- </div> --}}
            </section>


                {{-- </div> --}}
            {{-- </div> --}}
        </div>
