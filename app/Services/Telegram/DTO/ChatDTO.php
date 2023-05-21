<?php

namespace App\Services\Telegram\DTO;

class ChatDTO
{
    /**
     * @param int $id
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $username
     * @param string|null $type
     * @param string|null $title
     */
    public function __construct(
        private readonly int $id,
        private readonly ?string $firstName = null,
        private readonly ?string $lastName = null,
        private readonly ?string $username = null,
        private readonly ?string $type = null,
        private readonly ?string $title = null,
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
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
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

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }
}
