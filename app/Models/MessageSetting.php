<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_settingable_id',
        'message_settingable_type',
        'system_message',
        'payment_received',
        'local_newsletter',
        'general_newsletter',
        'personal_chat',
        'group_chat',
    ];


    /**
     * Get the parent message_settingable model (user, organization, or bank).
     * This is the instance (bank, organization, admin / alternative profile)  where the settings are originally applied for.
     * one-to-many polymorphic
     */
    public function message_settingable()
    {
        return $this->morphTo();
    }
}
