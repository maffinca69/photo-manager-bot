<?php

namespace App\Infrastructure\Telegram\Client\Request;

use App\Infrastructure\Telegram\Client\ApiMethodDictionary;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class GetFileRequest extends AbstractRequest
{
    private const ENDPOINT = ApiMethodDictionary::GET_FILE;

    private const METHOD = HttpRequest::METHOD_GET;

    /**
     * @param string $fileId
     */
    public function __construct(string $fileId)
    {
        $params = [
            'file_id' => $fileId
        ];

        parent::__construct(self::ENDPOINT, self::METHOD, $params);
    }
}
