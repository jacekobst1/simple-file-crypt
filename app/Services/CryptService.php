<?php

namespace App\Services;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CryptService
{
    public function encryptFile(array $files): string|RedirectResponse
    {
        Validator::make($files, [
            'file' => 'required|mimes:txt',
        ])->validate();

        try {
            $encryptedText = encrypt($files['file']->getContent());
        } catch(Exception $exception) {
            throw ValidationException::withMessages([
                'file' => 'Something wrong happened. Make sure that file is valid and try again.',
            ]);
        }

        return $encryptedText;
    }

    public function decryptFile(array $files): string|RedirectResponse
    {
        Validator::make($files, [
            'file' => 'required|mimes:txt',
        ])->validate();

        try {
            $decryptedText = decrypt($files['file']->getContent());
        } catch(Exception $exception) {
            throw ValidationException::withMessages([
                'file' => 'Something wrong happened. Make sure that file is valid and try again.',
            ]);
        }

        return $decryptedText;
    }
}
