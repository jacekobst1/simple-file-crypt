<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Services\ViewService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function index(ViewService $viewService): View
    {
        return $viewService->getIndex();
    }

    public function encrypt(
        FileService $fileService,
        ViewService $viewService,
        Request $request
    ): View
    {
        return $fileService->encrypt($request->all());
    }
}
