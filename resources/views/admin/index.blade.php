@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">weekend</i>
                </div>
                <div class="card-content">
                    <p class="category">Bookings</p>
                    <h3 class="card-title">184</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-danger">warning</i>
                        <a href="#">Get More Space...</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="rose">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="card-content">
                    <p class="category">Website Visits</p>
                    <h3 class="card-title">75.521</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> Tracked from Google Analytics
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">store</i>
                </div>
                <div class="card-content">
                    <p class="category">Revenue</p>
                    <h3 class="card-title">$3,245</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Last 24 Hours
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="fa fa-twitter"></i>
                </div>
                <div class="card-content">
                    <p class="category">Followers</p>
                    <h3 class="card-title">+245</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Just Updated
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3>Manage Listings</h3>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-product">
                <div class="card-image" data-header-animation="true">
                    <a href="#">
                        <img class="img" src="{{ asset('/public/admin/assets/img/card-2.jpg') }}">
                    </a>
                </div>
                <div class="card-content">
                    <div class="card-actions">
                        <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                            <i class="material-icons">build</i> Fix Header!
                        </button>
                        <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="View">
                            <i class="material-icons">art_track</i>
                        </button>
                        <button type="button" class="btn btn-success btn-simple" rel="tooltip" data-placement="bottom" title="Edit">
                            <i class="material-icons">edit</i>
                        </button>
                        <button type="button" class="btn btn-danger btn-simple" rel="tooltip" data-placement="bottom" title="Remove">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <h4 class="card-title">
                        <a href="#">Cozy 5 Stars Apartment</a>
                    </h4>
                    <div class="card-description">
                        The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Barcelona.
                    </div>
                </div>
                <div class="card-footer">
                    <div class="price">
                        <h4>$899/night</h4>
                    </div>
                    <div class="stats pull-right">
                        <p class="category"><i class="material-icons">place</i> Barcelona, Spain</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-product">
                <div class="card-image" data-header-animation="true">
                    <a href="#">
                        <img class="img" src="{{ asset('/public/admin/assets/img/card-3.jpg') }}">
                    </a>
                </div>
                <div class="card-content">
                    <div class="card-actions">
                        <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                            <i class="material-icons">build</i> Fix Header!
                        </button>
                        <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="View">
                            <i class="material-icons">art_track</i>
                        </button>
                        <button type="button" class="btn btn-success btn-simple" rel="tooltip" data-placement="bottom" title="Edit">
                            <i class="material-icons">edit</i>
                        </button>
                        <button type="button" class="btn btn-danger btn-simple" rel="tooltip" data-placement="bottom" title="Remove">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <h4 class="card-title">
                        <a href="#">Office Studio</a>
                    </h4>
                    <div class="card-description">
                        The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the night life in London, UK.
                    </div>
                </div>
                <div class="card-footer">
                    <div class="price">
                        <h4>$1.119/night</h4>
                    </div>
                    <div class="stats pull-right">
                        <p class="category"><i class="material-icons">place</i> London, UK</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-product">
                <div class="card-image" data-header-animation="true">
                    <a href="#">
                        <img class="img" src="{{ asset('/public/admin/assets/img/card-1.jpg') }}">
                    </a>
                </div>
                <div class="card-content">
                    <div class="card-actions">
                        <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                            <i class="material-icons">build</i> Fix Header!
                        </button>
                        <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="View">
                            <i class="material-icons">art_track</i>
                        </button>
                        <button type="button" class="btn btn-success btn-simple" rel="tooltip" data-placement="bottom" title="Edit">
                            <i class="material-icons">edit</i>
                        </button>
                        <button type="button" class="btn btn-danger btn-simple" rel="tooltip" data-placement="bottom" title="Remove">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <h4 class="card-title">
                        <a href="#">Beautiful Castle</a>
                    </h4>
                    <div class="card-description">
                        The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Milan.
                    </div>
                </div>
                <div class="card-footer">
                    <div class="price">
                        <h4>$459/night</h4>
                    </div>
                    <div class="stats pull-right">
                        <p class="category"><i class="material-icons">place</i> Milan, Italy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop