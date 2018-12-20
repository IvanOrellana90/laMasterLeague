<?php

namespace App\Achievements;

use App\Notifications\NewArchievement;
use Gstt\Achievements\Achievement;

class SpecialEvent1 extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "SpecialEvent1";

    /*
     * A small description for the achievement
     */
    public $description = "Felicitaciones! Ganaste un evento especial!";
    public $avatar = "Franco Baresi";

    public function whenUnlocked($progress)
    {
        auth()->user()->notify(new NewArchievement($this->description, $this->avatar));
    }
}
