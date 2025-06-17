<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\ItemUnit;

class ItemUnitObserver
{
    /**
     * Handle the ItemUnit "created" event.
     */
    public function created(ItemUnit $itemUnit)
    {
        $this->updateItemStatus($itemUnit->item_id);
    }
    /**
     * Handle the ItemUnit "updated" event.
     */
    public function updated(ItemUnit $itemUnit)
    {
        $this->updateItemStatus($itemUnit->item_id);
    }

    /**
     * Handle the ItemUnit "deleted" event.
     */
    public function deleted(ItemUnit $itemUnit)
    {
        $this->updateItemStatus($itemUnit->item_id);
    }

    /**
     * Handle the ItemUnit "restored" event.
     */
    public function restored(ItemUnit $itemUnit)
    {
        //
    }

    /**
     * Handle the ItemUnit "force deleted" event.
     */
    public function forceDeleted(ItemUnit $itemUnit)
    {
        //
    }
    protected function updateItemStatus($itemId)
    {
        // Hitung jumlah unit yang tersedia
        $availableUnits = ItemUnit::where('item_id', $itemId)
            ->where('unit_status', 'available')
            ->count();

        // Update status di tabel items
        Item::where('item_id', $itemId)->update([
            'status' => $availableUnits > 0 ? 'available' : 'out_of_stock',
        ]);
    }
}
