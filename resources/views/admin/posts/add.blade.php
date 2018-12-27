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

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-8" style="padding-bottom:120px">
                            <div class="form-group">
                                <label>Title</label>
                                <input id="title" type="text"
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                       value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea id="content2"
                                          class="form-control{{ $errors->has('content2') ? ' is-invalid' : '' }}"
                                          name="content2" rows="5">{{ old('content2') }}</textarea>

                                @if ($errors->has('content'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('content2') }}</strong>
                                                </span>
                                @endif
                            </div>


                        </div>
                        <div class="col-lg-4" style="padding-bottom:120px">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="selectpicker" name="category_id" data-style="select-with-transition"
                                        title="Choose Category" data-size="7">
                                    @foreach($list_categorys as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" value="" class="form-control tagsinput" data-role="tagsinput"
                                       name="tags[]" data-color="info">
                            </div>
                            <div class="form-group">
                                <label>Image(Ảnh đại diện)</label><br/>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="{{ asset('/public/admin/assets/img/image_placeholder.jpg') }}"
                                             alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                <span class="btn btn-rose btn-round btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input id="image" type="file"
                                           class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                           name="image"
                                           required/>
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

                            <button type="submit" class="btn btn-default">Post Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script src="{{ asset('/public/front/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('content2');
        })
    </script>
@endsection