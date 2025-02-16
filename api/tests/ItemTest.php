<?php
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testItemCreation()
    {
        $item = new Item('Test Item', 10);
        $this->assertEquals('Test Item', $item->getName());
        $this->assertEquals(10, $item->getPrice());
    }

    public function testItemPriceUpdate()
    {
        $item = new Item('Test Item', 10);
        $item->setPrice(15);
        $this->assertEquals(15, $item->getPrice());
    }
}