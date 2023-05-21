<?php

namespace App\Http\Controllers;

use App\Http\Request\Assembler\Telegram\TelegramRequestDTOAssembler;
use App\Http\Request\FormRequest\TelegramWebhookRequest;
use App\Services\Telegram\TelegramWebhookProcessingService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller;

class TelegramWebhookController extends Controller
{
    /**
     * @param TelegramWebhookRequest $request
     * @param TelegramRequestDTOAssembler $telegramRequestDTOAssembler
     * @param TelegramWebhookProcessingService $webhookProcessingService
     *
     * @return Response
     */
    public function webhook(
        TelegramWebhookRequest $request,
        TelegramRequestDTOAssembler $telegramRequestDTOAssembler,
        TelegramWebhookProcessingService $webhookProcessingService
    ): Response {
        Log::info('Telegram request', $request->all());
        try {
            $requestDTO = $telegramRequestDTOAssembler->create($request);
            $webhookProcessingService->process($requestDTO);
        } catch (\Throwable $throwable) {
            Log::critical($throwable->getMessage(), $throwable->getTrace());
        } finally {
            return response('ok');
        }
    }
}
