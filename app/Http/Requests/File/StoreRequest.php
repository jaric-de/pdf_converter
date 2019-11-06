<?php

declare(strict_types = 1);

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SupportedExtension;

/**
 * Class StoreFile
 *
 * @package App\Http\Requests\File
 */
class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'attachments'   => ['required', 'array'],
            'attachments.*' => [
                'file',
                'mimetypes:text/html,image/jpeg,image/gif,image/png,image/svg+xml,text/plain',
                'max:1000',
                new SupportedExtension
            ],
        ];
    }
}
