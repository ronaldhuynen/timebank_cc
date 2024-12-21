<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class UpdateMessageSettingsForm extends Component
{
    public bool $systemMessage;
    public bool $paymentReceived;
    public bool $localNewsletter;
    public bool $generalNewsletter;
    public bool $personalChat;
    public bool $groupChat;
    public int $chatUnreadDelay;

    protected $rules = [
        'systemMessage' => 'boolean',
        'paymentReceived' => 'boolean',
        'localNewsletter' => 'boolean',
        'generalNewsletter' => 'boolean',
        'personalChat' => 'boolean',
        'groupChat' => 'boolean',
        'chatUnreadDelay' => 'integer|min:0|max:99'  // 168 hours is one week
        ];


    public function mount()
    {
        $profile = session('activeProfileType')::find(session('activeProfileId'));


        // Load current settings or create default
        $settings = $profile->message_settings()->first();

        if (!$settings) {
            // Create default settings
            $settings = $profile->message_settings()->create([
                'system_message' => true,
                'payment_received' => true,
                'local_newsletter' => true,
                'general_newsletter' => true,
                'personal_chat' => true,
                'group_chat' => true,
                'chat_unread_delay' => config('timebank-cc.messenger.default_unread_mail_delay')
            ]);
        }

        $this->systemMessage = $settings->system_message;
        $this->paymentReceived = $settings->payment_received;
        $this->localNewsletter = $settings->local_newsletter;
        $this->generalNewsletter = $settings->general_newsletter;
        $this->personalChat = $settings->personal_chat;
        $this->groupChat = $settings->group_chat;
        $this->chatUnreadDelay = $settings->chat_unread_delay;
    }


    public function updateMessageSettings()
    {
        $this->validate();

        $profile = session('activeProfileType')::find(session('activeProfileId'));

        $profile->message_settings()->updateOrCreate(
            [],
            [
                'system_message' => $this->systemMessage,
                'payment_received' => $this->paymentReceived,
                'local_newsletter' => $this->localNewsletter,
                'general_newsletter' => $this->generalNewsletter,
                'personal_chat' => $this->personalChat,
                'group_chat' => $this->groupChat,
                'chat_unread_delay' => $this->chatUnreadDelay,
            ]
        );


        $this->dispatch('saved');

    }


    
    public function render()
    {
        return view('livewire.profile.update-message-settings-form');
    }
}
