@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
            <div class="panel panel-default m-2">
                <div class="panel-heading">Receipt Upload</div>

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
                                    <input type="file" class="form-control" name="photo">
                                    @if ($errors->has('photo'))
                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                    <label class="control-label" for="name">Name</label>
                                    <input type="text" class="form-control" name="name">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group @if ($errors->has('class')) has-error @endif">
                                    <label for="class">Class</label>
                                    <select class="form-control" name="class">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                    @if ($errors->has('class'))
                                        <span class="text-danger">{{ $errors->first('class') }}</span>
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
