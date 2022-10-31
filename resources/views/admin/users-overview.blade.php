<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users overview') }}
        </h2>
    </x-slot>


  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


              <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                  <div class="mt-8 text-2xl">
                      {{ __('Users overview title')  }}
                  </div>

                  <div class="mt-6 text-gray-500">
                       {{ __('Users overview intro here. How to search, filter etc.')  }}
                  </div>
                  <div >

                          <livewire:user-datatables searchable="name, email, id" exportable />

                  </div>

              </div>
          </div>
      </div>



@livewireScripts

</x-app-layout>

