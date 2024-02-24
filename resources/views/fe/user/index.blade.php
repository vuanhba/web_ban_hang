@extends('fe.layout.master')
@section('content')
    <style>
        .main_content_area {
            padding-bottom: 65px;
            margin-top: 300px
        }

        @media only screen and (max-width: 767px) {
            .dashboard_tab_button {
                margin-bottom: 20px;
            }
        }

        .dashboard_tab_button ul li {
            margin-bottom: 5px;
        }

        .dashboard_tab_button ul li a {
            font-size: 14px;
            color: #ffffff;
            font-weight: 500;
            text-transform: capitalize;
            background: #212121;
            border-radius: 3px;
        }

        .dashboard_tab_button ul li a:hover {
            background: #c09578;
            color: #ffffff;
        }

        .dashboard_tab_button ul li a.active {
            background: #c09578;
        }

        .table-responsive .table {
            border-left: 1px solid #ebebeb;
            border-bottom: 1px solid #ebebeb;
            border-right: 1px solid #ebebeb;
        }

        .dashboard_content address {
            font-weight: 500;
            color: #212121;
        }

        .input-radio span input[type="radio"],
        .account_login_form form span input[type="checkbox"] {
            width: 15px;
            height: 15px;
            margin-right: 2px;
            position: relative;
            top: 2px;
        }

        .input-radio span {
            color: #212121;
            font-weight: 500;
            padding-right: 10px;
        }

        .account_login_form form input {
            border: 1px solid #ddd;
            background: none;
            height: 40px;
            margin-bottom: 20px;
            width: 100%;
            padding: 0 20px;
            color: #5a5a5a;
        }
    </style>
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <ul role="tablist" class="nav flex-column dashboard-list">
                                <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link active">Dashboard</a></li>
                                <li> <a href="#orders" data-bs-toggle="tab" class="nav-link">Orders</a></li>
                                <li><a href="#address" data-bs-toggle="tab" class="nav-link">Addresses</a></li>
                                <li><a href="#account-details" data-bs-toggle="tab" class="nav-link">Account details</a>
                                <li> <a href="#change-password" data-bs-toggle="tab" class="nav-link">Change password</a>
                                </li>

                                </li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <li><button style="border: none" type="submit"><a style="margin: 5px" class="nav-link">logout</a></button></li>

                                </form>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade show active" id="dashboard">
                                <h3>Dashboard </h3>
                                <p>From your account dashboard. you can easily check &amp; view your <a
                                        href="#">recent orders</a>, manage your <a href="#">shipping and billing
                                        addresses</a> and <a href="#">Edit your password and account details.</a></p>
                            </div>
                            <div class="tab-pane fade" id="orders">
                                <h3>Orders</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        @if (url()->current() == route('client.user.index'))
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

                                                @foreach ($listOrder as $order)
                                                    <tr>
                                                        <td>{{ $order->code }}</td>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td>
                                                            @if ($order->status == 0)
                                                                <span class="danger">Pending</span>
                                                            @elseif ($order->status == 1)
                                                                <span class="success">Completed</span>
                                                            @else
                                                                <span class="warning">Processing</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ number_format($order->total_price, 2, '.', ',') . ' VND' }}

                                                        </td>

                                                        <td><a
                                                                href="{{ route('client.user.orderDetail', $order->id) }}">View</a>
                                                        </td>
                                                    </tr>


                                            </tbody>
                                        @endforeach
                                    @else
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderDetail as $order)
                                                <tr>
                                                    <td><img src="{{ asset('storage/' . $order->product->image_primary) }}"
                                                            alt="{{ $order->product->image_primary }}" width="100px"></td>
                                                    <td>{{ $order->product->name }}</td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>{{ number_format($order->product->price, 2, '.', ',') . ' VND' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <button class="btn-infor"><a href="{{ route('client.user.index') }}">Quay
                                                    lại</a></button>
                                        </tbody>
                                        @endif






                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="address">
                                <p>The following addresses will be used on the checkout page by default.</p>
                                <h4 class="billing-address">Billing address</h4>
                                <a href="#" class="view">Edit</a>
                                <p><strong>Bobby Jackson</strong></p>
                                <address>
                                    <span><strong>City:</strong> Seattle</span>,
                                    <br>
                                    <span><strong>State:</strong> Washington(WA)</span>,
                                    <br>
                                    <span><strong>ZIP:</strong> 98101</span>,
                                    <br>
                                    <span><strong>Country:</strong> USA</span>
                                </address>
                            </div>
                            <div class="tab-pane fade" id="account-details">
                                <h3>Account details </h3>
                                <div class="login">
                                    <div class="login_form_container">
                                        <div class="account_login_form">
                                            <form action="#">


                                                <label>Name</label>
                                                <input type="text" name="name" value="{{ $user->name }}">
                                                <label>Email
                                                    <input type="text" name="email" value="{{ $user->email }}">
                                                    <label>Phone</label>
                                                    <input type="text" name="phone" value="{{ $user->phone }}">
                                                    <div class="save_button primary_btn default_button">
                                                        <a href="#">Save</a>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="change-password">
                                <h3>Change password</h3>
                                <div class="login">
                                    <div class="login_form_container">
                                        <div class="account_login_form">
                                            <form action="{{ route('client.user.changePassword') }}" method="POST">
                                                @csrf
                                                <label>Current password</label>
                                                <input type="password" name="old_password">
                                                @if (session('error'))
                                                    <p style="color: red">{{ session('error') }}</p>
                                                @endif
                                                <label>New password</label>
                                                <input type="password" name="password">
                                                @if (session('error'))
                                                    <p style="color: red">{{ session('error') }}</p>
                                                @endif
                                                <label>Confirm new password</label>
                                                <input type="password" name="confirm_password">
                                                @if (session('error'))
                                                    <p style="color: red">{{ session('error') }}</p>
                                                @endif
                                                <div class="save_button primary_btn default_button">
                                                    <button type="submit">Oke</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </section>
@endsection
