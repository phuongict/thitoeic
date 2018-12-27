@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">User list</h4>
                    <div class="toolbar">
                        <a href="{{ route('route_admin_user_get_add') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add new</a>
                        <a href="{{ route('route_admin_user_list') }}" class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>

                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($data as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->role->title }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('route_admin_user_get_edit',['id'=>$data->id]) }}" class="btn btn-simple btn-danger btn-icon">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{ route('route_admin_user_get_delete',['id'=>$data->id]) }}" class="btn btn-simple btn-danger btn-icon">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }

            });

            $('.card .material-datatables label').addClass('form-group');
        });
    </script>
@stop