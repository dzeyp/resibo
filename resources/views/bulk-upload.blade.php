@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
            <div class="panel panel-default m-2">
                <div class="panel-heading">Receipt Bulk Upload</div>

                <div class="panel-body">
                    <form id="receipt-upload-form" method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            @if (session('message'))
                                <div class="col-xs-12">
                                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                                </div>
                            @endif
                            <div class="col-xs-12">
                                <div class="form-group @if ($errors->has('photo')) has-error @endif">
                                    <label for="photo">Image</label>
                                    <input type="file" class="form-control" name="photo[]" multiple>
                                    @if ($errors->has('photo'))
                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                    @endif
                                    @if ($errors->has('photo.*'))
                                    	@foreach ($errors->all() as $message)
										    <span class="text-danger">{{ $message }}</span>
										@endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary btn-lg submit-receipt">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
