<?php

namespace App\Containers\Welcome\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Messagebus\Data\Transporters\ProcessBookingFollowMessageTransporter;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends WebController
{

    /**
     * @return  string
     */
    public function sayWelcome()
    {
        // No actions to call. Since there's nothing to do but returning a response.
        return view('welcome::welcome-page');
    }
}
