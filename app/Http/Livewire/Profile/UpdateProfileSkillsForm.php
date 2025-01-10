<?php

namespace App\Http\Livewire\Profile;

use App\Http\Livewire\Dashboard\SkillsCardFull;


/**
 * Class UpdateProfileSkillsForm
 *
 * This class extends the SkillsCardFull class and is responsible for rendering
 * the update profile skills form view in the Livewire component.
 *
 * @package App\Http\Livewire\Profile
 */
class UpdateProfileSkillsForm extends SkillsCardFull
{
    public function render()
    {
        return view('livewire.profile.update-profile-skills-form');
    }
}
