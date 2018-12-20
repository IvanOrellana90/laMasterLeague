<?php

namespace App\Achievements;

use App\Notifications\NewBetAchievement;
use Gstt\Achievements\Achievement;

class UserMadeABet extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primera Apuesta";

    /*
     * A small description for the achievement
     */
    public $description = "Felicitaciones! Realizaste tu primera apuesta!";

    public function whenUnlocked($progress)
    {
        auth()->user()->notify(new NewBetAchievement($this->description));
    }
}
