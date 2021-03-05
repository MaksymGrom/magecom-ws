<?php

declare(strict_types=1);

namespace Project\ErpPrice\Test\Integration\Model;

use PHPUnit\Framework\TestCase;
use Magento\TestFramework\Helper\Bootstrap;
use Magento\Framework\ObjectManagerInterface;
use Project\ErpPrice\Model\ErpPriceConfig;

class ConfigTest extends TestCase
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var ErpPriceConfig
     */
    private $erpPriceConfig;

    protected function setUp(): void
    {
        $this->objectManager = Bootstrap::getObjectManager();
        $this->erpPriceConfig = $this->objectManager->get(ErpPriceConfig::class);
    }

    public function testDefaultEnabledValue()
    {
        $this->assertFalse($this->erpPriceConfig->isEnabled());
    }

    /**
     * @magentoConfigFixture project/erp_price/enabled 0
     */
    public function testOffEnabledValue()
    {
        $this->assertFalse($this->erpPriceConfig->isEnabled());
    }

    /**
     * @magentoConfigFixture project/erp_price/enabled 1
     */
    public function testOnEnabledValue()
    {
        $this->assertTrue($this->erpPriceConfig->isEnabled());
    }
}
