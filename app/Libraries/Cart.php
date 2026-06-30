<?php

namespace App\Libraries;

use CodeIgniterCart\Cart as BaseCart;

class Cart
{
    protected $baseCart;

    public function __construct()
    {
        $this->baseCart = new BaseCart();
    }

    /**
     * Menambahkan item ke keranjang belanja
     */
    public function insert(array $item)
    {
        $result = $this->baseCart->insert($item);
        if ($result === false) {
            return false;
        }

        if (isset($item['options']) && count($item['options']) > 0) {
            return md5($item['id'] . serialize($item['options']));
        }
        return md5($item['id']);
    }

    /**
     * Mengubah quantity barang/layanan
     */
    public function update($rowid, $qty = null): bool
    {
        if (is_array($rowid)) {
            return $this->baseCart->update($rowid);
        }
        return $this->baseCart->update([
            'rowid' => $rowid,
            'qty'   => $qty
        ]);
    }

    /**
     * Menghapus item dari cart
     */
    public function remove(string $rowid): bool
    {
        return $this->baseCart->remove($rowid);
    }

    /**
     * Menhitung total
     */
    public function total()
    {
        $total = 0.0;
        foreach ($this->contents() as $item) {
            if (isset($item['options']['timbang_di_toko']) && $item['options']['timbang_di_toko'] === true) {
                continue;
            }
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }

    /**
     * Mengosongkan keranjang belanja
     */
    public function destroy(): void
    {
        $this->baseCart->destroy();
    }

    /**
     * Mengambil isi keranjang belanja
     */
    public function contents(): array
    {
        return array_values($this->baseCart->contents());
    }

    /**
     * Menghitung total item di keranjang
     */
    public function totalItems()
    {
        return $this->baseCart->totalItems();
    }
}
