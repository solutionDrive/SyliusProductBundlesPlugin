<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Exception;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Throwable;

class SlotNotFoundException extends \RuntimeException
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ProductBundleInterface
     */
    private $bundle;

    public function __construct(
        string $slotName,
        ProductBundleInterface $bundle,
        string $message = '',
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->name = $slotName;
        $this->bundle = $bundle;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBundle(): ProductBundleInterface
    {
        return $this->bundle;
    }
}
