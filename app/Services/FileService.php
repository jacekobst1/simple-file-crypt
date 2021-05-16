<?php

namespace App\Services;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileService
{
    public function encrypt(array $files): StreamedResponse
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

        return response()->streamDownload(
            fn() => $this->echoText($encryptedText),
            'encrypted_file'
        );
    }

    public function decrypt(array $files): StreamedResponse|RedirectResponse
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


        return response()->streamDownload(
            fn() => $this->echoText($decryptedText),
            'decrypted_file'
        );
    }

    private function echoText(string $text): void
    {
        echo $text;
    }
}
