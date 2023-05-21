<?php

namespace App\Services\Telegram\DTO;

class FromDTO
{
    /**
     * @param int $id
     * @param string $firstName
     * @param string $languageCode
     * @param string|null $lastName
     * @param string|null $username
     */
    public function __construct(
        private readonly int $id,
        private readonly string  $firstName,
        private readonly string  $languageCode,
        private readonly ?string $lastName,
        private readonly ?string $username,
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }
}
