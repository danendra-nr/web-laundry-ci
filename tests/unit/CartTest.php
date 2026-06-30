<?php

use CodeIgniter\Test\CIUnitTestCase;
use App\Libraries\Cart;

/**
 * @internal
 */
final class CartTest extends CIUnitTestCase
{
    protected $cart;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cart = new Cart();
        $this->cart->destroy(); // Start clean
    }

    protected function tearDown(): void
    {
        $this->cart->destroy();
        parent::tearDown();
    }

    public function testInsertAndContents(): void
    {
        $item = [
            'id' => 1,
            'name' => 'Cuci Kering',
            'price' => 6000.0,
            'qty' => 2
        ];

        $rowid = $this->cart->insert($item);
        $this->assertIsString($rowid);

        $contents = $this->cart->contents();
        $this->assertCount(1, $contents);
        $this->assertSame('Cuci Kering', $contents[0]['name']);
        $this->assertEquals(2, $contents[0]['qty']);
        $this->assertEquals(12000.0, $this->cart->total());
    }

    public function testUpdateQty(): void
    {
        $item = [
            'id' => 2,
            'name' => 'Cuci Setrika',
            'price' => 8000.0,
            'qty' => 1
        ];

        $rowid = $this->cart->insert($item);
        $this->cart->update($rowid, 3);

        $contents = $this->cart->contents();
        $this->assertEquals(3, $contents[0]['qty']);
        $this->assertEquals(24000.0, $this->cart->total());
    }

    public function testRemoveItem(): void
    {
        $item = [
            'id' => 3,
            'name' => 'Setrika Saja',
            'price' => 4000.0,
            'qty' => 1
        ];

        $rowid = $this->cart->insert($item);
        $this->cart->remove($rowid);

        $this->assertCount(0, $this->cart->contents());
        $this->assertEquals(0, $this->cart->total());
    }

    public function testTimbangDiTokoExcludesFromTotal(): void
    {
        $item1 = [
            'id' => 4,
            'name' => 'Cuci Lipat',
            'price' => 5000.0,
            'qty' => 3
        ];
        $item2 = [
            'id' => 5,
            'name' => 'Cuci Karpet',
            'price' => 15000.0,
            'qty' => 1,
            'options' => [
                'timbang_di_toko' => true
            ]
        ];

        $this->cart->insert($item1);
        $this->cart->insert($item2);

        $this->assertEquals(15000.0, $this->cart->total());
    }
}
