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
                        <div class="col-lg-6">
                            @csrf
                            <div class="form-group">
                                <label>Menu name</label>
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="parents">Choose Parent</label>
                                <select class="selectpicker" data-size="7" name="parents"
                                        data-style="btn btn-success" title="Choose Parent">
                                    @foreach($list_parents as $parent)
                                        {!! $parent !!}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="has_child">Has child?</label>
                                <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">check</i>
                                                </span>
                                    <div class="radio{{ $errors->has('has_child') ? ' is-invalid' : '' }}">
                                        <label>
                                            <input type="radio" name="has_child" value="1" checked>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="radio{{ $errors->has('has_child') ? ' is-invalid' : '' }}">
                                        <label>
                                            <input type="radio" name="has_child" value="0">
                                            No
                                        </label>
                                    </div>
                                    @if ($errors->has('has_child'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('has_child') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Order</label>
                                <input title="order" id="order" type="text"
                                       class="form-control{{ $errors->has('order') ? ' is-invalid' : '' }}" name="order"
                                       value="{{ old('order') }}" required autofocus>

                                @if ($errors->has('order'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('order') }}</strong>
                                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Icon</label>
                                <input title="css_icon" id="css_icon" type="text"
                                       class="form-control{{ $errors->has('css_icon') ? ' is-invalid' : '' }}"
                                       name="css_icon"
                                       value="{{ old('css_icon') }}">

                                @if ($errors->has('css_icon'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('css_icon') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <select class="selectpicker{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                        data-size="2" name="location"
                                        data-style="btn btn-success" title="Choose location">
                                    <option value="backend">Backend</option>
                                    <option value="frontend">Frontend</option>
                                </select>
                                @if ($errors->has('location'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="menu_type">Type</label>
                                <select class="selectpicker{{ $errors->has('menu_type') ? ' is-invalid' : '' }}"
                                        data-size="2" name="menu_type"
                                        data-style="btn btn-success" title="Choose type">
                                    <option value="Link">Link</option>
                                    <option value="Route">Route</option>
                                </select>
                                @if ($errors->has('menu_type'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('menu_type') }}</strong>
                                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Value</label>
                                <input title="menu_value" id="menu_value" type="text"
                                       class="form-control{{ $errors->has('menu_value') ? ' is-invalid' : '' }}"
                                       name="menu_value"
                                       value="{{ old('menu_value') }}" required autofocus>

                                @if ($errors->has('menu_value'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('menu_value') }}</strong>
                                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Menu ID</label>
                                <input title="menu_acl" id="menu_acl" placeholder="ex: menu" type="text"
                                       class="form-control{{ $errors->has('menu_acl') ? ' is-invalid' : '' }}"
                                       name="menu_acl"
                                       value="{{ old('menu_acl') }}">

                                @if ($errors->has('menu_acl'))
                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('menu_acl') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success">Menu Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>
@stop