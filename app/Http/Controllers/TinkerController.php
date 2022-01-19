<?php

namespace App\Http\Controllers;

use App\Jobs\NotifyActorOfANewFan;
use App\Models\Fan;
use Illuminate\Http\Request;

class TinkerController extends Controller
{
    public function tinker(Request $request)
    {
        NotifyActorOfANewFan::dispatch(Fan::first());
    }

    public function phpinfo()
    {
        phpinfo();
    }
}
