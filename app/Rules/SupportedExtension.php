<?php

declare(strict_types = 1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

/**
 * Class SupportedExtension
 *
 * @package App\Rules
 */
class SupportedExtension implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return in_array(
            $value->getClientOriginalExtension(),
            array_merge(
                config('converter.allowed_extensions.image'),
                config('converter.allowed_extensions.text'),
                config('converter.allowed_extensions.html')
            )
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return ':attribute ' . Lang::trans('file.convert.messages.unsupported_extension');
    }
}
