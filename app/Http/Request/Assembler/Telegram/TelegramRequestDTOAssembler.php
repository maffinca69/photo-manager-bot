<?php

namespace App\Http\Request\Assembler\Telegram;

use App\Http\Request\FormRequest\TelegramWebhookRequest;
use App\Services\Telegram\DTO\TelegramRequestDTO;

class TelegramRequestDTOAssembler
{
    /**
     * @param MessageDTOAssembler $messageDTOAssembler
     */
    public function __construct(
      private readonly MessageDTOAssembler $messageDTOAssembler,
    ) {
    }

    /***
     * @param TelegramWebhookRequest $request
     * @return TelegramRequestDTO
     */
    public function create(TelegramWebhookRequest $request): TelegramRequestDTO
    {
        $messageDTO = null;

        $message = $request->get('message');
        $channelPost = $request->get('channel_post');

        if (isset($message) || isset($channelPost)) {
            $messageDTO = $this->messageDTOAssembler->create($message ?? $channelPost);
        }

        return new TelegramRequestDTO(
            message: $messageDTO
        );
    }
}
