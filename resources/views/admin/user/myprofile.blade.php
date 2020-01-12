@extends('admin.layouts.app')

@section('pagetitle')
    <title>My Profile</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!--User Profile Starts-->
<!--Basic User Details Starts-->
<section id="user-profile">
  <div class="row">
    <div class="col-12">
      <div class="card profile-with-cover">
        <div class="card-img-top img-fluid bg-cover height-300" style="background: url('{{ asset('') }}app-assets/img/photos/14.jpg') 50%;"></div>
        <div class="media profil-cover-details row">
          <div class="col-5">
            <div class="align-self-start halfway-fab pl-3 pt-2">
              <div class="text-left">
                <h3 class="card-title white">{{ Auth::user()->name }}</h3>
              </div>
            </div>
          </div>
          <div class="col-2">
            <div class="align-self-center halfway-fab text-center">
              <a class="profile-image">
                <img src="{{ asset('') }}app-assets/img/portrait/avatars/avatar-08.png" class="rounded-circle img-border gradient-summer width-100"
                  alt="Card image">
              </a>
            </div>
          </div>
          <div class="col-5">
          </div>
          <div class="profile-cover-buttons">
            <div class="media-body halfway-fab align-self-end">
              <div class="text-right d-none d-sm-none d-md-none d-lg-block">
                <button type="button" class="btn btn-primary btn-raised mr-2"><i class="fa fa-edit"></i> Edit</button>
              </div>
              <div class="text-right d-block d-sm-block d-md-block d-lg-none">
                <button type="button" class="btn btn-primary btn-raised mr-2"><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-success btn-raised mr-3"><i class="fa fa-dashcube"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="profile-section">
          <div class="row">
            <div class="col-lg-5 col-md-5 ">
              <ul class="profile-menu no-list-style">
                <li>
                  <a href="#about" class="primary font-medium-2 font-weight-600">About</a>
                </li>
                <li>
                  <a href="#privileges" class="primary font-medium-2 font-weight-600">Privileges</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-2 text-center">
              <span class="font-medium-2 text-uppercase">{{ Auth::user()->name }}</span>
              <p class="grey font-small-2">{{ Auth::user()->title }}</p>
            </div>
            <div class="col-lg-5 col-md-5">
              <ul class="profile-menu no-list-style">
                <li>
                  <a href="#history" class="primary font-medium-2 font-weight-600">History</a>
                </li>
                <li>
                  <a href="#support" class="primary font-medium-2 font-weight-600">Support</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Basic User Details Ends-->

<!--About section starts-->
<section id="about">
  <div class="row">
    <div class="col-12">
      <div class="content-header">About</div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="mb-3">
              <span class="d-block overflow-hidden">{{ Auth::user()->about }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--About section ends-->

<section id="privileges">
  <div class="row">
    <div class="col-12">
      <div class="content-header">Privileges</div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="mb-3">
              <span class="d-block overflow-hidden">{{ Auth::user()->about }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--User's friend section starts-->
<section id="history">
  <div class="row">
    <div class="col-12">
      <div class="content-header">History</div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-md-6 col-lg-4">
    Coming Soon ...
    </div>
  </div>
</section>
<!--User's friend section starts-->

<!--User's uploaded photos section starts-->
<section id="support">
  <div class="row">
    <div class="col-12">
      <div class="content-header">Support</div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-md-6 col-lg-4">
    Coming Soon ...
    </div>
  </div>
</section>
<!--User's uploaded photos section starts-->
<!--User Profile Starts-->

          </div>
        </div>
@endsection
@section('pagecss')
@endsection
@section('pagejs')
@endsection
