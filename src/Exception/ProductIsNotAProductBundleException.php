<?php
declare(strict_types=1);

/**
 * Created by solutionDrive GmbH.
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace SolutionDrive\SyliusProductBundlesPlugin\Exception;

use Sylius\Component\Core\Model\ProductInterface;
use Throwable;

class ProductIsNotAProductBundleException extends \RuntimeException
{
    /** @var ProductInterface */
    private $product;

    public function __construct(
        ProductInterface $product,
        string $message = '',
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->product = $product;
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }
}
