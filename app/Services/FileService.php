<?php

namespace App\Services;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileService
{
    public function encrypt(array $input, array $files): StreamedResponse
    {
        $this->validate($input, $files);

        try {
            $encryptedText = encrypt($files['file']->getContent());
        } catch(Exception $exception) {
            throw ValidationException::withMessages([
                'file' => 'Something wrong happened. Make sure that file is valid and try again.',
            ]);
        }

        return response()->streamDownload(
            fn() => $this->echoText($encryptedText),
            Arr::get($input, 'name') ?? 'encrypted_file'
        );
    }

    public function decrypt(array $input, array $files): StreamedResponse|RedirectResponse
    {
        $this->validate($input, $files);

        try {
            $decryptedText = decrypt($files['file']->getContent());
        } catch(Exception $exception) {
            throw ValidationException::withMessages([
                'file' => 'Something wrong happened. Make sure that file is valid and try again.',
            ]);
        }


        return response()->streamDownload(
            fn() => $this->echoText($decryptedText),
            Arr::get($input, 'name') ?? 'decrypted_file'
        );
    }

    private function echoText(string $text): void
    {
        echo $text;
    }

    private function validate(array $input, array $files): void
    {
        Validator::make($files, [
            'file' => 'required|mimes:txt',
        ])->validate();

        Validator::make($input, [
            'name' => 'string|nullable',
        ])->validate();
    }
}
