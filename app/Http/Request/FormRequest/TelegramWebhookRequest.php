<?php

namespace App\Http\Request\FormRequest;

class TelegramWebhookRequest extends SimpleRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'update_id' => ['required', 'int']
        ];
    }
}
