<?php

namespace App\Http\Controllers;

use App\Services\CryptService;
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
        CryptService $cryptService,
        Request $request
    ): StreamedResponse
    {
        return response()->streamDownload(
            function() use($cryptService, $request) {
                echo $cryptService->encryptFile($request->allFiles());
            },
            $request->file('file')->getClientOriginalName() . '_encrypted'
        );
    }

    public function decrypt(
        CryptService $cryptService,
        Request $request
    ): StreamedResponse|RedirectResponse
    {
        return response()->streamDownload(
            function() use($cryptService, $request) {
                echo $cryptService->decryptFile($request->allFiles());
            },
            $request->file('file')->getClientOriginalName() . '_decrypted'
        );
    }
}
