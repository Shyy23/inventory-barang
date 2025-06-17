<?php

namespace App\Observers;

use App\Models\Item;

class ItemObserver
{
    /**
     * Handle the Item "created" event.
     */
    public function created(Item $item)
    {
       // Set status saat item baru dibuat
       if ($item->item_type === 'consumable') {
        $item->status = $item->stock > 0 ? 'available' : 'out_of_stock';
        $item->saveQuietly();
    }
    }

    /**
     * Handle the Item "updated" event.
     */
    public function updated(Item $item)
    {
       // Periksa apakah item adalah consumable dan stock berubah
       if ($item->item_type === 'consumable' && $item->isDirty('stock')) {
        // Update status berdasarkan nilai stock
        $item->status = $item->stock > 0 ? 'available' : 'out_of_stock';
        $item->saveQuietly(); // Simpan tanpa memicu event lagi
    }
    }

    /**
     * Handle the Item "deleted" event.
     */
    public function deleted(Item $item)
    {
        //
    }

    /**
     * Handle the Item "restored" event.
     */
    public function restored(Item $item)
    {
        //
    }

    /**
     * Handle the Item "force deleted" event.
     */
    public function forceDeleted(Item $item)
    {
        //
    }
}
