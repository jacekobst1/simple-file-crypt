<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Services\ViewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MainController extends Controller
{
    public function index(ViewService $viewService): View
    {
        return $viewService->getIndex();
    }

    public function encrypt(
        FileService $fileService,
        Request $request
    ): StreamedResponse
    {
        return $fileService->encrypt($request->input(), $request->allFiles());
    }

    public function decrypt(
        FileService $fileService,
        Request $request
    ): StreamedResponse|RedirectResponse
    {
        return $fileService->decrypt($request->input(), $request->allFiles());
    }
}
