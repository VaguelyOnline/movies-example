<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFanRequest;
use App\Models\Fan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FanController extends Controller
{
    public function store(StoreFanRequest $request)
    {
        // store the Fan model in the DB...
        return Auth::user()
            ->fans()
            ->create($request->validated());
    }
}
