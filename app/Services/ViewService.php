<?php

namespace App\Services;

use Illuminate\Contracts\View\View;

class ViewService
{
    public function getIndex(): View
    {
        return view('index');
    }
}
