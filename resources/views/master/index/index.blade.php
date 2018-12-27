@extends("master.layouts.master")
@section("slide")
    @include('master.layouts.slide')
    @stop
@section("content")


    <div class="box box-info container-fluid">
       <div class="box-header with-border">
           <div class="box-title">
               {{ __('Bài thi toiec mới') }}
           </div>
       </div>
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                <li class="item">
                    <div class="product-img">
                        <img src="{{ asset('/public/front/dist/img/default-50x50.gif') }}" alt="Product Image">
                    </div>
                    <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Bài thi toeic tháng 9
                            <span class="label label-warning pull-right">900 điểm</span></a>
                        <span class="product-description">
                          Bài thi toeic tháng 9...
                        </span>
                    </div>
                </li>
                <!-- /.item -->
                <li class="item">
                    <div class="product-img">
                        <img src="{{ asset('/public/front/dist/img/default-50x50.gif') }}" alt="Product Image">
                    </div>
                    <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Bài thi toeic tháng 9
                            <span class="label label-warning pull-right">900 điểm</span></a>
                        <span class="product-description">
                          Bài thi toeic tháng 9...
                        </span>
                    </div>
                </li>
                <!-- /.item -->
                <li class="item">
                    <div class="product-img">
                        <img src="{{ asset('/public/front/dist/img/default-50x50.gif') }}" alt="Product Image">
                    </div>
                    <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Bài thi toeic tháng 9
                            <span class="label label-warning pull-right">900 điểm</span></a>
                        <span class="product-description">
                          Bài thi toeic tháng 9...
                        </span>
                    </div>
                </li>
                <!-- /.item -->
                <li class="item">
                    <div class="product-img">
                        <img src="{{ asset('/public/front/dist/img/default-50x50.gif') }}" alt="Product Image">
                    </div>
                    <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Bài thi toeic tháng 9
                            <span class="label label-warning pull-right">900 điểm</span></a>
                        <span class="product-description">
                          Bài thi toeic tháng 9...
                        </span>
                    </div>
                </li>
                <!-- /.item -->
            </ul>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                Bài viết xem nhiều
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="item-feature">
                <img src="http://placehold.it/150x100" alt="">
                <div class="content-item-feature">
                    <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                    <p>Đây là tài liệu...</p>
                    <div class="info-item-feature">
                        <span class="total-view-item"><i class="fa fa-eye"></i> 100</span>
                        <span class="price-item">Miễn phí</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="item-feature">
                <img src="http://placehold.it/150x100" alt="">
                <div class="content-item-feature">
                    <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                    <p>Đây là tài liệu...</p>
                    <div class="info-item-feature">
                        <span class="total-view-item"><i class="fa fa-eye"></i> 100</span>
                        <span class="price-item">Miễn phí</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="item-feature">
                <img src="http://placehold.it/150x100" alt="">
                <div class="content-item-feature">
                    <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                    <p>Đây là tài liệu...</p>
                    <div class="info-item-feature">
                        <span class="total-view-item"><i class="fa fa-eye"></i> 100</span>
                        <span class="price-item">Miễn phí</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="item-feature">
                <img src="http://placehold.it/150x100" alt="">
                <div class="content-item-feature">
                    <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                    <p>Đây là tài liệu...</p>
                    <div class="info-item-feature">
                        <span class="total-view-item"><i class="fa fa-eye"></i> 100</span>
                        <span class="price-item">Miễn phí</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @stop
@section('css')
    <style>
        .carousel-inner>.item>a>img, .carousel-inner>.item>img {
            width: 100%;
            max-height: 300px;
            background-size: 100% 100%;
            object-fit: cover;
        }
    </style>
    @stop