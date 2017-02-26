<?php

namespace App\Http\Controllers;

use App\Events\UserOnline;
use App\User;
use Illuminate\Http\Request;

class UserOnlineController extends Controller
{
    public function __invoke(User $user)
    {
    	$user->status = 'online';
    	$user->save();

    	broadcast(new UserOnline($user));
    }
}
