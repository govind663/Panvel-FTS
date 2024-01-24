<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Attribute\Cache;

class UserController extends Controller
{
    /**
     * Show user online status.
     */
    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Carbon::now()->diffInSeconds(Carbon::parse($user->last->refresh())) < 60) {
                echo 'User: '. $user->name .' is Online';
            } else {
                echo 'User: '. $user->name .' is Offline';
            };
            echo '<br>';
        }
            // if (Cache::has('user-is-online-' . $user->id))
            //     echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            // else
            //     echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";

    }
}
