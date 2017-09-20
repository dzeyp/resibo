@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default m-2">
                <div class="panel-heading">Receipt</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <img class="zoom" src="{{ $receipt_image }}" alt="Receipt">
                        </div>
                        <div class="col-xs-12 col-sm-8">
                            <form id="receipt-form" method="post" action="">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $receipt->id }}" name="receipt_id">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-danger hidden2" role="alert">All fields are required</div>
                                    </div>
                                    @if (session('message'))
                                        <div class="col-xs-12">
                                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                                        </div>
                                    @endif
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                                            <label class="control-label" for="name">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $receipt->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="class">Class</label>
                                            <select class="form-control" name="class">
                                                <option value="A" @if ($receipt->class == 'A') selected @endif>A</option>
                                                <option value="B" @if ($receipt->class == 'B') selected @endif>B</option>
                                                <option value="C" @if ($receipt->class == 'C') selected @endif>C</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Date and Time</label>
                                            <input type="text" class="form-control" name="date" value="{{ $receipt->date_time }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Establishment</label>
                                            <input type="text" class="form-control" name="establishment" value="{{ $receipt->establishment }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Currency</label>
                                            <input type="text" class="form-control" name="currency" value="{{ $receipt->currency }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Country</label>
                                            <input type="text" class="form-control" name="country" value="{{ $receipt->country }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Language</label>
                                            <input type="text" class="form-control" name="language" value="{{ $receipt->language }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Subtotal</label>
                                            <input type="text" class="form-control" name="subtotal" value="{{ $receipt->subtotal }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Tax</label>
                                            <input type="text" class="form-control" name="tax" value="{{ $receipt->tax }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Total</label>
                                            <input type="text" class="form-control" name="total" value="{{ $receipt->total }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Cash</label>
                                            <input type="text" class="form-control" name="cash" value="{{ $receipt->cash }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Change</label>
                                            <input type="text" class="form-control" name="change" value="{{ $receipt->change }}" required>
                                        </div>
                                    </div>

                                    <div class="line-items">
                                        @if ($receipt_line_items->isNotEmpty())
                                            @foreach ($receipt_line_items as $key => $line_item)
                                                <input type="hidden" value="{{ $line_item->id }}" name="line_item_id[]">
                                                <div class="col-xs-6 col-md-2">
                                                    <div class="form-group">
                                                        @if ($key == 0) <label for="name">Quantity</label> @endif
                                                        <input type="text" class="form-control" name="quantity[]" value="{{ $line_item->qty }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-md-6">
                                                    <div class="form-group">
                                                        @if ($key == 0) <label for="name">Description</label> @endif
                                                        <input type="text" class="form-control" name="description[]" value="{{ $line_item->product }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-md-2">
                                                    <div class="form-group">
                                                        @if ($key == 0) <label for="name">Price</label> @endif
                                                        <input type="text" class="form-control" name="price[]" value="{{ $line_item->price }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-md-2">
                                                    <div class="form-group">
                                                        @if ($key == 0) <label for="name">Line Total</label> @endif
                                                        <input type="text" class="form-control" name="lineTotal[]" value="{{ $line_item->total }}" required>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <input type="hidden" value="0" name="line_item_id[]">
                                            <div class="col-xs-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="name">Quantity</label>
                                                    <input type="text" class="form-control" name="quantity[]" value="{{ $receipt->aaaaaa }}" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Description</label>
                                                    <input type="text" class="form-control" name="description[]" value="{{ $receipt->aaaaaa }}" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="name">Price</label>
                                                    <input type="text" class="form-control" name="price[]" value="{{ $receipt->aaaaaa }}" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="name">Line Total</label>
                                                    <input type="text" class="form-control" name="lineTotal[]" value="{{ $receipt->aaaaaa }}" required>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success btn-xs add-line-item">Add Line Item</button>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group pull-right">
                                            <button type="button" class="btn btn-primary btn-lg submit-receipt">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
