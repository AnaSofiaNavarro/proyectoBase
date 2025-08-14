<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $response = Http::asForm()

            ->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('NOCAPTCHA_SECRET'),
                'response' => $value,
            ]);
    }

    public function message()
    {
        return 'Falló la validación del captcha, por favor intenta nuevamente.';
    }
}