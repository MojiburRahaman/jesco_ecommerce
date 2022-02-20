@extends('frontend.master')

@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('Frontendhome')}}">Home</a></li>
                    <li class="breadcrumb-item active">Account</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- account area start -->
<div class="account-dashboard pt-100px pb-100px">
    <div class="container">
        <div class="row">
            @if (session('success'))
            <div class="col-12">
                <div class="mb-4 alert alert-success">{{session('success')}}</div>
            </div>
            @endif
            @if (session('warning'))
            <div class="col-12">
                <div class="mb-4 alert alert-warning">{{session('warning')}}</div>
            </div>
            @endif
            @if ($errors->any())
            <div class="col-12">
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <span class="text-danger mb-2">{{$error}}</span>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="col-sm-12 col-md-3 col-lg-3">

                <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link active">Dashboard</a></li>
                        <li> <a href="#orders" data-bs-toggle="tab" class="nav-link">Orders</a></li>
                        <li><a href="#account-details" data-bs-toggle="tab" class="nav-link">Account details</a>
                        <li><a href="#change-password" data-bs-toggle="tab" class="nav-link">Change Password</a></li>
                        </li>
                        <li><a onclick="event.preventDefault();document.getElementById('from_logout').submit()"
                                href="{{ route('logout') }}" class="nav-link">logout</a></li>
                    </ul>
                </div>
                <form id="from_logout" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->
                <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                    <div class="tab-pane fade show active" id="dashboard">
                        <h4>Welcome ,{{auth()->user()->name}} </h4>
                        <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent
                                orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a
                                href="#">Edit your password and account details.</a></p>
                    </div>
                    <div class="tab-pane fade" id="orders">
                        <h4>Orders</h4>
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($billing_details as $order)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$order->created_at->format("M d,Y")}}</td>
                                        <td><span class="success">Completed</span></td>
                                        @foreach ($order->order_summaries as $summary)

                                        <td> {{$summary->subtotal}} for 1 item </td>
                                        @endforeach
                                        <td><a href="cart.html" class="view">view</a></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10"> No Order</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="change-password">

                        <form action="{{route('ChangeUserPass')}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <h3>Change Password</h3>
                            <div class="form-group mb-4">
                                <label for="current_pass">Current Password</label>
                                <input autofocus class="form-control" placeholder="Current Password" type="password"
                                    name="current_pass" id="current_pass">
                            </div>
                            <div class="form-group mb-4">
                                <label for="new_pass">New Password</label>
                                <input required class="form-control" placeholder="New Password" type="password"
                                    name="new_pass" id="new_pass">
                            </div>
                            <div class="form-group mb-4">
                                <label for="confirm_pass">Confirm Password</label>
                                <input required class="form-control" placeholder="Confirm Password" type="password"
                                    name="confirm_pass" id="confirm_pass">
                            </div>
                            <div class="form-group save_button">
                                <button class="btn" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="account-details">
                        <h3>Account details </h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                    <form action="{{route('ProfileUpdate')}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="default-form-box mb-20">
                                            <label> Name</label>
                                            <input required type="text" name="name" value="{{auth()->user()->name}}">
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Email</label>
                                            <input type="text" required name="email" value="{{auth()->user()->email}}">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @else
                                            <span class="text-danger mt-2">*You need to verify email again if you change
                                                it</span>
                                            @enderror
                                        </div>
                                        <label class="checkbox-default checkbox-default-more-text" for="newsletter">

                                            <input {{(auth()->user()->newsletter->first()->status == 1) ? 'checked' :
                                            ''}} type="checkbox" id="newsletter" value="newsletter" name="newsletter">
                                            <span>Sign up for our newsletter</span>
                                        </label>
                                        <div class="save_button mt-3">
                                            <button class="btn" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- account area start -->
@endsection