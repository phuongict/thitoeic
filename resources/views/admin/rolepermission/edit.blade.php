@extends('admin.layouts.admin')
@section('content')
    <br/>
    @if(session('thongbao'))
        <div class="alert alert-success">
            {{ session('thongbao') }}
        </div>
    @endif
    <form action="{{ url('admin/rolepermission/edit/'.$id) }}" method="POST">
        @csrf
        <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Có</th>
                        <th>Không</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Có</th>
                        <th>Không</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach($data as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->title }}</td>
                        <?php $checked = '';
                                $checked2 = 'checked';
                        ?>
                        @foreach ($listPermisson as $value)
                            @if($data->name == $value->name)
                               <?php $checked = 'checked';
                                $checked2 = '';
                                ?>
                                @endif
                        @endforeach
                        <td>
                            <div class="radio">
                                <label><input type="radio" {{ $checked }} value="ye_{{ $data->id }}" name="{{ $data->name }}"></label>
                            </div>
                        </td>
                        <td>
                            <div class="radio">
                                <label><input type="radio" {{ $checked2 }} value="no_{{ $data->id }}" name="{{ $data->name }}"></label>
                            </div>
                        </td>
                    </tr>
                @endforeach
                {{--<tr><td colspan="4"></td></tr>--}}
                </tbody>
            </table>
        </div>
                <button type="submit" class="btn btn-default">Cập nhật</button>
            </form>
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
