<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your transaction history') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="mt-8 text-2xl">
                        Welcome to your Jetstream application!
                    </div>

                    <div class="mt-6 text-gray-500">
                        Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
                        to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
                        you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
                        ecosystem to be a breath of fresh air. We hope you love it.
                    </div>
                     <div class="col-span-6 sm:col-span-3">
                         <label for="account" class="block text-sm font-medium text-gray-700">{{ __('From your') }}</label>
                         <select id="account" name="account" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                             @foreach($userAccounts as $userAccount)
                             <option value="{{ $userAccount['id'] }}">{{ $userAccount['name'] }} &emsp; {{ tbFormat($userAccount['balance']) }}</option>
                             @endforeach
                         </select>
                     </div>

                </div>
            </div>
        </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-20 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


        {{-- <div class="container mx-auto px-4 sm:px-8 max-w-3xl"> --}}
                <div class="-mx-20 sm:-mx-20 px-4 sm:px-20 py-6 overflow-x-auto">

                    <div class="inline-block min-w-full overflow-hidden">
                        <table class="min-w-full w-full leading-normal" id="transactions">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        {{ __('Date') }}
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        {{ __('From / to') }}
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        {{ __('Details') }}
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        {{ __('Amount') }}
                                    </th>
                                    <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        {{ __('Balance') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ date('d-m-Y', strtotime($transaction['datetime'])) }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <a href="#" class="block relative">
                                                <img alt="profile" src="{{ $transaction['profile_photo'] }}" class="mx-auto object-cover rounded-full h-10 w-10 " />
                                            </a>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $transaction['relation'] }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $transaction['description'] }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                   <p class="text-gray-900 whitespace-no-wrap">
                                       {{ tbFormat($transaction['amount']) }}
                                            @if ( $transaction['type'] === 'Debit' )
                                            -
                                            @else
                                            +
                                            @endif
                                        </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                       {{ tbFormat($transaction['balance']) }}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->onEachSide(1)->links('vendor.pagination.tailwind') }}
                    </div>
                </div>



</div>
</div>
</div>




    </div>

</x-app-layout>

