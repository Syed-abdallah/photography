{{-- @extends('dashboard.layout.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create New Booking</h4>

            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control @error('contact_number') is-invalid @enderror"
                                id="contact_number" name="contact_number" value="{{ old('contact_number') }}"
                                placeholder="+44 20 7946 0958" required>
                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <hr
                    style="border: none; 
    height: 3px; 
    width: 60%; 
    margin: 35px auto; 
    border-radius: 8px; 
    background: linear-gradient(to right, #4b6cb7, #182848); 
    box-shadow: 0 2px 5px rgba(0,0,0,0.2); 
    opacity: 0.8;">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="service_id">Service</label>
                            <select class="form-control @error('service_id') is-invalid @enderror" id="service_id"
                                name="services" required>
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="no_of_guest">Number of Guests</label>
                            <input type="number" class="form-control @error('no_of_guest') is-invalid @enderror"
                                id="no_of_guest" name="no_of_guest" value="{{ old('no_of_guest', 1) }}" min="1"
                                required>
                            @error('no_of_guest')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="promotion_id">Promotion (Optional)</label>
                            <select class="form-control @error('promotion_id') is-invalid @enderror" id="promotion_id"
                                name="promotions">
                                <option value="">No Promotion</option>
                                @foreach ($promotions as $promotion)
                                    <option value="{{ $promotion->id }}"
                                        {{ old('promotion_id') == $promotion->id ? 'selected' : '' }}>
                                        {{ $promotion->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('promotion_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="sale_agent_id">Sales Agent</label>
                            <select class="form-control @error('sales_agent_id') is-invalid @enderror" id="sales_agent_id"
                                name="sales_agents" required>
                                <option value="">Select Sales Agent</option>
                                @foreach ($salesAgents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ old('sales_agent_id') == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sales_agent_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="booking_agent">Booking Agent</label>
                            <input type="text" class="form-control @error('booking_agent') is-invalid @enderror"
                                id="booking_agent" name="booking_agent"
                                value="{{ old('booking_agent') ?? Auth()->user()->name }}" required>
                            @error('booking_agent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                                required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed
                                </option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed
                                </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr
                    style="border: none; 
    height: 3px; 
    width: 60%; 
    margin: 35px auto; 
    border-radius: 8px; 
    background: linear-gradient(to right, #4b6cb7, #0c9213); 
    box-shadow: 0 2px 5px rgba(0,0,0,0.2); 
    opacity: 0.8;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="deposit_amount">Deposit Amount</label>
                            <input type="number" step="0.01"
                                class="form-control @error('deposit_amount') is-invalid @enderror" id="deposit_amount"
                                name="deposit_amount" value="{{ old('deposit_amount', 0) }}" min="0" required>
                            @error('deposit_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="sales_amount">Total Sales Amount</label>
                            <input type="number" step="0.01"
                                class="form-control @error('sales_amount') is-invalid @enderror" id="sales_amount"
                                name="sales_amount" value="{{ old('sales_amount', 0) }}" min="0" >
                            @error('sales_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
       
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="booking_date">Booking Date</label>
                            <input type="date" class="form-control @error('booking_date') is-invalid @enderror"
                                id="booking_date" name="booking_date"
                                value="{{ old('booking_date', request()->input('date') ? \Carbon\Carbon::parse(request()->input('date'))->format('Y-m-d') : '') }}"
                                required>
                            @error('booking_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
             
                    <div class="col-md-3">
    <div class="form-group mb-3">
        <label for="start_time">Start Time</label>
        <select class="form-control @error('start_time') is-invalid @enderror" name="start_time" id="start_time" required>
            @for ($i = 9; $i <= 16; $i++)
                @php
                    $hour = sprintf('%02d', $i);
                @endphp
                <option value="{{ $hour }}:00" {{ old('start_time', '09:00') == "$hour:00" ? 'selected' : '' }}>{{ $hour }}:00</option>
                <option value="{{ $hour }}:30" {{ old('start_time') == "$hour:30" ? 'selected' : '' }}>{{ $hour }}:30</option>
            @endfor
            <option value="17:00" {{ old('start_time') == "17:00" ? 'selected' : '' }}>17:00</option>
        </select>
        @error('start_time')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="col-md-3">
    <div class="form-group mb-3">
        <label for="end_time">End Time</label>
        <select class="form-control @error('end_time') is-invalid @enderror" name="end_time" id="end_time" required>
            @for ($i = 9; $i <= 16; $i++)
                @php
                    $hour = sprintf('%02d', $i);
                @endphp
                <option value="{{ $hour }}:00" {{ old('end_time', '10:00') == "$hour:00" ? 'selected' : '' }}>{{ $hour }}:00</option>
                <option value="{{ $hour }}:30" {{ old('end_time') == "$hour:30" ? 'selected' : '' }}>{{ $hour }}:30</option>
            @endfor
            <option value="17:00" {{ old('end_time') == "17:00" ? 'selected' : '' }}>17:00</option>
        </select>
        @error('end_time')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Booking</button>
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection --}}







@extends('dashboard.layout.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-5">Create New Booking</h2>

            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf

                <!-- Customer Information Section -->
                <div class="section-header mb-4">
                    <h5 class="section-title">Customer Information</h5>
                    <div class="section-divider">
                        <div class="divider-line"></div>
                    </div>
                </div>



                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="booking_number">Booking Number</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('booking_number') is-invalid @enderror"
                                    id="booking_number" name="booking_number"
                                    value="{{ old('booking_number', $bookingNumber ?? str_pad(random_int(1, 999999), 6, '0', STR_PAD_LEFT)) }}"
                                    readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="refresh-booking-number">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            @error('booking_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <select class="form-control @error('title') is-invalid @enderror" id="title" name="title">
                                <option value="Mr" {{ old('title') == 'Mr' ? 'selected' : '' }}>Mr</option>
                                <option value="Mrs" {{ old('title') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                <option value="Miss" {{ old('title') == 'Miss' ? 'selected' : '' }}>Miss</option>
                                <option value="Ms" {{ old('title') == 'Ms' ? 'selected' : '' }}>Ms</option>
                                <option value="Dr" {{ old('title') == 'Dr' ? 'selected' : '' }}>Dr</option>
                            </select>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mb-3">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control @error('contact_number') is-invalid @enderror"
                                id="contact_number" name="contact_number" value="{{ old('contact_number') }}"
                                placeholder="+44 20 7946 0958" required>
                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address') }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="post_code">Post Code</label>
                            <input type="text" class="form-control @error('post_code') is-invalid @enderror"
                                id="post_code" name="post_code" value="{{ old('post_code') }}">
                            @error('post_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Booking Details Section -->
                <div class="section-header mb-4 mt-4">
                    <h5 class="section-title">Booking Details</h5>
                    <div class="section-divider">
                        <div class="divider-line"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="service_id">Service</label>
                            <select class="form-control @error('service_id') is-invalid @enderror" id="service_id"
                                name="services" required>
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="no_of_guest">Number of Guests</label>
                            <input type="number" class="form-control @error('no_of_guest') is-invalid @enderror"
                                id="no_of_guest" name="no_of_guest" value="{{ old('no_of_guest', 1) }}" min="1"
                                required>
                            @error('no_of_guest')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="booking_date">Booking Date</label>
                            <input type="date" class="form-control @error('booking_date') is-invalid @enderror"
                                id="booking_date" name="booking_date"
                                value="{{ old('booking_date', request()->input('date') ? \Carbon\Carbon::parse(request()->input('date'))->format('Y-m-d') : '') }}"
                                required>
                            @error('booking_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="start_time">Start Time</label>
                            <select class="form-control @error('start_time') is-invalid @enderror" name="start_time"
                                id="start_time" required>
                                @for ($i = 9; $i <= 16; $i++)
                                    @php
                                        $hour = sprintf('%02d', $i);
                                    @endphp
                                    <option value="{{ $hour }}:00"
                                        {{ old('start_time', '09:00') == "$hour:00" ? 'selected' : '' }}>
                                        {{ $hour }}:00</option>
                                    {{-- <option value="{{ $hour }}:30" {{ old('start_time') == "$hour:30" ? 'selected' : '' }}>{{ $hour }}:30</option> --}}
                                @endfor
                                <option value="17:00" {{ old('start_time') == '17:00' ? 'selected' : '' }}>17:00</option>
                            </select>
                            @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Information Section -->
                <div class="section-header mb-4 mt-4">
                    <h5 class="section-title">Payment Information</h5>
                    <div class="section-divider">
                        <div class="divider-line"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="deposit_amount">Deposit Amount (£)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="number" step="0.01"
                                    class="form-control @error('deposit_amount') is-invalid @enderror"
                                    id="deposit_amount" name="deposit_amount" value="{{ old('deposit_amount', 0) }}"
                                    min="0" required>
                            </div>
                            @error('deposit_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="pay_on_day">Pay on the Day (£)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="number" step="0.01"
                                    class="form-control @error('pay_on_day') is-invalid @enderror" id="pay_on_day"
                                    name="pay_on_day" value="{{ old('pay_on_day', 0) }}" min="0">
                            </div>
                            @error('pay_on_day')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="total_amount">Total Amount (£)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="number" step="0.01"
                                    class="form-control @error('total_amount') is-invalid @enderror" id="total_amount"
                                    name="total_amount" value="{{ old('total_amount', 0) }}" min="0" readonly>
                            </div>
                            <small class="form-text text-muted">(Deposit + Pay on Day)</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="payment_method">Payment Method</label>
                            <select class="form-control @error('payment_method') is-invalid @enderror"
                                id="payment_method" name="payment_method">
                                <option value="">Select Payment Method</option>
                                @foreach ($paymentMethods as $method)
                                    <option value="{{ $method->id }}"
                                        {{ old('payment_method') == $method->id ? 'selected' : '' }}>
                                        {{ $method->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_method')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>


                <!-- Booking Management Section -->
                <div class="section-header mb-4 mt-4">
                    <h5 class="section-title">Booking Management</h5>
                    <div class="section-divider">
                        <div class="divider-line"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="promotion_id">Promotion (Optional)</label>
                            <select class="form-control @error('promotion_id') is-invalid @enderror" id="promotion_id"
                                name="promotions">
                                <option value="">No Promotion</option>
                                @foreach ($promotions as $promotion)
                                    <option value="{{ $promotion->id }}"
                                        {{ old('promotion_id') == $promotion->id ? 'selected' : '' }}>
                                        {{ $promotion->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('promotion_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="sale_agent_id">Sales Agent</label>
                            <select class="form-control @error('sales_agent_id') is-invalid @enderror"
                                id="sales_agent_id" name="sales_agents" required>
                                <option value="">Select Sales Agent</option>
                                @foreach ($salesAgents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ old('sales_agent_id') == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sales_agent_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        {{-- <div class="form-group mb-3">
                            <label for="booking_agent">Booking Agent</label>
                            <select class="form-control @error('booking_agent') is-invalid @enderror" id="booking_agent" name="booking_agent" required>
                                <option value="{{ Auth()->user()->name }}" selected>{{ Auth()->user()->name }}</option>
                                @foreach ($bookingAgents as $agent)
                                    @if ($agent->name != Auth()->user()->name)
                                        <option value="{{ $agent->id }}" {{ old('booking_agent') == $agent->name ? 'selected' : '' }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('booking_agent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <div class="form-group mb-3">
                            <label for="booking_agent">Booking Agent</label>
                            <select class="form-control @error('booking_agent') is-invalid @enderror" id="booking_agent"
                                name="booking_agent" required>
                                {{-- Default (current) user --}}
                                <option value="{{ Auth::id() }}"
                                    {{ old('booking_agent', Auth::id()) == Auth::id() ? 'selected' : '' }}>
                                    {{ Auth::user()->name }}
                                </option>

                                @foreach ($bookingAgents as $agent)
                                    @if ($agent->id !== Auth::id())
                                        <option value="{{ $agent->id }}"
                                            {{ old('booking_agent') == $agent->id ? 'selected' : '' }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            @error('booking_agent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status" required>
                                <option value="">Select Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ old('status') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                </div>


                  <div class="form-group mb-3">
                    <label for="email">Message</label>
                    {{-- <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required> --}}
                        <textarea name="text" id="" cols="10" rows="2" value="{{ old('text') }}" class="form-control @error('text') is-invalid @enderror"></textarea>
                    @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Create Booking</button>
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3748;
            white-space: nowrap;
            padding-right: 1rem;
        }

        .section-divider {
            width: 100%;
        }

        .divider-line {
            height: 1px;
            background: linear-gradient(to right, #e2e8f0, #718096, #e2e8f0);
            width: 100%;
        }

        #refresh-booking-number {
            cursor: pointer;
            transition: transform 1s ease;
        }

        #refresh-booking-number:hover {
            transform: rotate(180deg);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {


            // Booking number refresh functionality
            document.getElementById('refresh-booking-number').addEventListener('click', function() {
                const newNumber = Math.floor(100000 + Math.random() * 900000);
                document.getElementById('booking_number').value = newNumber;
            });

            const depositInput = document.getElementById('deposit_amount');
            const payOnDayInput = document.getElementById('pay_on_day');
            const totalAmountInput = document.getElementById('total_amount');

            function calculateTotal() {
                const deposit = parseFloat(depositInput.value) || 0;
                const payOnDay = parseFloat(payOnDayInput.value) || 0;
                const total = deposit + payOnDay;
                totalAmountInput.value = total.toFixed(2);
            }

            depositInput.addEventListener('input', calculateTotal);
            payOnDayInput.addEventListener('input', calculateTotal);

            // Calculate initial total
            calculateTotal();
        });
    </script>
@endsection
