<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReceiptController extends Controller
{
    public function addReceipt(Request $request)
    {
        $incomingDATA = $request->validate([
            'title' => ['required', Rule::unique('receipts', 'title')],
            'description' => 'required',
            'Ingredients' => 'required',
            'category_id' => 'required'
        ]);

        $incomingDATA['user_id'] = auth()->id();
        Receipt::create($incomingDATA);
        return redirect('/receipt');
    }

    public function editReceipt(Receipt $receipt)
    {
        return view('editReceipt', [
            'rtp' => $receipt
        ]);
    }

    public function actuallyEditReceipt(Receipt $receipt, Request $request)
    {
        $incomingDATA = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'Ingredients' => 'required',
        ]);

        $receipt->update($incomingDATA);
        return redirect('/receipt');
    }

    public function deleteReceipt(Receipt $receipt)
    {
        $receipt->delete();
        return redirect('/receipt');
    }
}

