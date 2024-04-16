<?php

namespace App\Http\Controllers;

use App\Models\Status;

class StatusesController extends Controller
{
    public function store(): void
    {
        Status::create(['body' => request('body')]);
    }
}
