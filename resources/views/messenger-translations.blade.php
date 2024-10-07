{{-- 
    RTIPPIN MESSENGER-UI TRANSLATION KEYS
 
    This file contains the JavaScript code that sets the window.translations object 
    with the translation keys and their corresponding Laravel translations.

    Most of the customizations and translations are defined in:
    vendor/rtippin/messenger-ui/resources/js/templates/ThreadTemplates.js 
    And should be compiled / included in: vendor/rtippin/messenger-ui/public/app.js

    After compilation this app.js file should be published with this command:
    php artisan vendor:publish --tag=messenger-ui.assets --force
    
    Then all Js assets should also be re-compiled when changes are made: 
    npm run dev 
--}}


    <script>
        window.translations = {
            close: "{{ __('Close') }}",
            searchProfiles: "{{ __('Search profiles') }}",
            searchAboveForProfiles: "{{ __('Search above other Timebankers') }}",
            createGroup: "{{ __('Create a group') }}",
            nameGroupConversation: "{{ __('Name the group conversation') }}",
            required3to50Characters: "{{ __('Required / 3 - 50 characters') }}",
            create: "{{ __('Create') }}",
            friends: "{{ __('Friends') }}",
            friendsSince: "{{ __('Friends since') }}",
            showingNoFriends: "{{ __('Showing 0 to 0 of 0 friends') }}",
            noFriendsToAdd: "{{ __('No friends to add') }}",
            noFriendsToShow: "{{ __('No friends here yet') }}",
            noFriendsFound: "{{ __('No friends found') }}",
            noMatchingFriendsFound: "{{ __('No matching friends found') }}",
            name: "{{ __('Name') }}",
            messengerSettings: "{{ __('Messenger settings') }}",
            clickToSendOrEnter: "{{ __('Click to send or press enter') }}",
            connectionErrorMessagesDelayed: "{{ __('Connection error, messages may be delayed') }}",
            connectionError: "{{ __('Connection Error') }}",
            sentAnImage: "{{ __('sent an image') }}",
            sentAFile: "{{ __('sent a file') }}",
            sentAnAudio: "{{ __('sent an audio file') }}",
            sentAVideo: "{{ __('sent a video') }}",
            fewSecAgo: "{{ __('a few seconds ago') }}",
            sending: "{{ __('Sending') }}",
            noReactions: "{{ __('No reactions') }}",
            remove: "{{ __('Verwijderen') }}",
            removeFriend: "{{ __('Remove friend') }}",
            cancelFriendRequest: "{{ __('Cancel friend request') }}",
        };
        window.appName = "{{ env('APP_NAME') }}";
    </script>