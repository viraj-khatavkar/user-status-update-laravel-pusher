<?php

namespace App\Http\Controllers;

use App\Events\UserOffline;
use App\User;
use Illuminate\Http\Request;

class UserOfflineController extends Controller
{
    public function __invoke(User $user)
    {
    	$user->status = 'offline';
    	$user->save();

    	broadcast(new UserOffline($user));
    }
}
