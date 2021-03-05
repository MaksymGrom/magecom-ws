<?php

declare(strict_types=1);

namespace Project\ErpPrice\Test\Integration\Pricing\Price;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Pricing\Price\BasePrice;
use PHPUnit\Framework\TestCase;
use Magento\TestFramework\Helper\Bootstrap;
use Magento\Framework\ObjectManagerInterface;

class ErpPriceTest extends TestCase
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    protected function setUp(): void
    {
        $this->objectManager = Bootstrap::getObjectManager();
        $this->productRepository = $this->objectManager->get(ProductRepositoryInterface::class);
    }

    /**
     * @magentoDataFixture dataFixture
     */
    public function testPrice()
    {
        /** @var Product $product */
        $product = $this->productRepository->get('simple');
        $basePrice = $product->getPriceInfo()->getPrice(BasePrice::PRICE_CODE);

        $this->assertEquals(1., $basePrice->getValue());
    }

    public static function dataFixture()
    {
        require __DIR__ . '/../../_files/product_simple.php';
    }
}
