<?php

namespace App\Services;

use Illuminate\Contracts\View\View;

class FileService
{
    public function encrypt(array $data): View
    {
        return view('index');
    }

    public function decrypt(array $data): View
    {
        return view('index');
    }
}
