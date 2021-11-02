<?php

namespace App\Observers;

use App\Models\ExpenseProduct;

class ExpenseProductObserver
{
    /**
     * Handle the ExpenseProduct "created" event.
     *
     * @param  \App\Models\ExpenseProduct  $expenseProduct
     * @return void
     */
    public function created(ExpenseProduct $expenseProduct)
    {
        //
    }

    /**
     * Handle the ExpenseProduct "updated" event.
     *
     * @param  \App\Models\ExpenseProduct  $expenseProduct
     * @return void
     */
    public function updating(ExpenseProduct $expenseProduct)
    {
        // dump('Updating');
        // dump($expenseProduct);
    }

    public function updated(ExpenseProduct $expenseProduct)
    {
        // dump('updated');
        // dump($expenseProduct);
    }

    /**
     * Handle the ExpenseProduct "deleted" event.
     *
     * @param  \App\Models\ExpenseProduct  $expenseProduct
     * @return void
     */
    public function deleted(ExpenseProduct $expenseProduct)
    {
        //
    }

    /**
     * Handle the ExpenseProduct "restored" event.
     *
     * @param  \App\Models\ExpenseProduct  $expenseProduct
     * @return void
     */
    public function restored(ExpenseProduct $expenseProduct)
    {
        //
    }

    /**
     * Handle the ExpenseProduct "force deleted" event.
     *
     * @param  \App\Models\ExpenseProduct  $expenseProduct
     * @return void
     */
    public function forceDeleted(ExpenseProduct $expenseProduct)
    {
        //
    }
}
