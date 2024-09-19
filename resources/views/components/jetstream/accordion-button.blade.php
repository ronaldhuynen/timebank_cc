<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center pl-4 pr-2 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 hover:text-gray-600 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-900 active:bg-gray-50 disabled:opacity-25 transition']) }}>
    {{ $slot }}
    <span class="ml-2"><x-icon name="chevron-down" class="w-5 h-5" mini/></span>
</button>
