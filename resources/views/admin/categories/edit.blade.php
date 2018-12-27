@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">{{ $_title }}</h4>
                    <div class="toolbar">

                    </div>
                    <div class="clearfix"></div>
                    @if ($errors->has('errors'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('errors') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('success'))
                        <div class="alert alert-success">
                            <ul>
                                @foreach ($errors->get('success') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('warnings'))
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->get('warnings') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Category name</label>
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="@isset($request->name){{ $request->name }}@else{{ $objItem->name }}@endisset" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="description"
                                          class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                          name="description" rows="5">@isset($request->description){{ $request->description }}@else{{ $objItem->description }}@endisset</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Image</label><br/>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="@if($objItem->image==null){{ asset('/public/admin/assets/img/image_placeholder.jpg') }}@else{{ asset('/public/front/images/categories/'.$objItem->image) }}@endif" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                <span class="btn btn-rose btn-round btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input id="image" type="file"
                                           class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image"
                                           />
                                </span>
                                        <a href="#" class="btn btn-danger btn-round fileinput-exists"
                                           data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-default">Category Update</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop