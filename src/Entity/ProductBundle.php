<?php

declare(strict_types=1);

namespace SolutionDrive\SyliusProductBundlesPlugin\Entity;

use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductBundle implements ProductBundleInterface, ResourceInterface, CodeAwareInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $code;

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
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }
}
