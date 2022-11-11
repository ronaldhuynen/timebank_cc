@extends('messenger::app')
@section('title'){{messenger()->getProvider()->getProviderName()}} - {{config('messenger-ui.site_name')}} @endsection
@section('content')
{{-- <div class="container sm:px-4 max-w-full mx-auto mt-n3"> --}}
<div id="messenger_container" class="flex flex-wrap  inbox main-inbox ">
    <div id="message_sidebar_container" class="w-1/4 px-0 h-full">
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 bg-transparent h-full">
            <div class="py-3 px-6 mb-0 border-b-1 border-gray-300 text-gray-900 bg-white flex justify-between">
                <div id="my_avatar_status">
                    <img data-toggle="tooltip" data-placement="right" title="You are {{\Illuminate\Support\Str::lower(\RTippin\Messenger\Contracts\MessengerProvider::ONLINE_STATUS[messenger()->getProvider()->getProviderOnlineStatus()])}}" class="my-global-avatar ml-1 rounded-full medium-image avatar-is-{{\Illuminate\Support\Str::lower(\RTippin\Messenger\Contracts\MessengerProvider::ONLINE_STATUS[messenger()->getProvider()->getProviderOnlineStatus()])}}" src="{{messenger()->getProvider()->getProviderAvatarRoute()}}" />
                </div>
                <span class="hidden md:inline h4 font-bold">Messenger</span>
                <div class="relative">
                    <button data-tooltip="tooltip" title="Messenger Options" data-placement="right" class="align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-3 px-4 leading-tight text-xl bg-gray-100 text-gray-800 hover:bg-gray-200 pt-1 pb-0  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" data-toggle="dropdown"><i class="fas fa-cogs fa-2x"></i></button>
                    <div class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded dropdown-menu-right">
                        <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" onclick="ThreadManager.load().search(); return false;" href="#"><i class="fas fa-search"></i> Search Profiles</a>
                        <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" onclick="ThreadManager.load().createGroup(); return false;" href="#"><i class="fas fa-edit"></i> Create Group</a>
                        <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" onclick="ThreadManager.load().contacts(); return false;" href="#"><i class="fas fa-user-friends"></i> Friends</a>
                        <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" onclick="MessengerSettings.show(); return false;" href="#"><i class="fas fa-cog"></i> Settings</a>
                    </div>
                </div>
            </div>
            <div data-simplebar id="message_sidebar_content" class="flex-auto p-6 bg-transparent px-0 py-0">
                <div class="w-full px-2 mx-0 py-0">
                    <div id="socket_error"></div>
                    <div id="threads_search_bar" class="NS my-2">
                        <div class="flex flex-wrap -mr-1 -ml-1">
                            <div class="relative flex items-stretch input-group-sm w-full mb-0">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                </div>
                                <input autocomplete="off" type="search" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded shadow-sm" id="thread_search_input" placeholder="Search conversations by name" />
                            </div>
                        </div>
                    </div>
                    <div id="allThread">
                        <ul id="messages_ul" class="messages-list">
                            <div class="w-full mt-5 text-center">
                                <div class="spinner-grow spinner-grow-sm text-grey-600" role="status"></div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="message_content_container" class="flex-fill h-full">
        <div id="message_content_card" class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 h-full">
            <div id="drag_drop_overlay" class="drag_drop_overlay rounded text-center NS">
                <div class="h-full flex justify-center">
                    <div class="self-center h1">
                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded-full py-1 px-3 bg-gray-100-500 text-white hover:bg-gray-600"><i class="fas fa-cloud-upload-alt"></i> Drop files to upload</span>
                    </div>
                </div>
            </div>
            <div id="message_container" class="flex-auto p-6 px-0 pb-0 pt-3 bg-white">
                <div class="w-full mt-5 text-center">
                    <div class="spinner-grow spinner-grow-sm text-gray-600" role="status"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
@stop

