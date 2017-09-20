<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;
use App\ReceiptLineItem;
use Auth;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');

        $receipt = Receipt::where('confirmed', 0)->first();
        $receipt_line_items = ReceiptLineItem::where('receipt_id', $receipt->id)->get();
        $receipt_image = asset('storage/' . $receipt->image);

        $data = [
            'receipt' => $receipt,
            'receipt_line_items' => $receipt_line_items,
            'receipt_image' => $receipt_image
        ];

        return view('receipt', $data);
    }

    public function saveReceipt(Request $request) {
    	$input = $request->all();

        $receipt = Receipt::find($input['receipt_id']);
        $receipt->name = $input['name'];
        $receipt->class = $input['class'];
        $receipt->date_time = $input['date'];
        $receipt->establishment = $input['establishment'];
        $receipt->currency = $input['currency'];
        $receipt->country = $input['country'];
        $receipt->language = $input['language'];
        $receipt->subtotal = $input['subtotal'];
        $receipt->tax = $input['tax'];
        $receipt->total = $input['total'];
        $receipt->cash = $input['cash'];
        $receipt->change = $input['change'];
        $receipt->save();

        foreach ($input['quantity'] as $key => $line_item) {
            if ($input['line_item_id'][$key] == 0) {
                $receipt_line_item = new ReceiptLineItem;
                $receipt_line_item->receipt_id = $input['receipt_id'];
                $receipt_line_item->qty = $input['quantity'][$key];
                $receipt_line_item->product = $input['description'][$key];
                $receipt_line_item->price = $input['price'][$key];
                $receipt_line_item->total = $input['lineTotal'][$key];
                $receipt_line_item->save();
            } else {
                $receipt_line_item = ReceiptLineItem::find($input['line_item_id'][$key]);
                $receipt_line_item->receipt_id = $input['receipt_id'];
                $receipt_line_item->qty = $input['quantity'][$key];
                $receipt_line_item->product = $input['description'][$key];
                $receipt_line_item->price = $input['price'][$key];
                $receipt_line_item->total = $input['lineTotal'][$key];
                $receipt_line_item->save();
            }
        }

        return redirect('/receipt')->with('message', 'Receipt successfully uploaded');
    }

    public function upload() {
    	return view('upload');
    }

    public function postUpload(Request $request) {
    	$input = $request->all();

    	$request->validate([
			'name' => 'required',
			'class' => 'required',
			'photo' => 'required|image'
		]);

		$path = $request->photo->store('images', 'public');

        $receipt = new Receipt;
        $receipt->name = $request->name;
        $receipt->image = $path;
        $receipt->class = $request->class;
        $receipt->save();

		return redirect('upload')->with('message', 'Receipt successfully uploaded');
    }

    public function bulkUpload() {
        return view('bulk-upload');
    }

    public function postBulkUpload(Request $request) {
        $input = $request->all();

        $request->validate([
            'photo' => 'required',
            'photo.*' => 'image'
        ]);

        foreach ($request->photo as $photo) {
            $path = $photo->store('images', 'public');

            $receipt = new Receipt;
            $receipt->image = $path;
            $receipt->save();
        }

        return redirect('/')->with('message', 'Receipt successfully uploaded');
    }
}
