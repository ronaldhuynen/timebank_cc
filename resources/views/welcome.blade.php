@php
    $layout = Auth::check() ? 'app-layout' : 'guest-layout';
@endphp

<x-dynamic-component :component="$layout">
    <!-- Your content here --> 
    @livewire('welcome.landing-post', ['type' => 'SiteContents\Welcome\Landing' ?? null, 'random' => true, 'limit' => 1])
    @guest
        @livewire('welcome.cta-post', ['type' => 'SiteContents\Welcome\Cta' ?? null])
    @endguest
    @auth
        <div class="bg-black -m-6"></div>
    @endauth
</x-dynamic-component>
