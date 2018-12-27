@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Permission Delete</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="alert alert-warning alert-with-icon">
                        <i class="material-icons" data-notify="icon" >warning</i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                        <span data-notify="message"> <b>Xóa permission:</b> Bạn có chắc chắn muốn xóa permission: {{ $data->title }} không? </span>
                    </div>
                    <form action="/admin/permissions/delete/{{ $data->id }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $data->id }}" name="txtPermission"/>
                        <button class="btn btn-default">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop