<?php

namespace App\Achievements;

use App\Notifications\NewGroupAchievement;
use Gstt\Achievements\Achievement;

class UserCreateNewGroup extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primer Grupo";

    /*
     * A small description for the achievement
     */
    public $description = "Felicitaciones! Creaste tu primer grupo!";

    public function whenUnlocked($progress)
    {
        auth()->user()->notify(new NewGroupAchievement($this->description));
    }
}
