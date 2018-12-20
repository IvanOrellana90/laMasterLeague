<?php

namespace App\Achievements;

use App\Notifications\NewTopicAchievement;
use Gstt\Achievements\Achievement;

class UserCreateNewTopic extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primer Tema";

    /*
     * A small description for the achievement
     */
    public $description = "Felicitaciones! Creaste tu primer tema!";

    public function whenUnlocked($progress)
    {
        auth()->user()->notify(new NewTopicAchievement($this->description));
    }
}
