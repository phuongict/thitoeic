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
                        <form action="" method="get">
                            <div class="col-sm-3">
                                <input type="text" name="search_id" class="form-control"
                                       placeholder="Item id..."/>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="search_name" class="form-control"
                                       placeholder="Item name..."/>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-default">Search</button>
                            </div>

                            <div class="col-sm-4 text-right">
                                <a class="btn btn-rose" href="{{ Route('route_admin_menu_add') }}"><i class="fa fa-plus"></i> Add new</a>
                                <a href="{{ route('route_admin_menu_index') }}" class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>

                            </div>
                        </form>
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
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



                    @if(count($list)<=0)
                        <p class="alert alert-warning">Không có dữ liệu!</p>
                    @endif
                    <div class="card-content table-responsive table-full-width">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <a href="{{ Request::fullUrlWithQuery(['ord' => 'id','ordval'=>$new_ordval])}}">
                                        @isset($extParams['ord'])
                                            @if($extParams['ord']=='id')<i class="fa fa-sort"></i>@endif
                                        @endisset
                                    #ID
                                    </a></th>
                                <th>Language</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Parent</th>
                                <th>Level</th>
                                <th>Has Child</th>
                                <th>Order</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Icon</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->lang }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td>{{ $value->parents }}</td>
                                    <td>{{ $value->level }}</td>
                                    <td>{{ $value->has_child }}</td>
                                    <td>{{ $value->order }}</td>
                                    <td>{{ $value->location }}</td>
                                    <td>{{ $value->menu_type }}</td>
                                    <td>{{ $value->menu_value }}</td>
                                    <td>{!! $value->css_icon !!} </td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('route_admin_menu_edit',['id'=>$value->id]) }}" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{ route('route_admin_menu_delete',['id'=>$value->id]) }}" rel="tooltip" class="btn btn-danger">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{  $list->appends($extParams)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop