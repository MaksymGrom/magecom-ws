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
        $this->productRepository = $this->objectManager->create(ProductRepositoryInterface::class);
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoDataFixture dataFixture
     */
    public function testPriceModuleDisabled()
    {
        /** @var Product $product */
        $product = $this->productRepository->get('simple');
        $basePrice = $product->getPriceInfo()->getPrice(BasePrice::PRICE_CODE);

        $this->assertEquals(100., $basePrice->getValue());
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoDataFixture dataFixture
     * @magentoConfigFixture project/erp_price/enabled 1
     */
    public function testPriceModuleEnabled()
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
