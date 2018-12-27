@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Permission Add</h4>
                    <div class="toolbar">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Title Permisson</label>
                                <input class="form-control" name="txtTitle" placeholder="Please Enter Title Permisson" />
                                <label>Name Permission</label>
                                <input class="form-control" name="txtName" placeholder="Please Enter Name Permisson" />
                            </div>
                            <button type="submit" class="btn btn-default">Permisson Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop