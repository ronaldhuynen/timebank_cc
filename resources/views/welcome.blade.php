<x-guest-layout>
    <!-- Your content here -->

        {{-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0"> --}}

  
                        @livewire('welcome.landing-post', ['type' => 'SiteContents\Welcome\Landing' ?? null, 'random' => true, 'limit' => 1])
                        @livewire('welcome.cta-post', ['type' => 'SiteContents\Welcome\Cta' ?? null])


</x-guest-layout>

