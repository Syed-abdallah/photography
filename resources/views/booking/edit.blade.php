@extends('dashboard.layout.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-5">Edit Booking</h2>

            <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
                @csrf
                @method('PUT')

                {{-- Booking Number (readonly) --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="booking_number">Booking Number</label>
                            <h1 id="booking_number" class="form-control-plaintext">
                                {{ $booking->booking_number }}
                            </h1>
                        </div>
                    </div>
                </div>

                {{-- Customer Information --}}
                <div class="section-header">
                    <h5 class="section-title">Customer Information</h5>
                    <div class="section-divider">
                        <div class="divider-line"></div>
                    </div>
                </div>

                <div class="row">
                    {{-- Title --}}
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <select class="form-control @error('title') is-invalid @enderror" id="title" name="title">
                                <option value="Mr" {{ old('title', $booking->title) == 'Mr' ? 'selected' : '' }}>Mr
                                </option>
                                <option value="Mrs" {{ old('title', $booking->title) == 'Mrs' ? 'selected' : '' }}>Mrs
                                </option>
                                <option value="Miss" {{ old('title', $booking->title) == 'Miss' ? 'selected' : '' }}>Miss
                                </option>
                                <option value="Ms" {{ old('title', $booking->title) == 'Ms' ? 'selected' : '' }}>Ms
                                </option>
                                <option value="Dr" {{ old('title', $booking->title) == 'Dr' ? 'selected' : '' }}>Dr
                                </option>
                            </select>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Customer Name --}}
                    <div class="col-md-5">
                        <div class="form-group mb-3">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $booking->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Contact Number --}}
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control @error('contact_number') is-invalid @enderror"
                                id="contact_number" name="contact_number"
                                value="{{ old('contact_number', $booking->contact_number) }}"
                                placeholder="+44 20 7946 0958" required>
                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $booking->email) }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Address & Post Code --}}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address', $booking->address) }}">
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
                                id="post_code" name="post_code" value="{{ old('post_code', $booking->post_code) }}">
                            @error('post_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Booking Details --}}
                <div class="section-header mb-4 mt-4">
                    <h5 class="section-title">Booking Details</h5>
                    <div class="section-divider">
                        <div class="divider-line"></div>
                    </div>
                </div>

                <div class="row">
                    {{-- Service --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="service_id">Service</label>
                            <select class="form-control @error('services') is-invalid @enderror" id="service_id"
                                name="services" required>
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('services', $booking->services) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('services')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Number of Guests --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="no_of_guest">Number of Guests</label>
                            <input type="number" class="form-control @error('no_of_guest') is-invalid @enderror"
                                id="no_of_guest" name="no_of_guest"
                                value="{{ old('no_of_guest', $booking->no_of_guest) }}" min="1" required>
                            @error('no_of_guest')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Booking Date --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="booking_date">Booking Date</label>
                            <input type="date" class="form-control @error('booking_date') is-invalid @enderror"
                                id="booking_date" name="booking_date"
                                value="{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d')) }}"
                                required>

                            @error('booking_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Start Time --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="start_time">Start Time</label>
                            <select class="form-control @error('start_time') is-invalid @enderror" name="start_time"
                                id="start_time" required>
                                @php
                                    $selectedStart = old(
                                        'start_time',
                                        $booking->start_time
                                            ? \Carbon\Carbon::parse($booking->start_time)->format('H:i')
                                            : '09:00',
                                    );
                                @endphp
                                @for ($i = 9; $i <= 17; $i++)
                                    @php
                                        $hour = sprintf('%02d', $i);
                                    @endphp
                                    <option value="{{ $hour }}:00"
                                        {{ $selectedStart == "$hour:00" ? 'selected' : '' }}>
                                        {{ $hour }}:00
                                    </option>
                                @endfor
                            </select>
                            @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Payment Information --}}
                <div class="section-header mb-4 mt-4">
                    <h5 class="section-title">Payment Information</h5>
                    <div class="section-divider">
                        <div class="divider-line"></div>
                    </div>
                </div>

                <div class="row">
                    {{-- Deposit Amount --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="deposit_amount">Deposit Amount (£)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="number" step="0.01"
                                    class="form-control @error('deposit_amount') is-invalid @enderror"
                                    id="deposit_amount" name="deposit_amount"
                                    value="{{ old('deposit_amount', $booking->deposit_amount) }}" min="0"
                                    required>
                            </div>
                            @error('deposit_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Pay on the Day --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="pay_on_day">Pay on the Day (£)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="number" step="0.01"
                                    class="form-control @error('pay_on_day') is-invalid @enderror" id="pay_on_day"
                                    name="pay_on_day" value="{{ old('pay_on_day', $booking->pay_on_day) }}"
                                    min="0">
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
                    {{-- Total Amount (readonly) --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="total_amount">Total Amount (£)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="number" step="0.01"
                                    class="form-control @error('total_amount') is-invalid @enderror" id="total_amount"
                                    name="total_amount" value="{{ old('total_amount', $booking->total_amount) }}"
                                    min="0" readonly>
                            </div>
                            <small class="form-text text-muted">(Deposit + Pay on Day)</small>
                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="payment_method">Payment Method</label>
                            <select class="form-control @error('payment_method') is-invalid @enderror"
                                id="payment_method" name="payment_method">
                                <option value="">Select Payment Method</option>
                                @foreach ($paymentMethods as $method)
                                    <option value="{{ $method->id }}"
                                        {{ old('payment_method', $booking->payment_method) == $method->id ? 'selected' : '' }}>
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

                {{-- Booking Management --}}
                <div class="section-header mb-4 mt-4">
                    <h5 class="section-title">Booking Management</h5>
                    <div class="section-divider">
                        <div class="divider-line"></div>
                    </div>
                </div>

                <div class="row">
                    {{-- Promotion (optional) --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="promotion_id">Promotion (Optional)</label>
                            <select class="form-control @error('promotions') is-invalid @enderror" id="promotion_id"
                                name="promotions">
                                <option value="">No Promotion</option>
                                @foreach ($promotions as $promotion)
                                    <option value="{{ $promotion->id }}"
                                        {{ old('promotions', $booking->promotions) == $promotion->id ? 'selected' : '' }}>
                                        {{ $promotion->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('promotions')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Sales Agent --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="sale_agent_id">Sales Agent</label>
                            <select class="form-control @error('sales_agents') is-invalid @enderror" id="sale_agent_id"
                                name="sales_agents" required>
                                <option value="">Select Sales Agent</option>
                                @foreach ($salesAgents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ old('sales_agents', $booking->sales_agents) == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sales_agents')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Booking Agent --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="booking_agent">Booking Agent</label>
                            <select class="form-control @error('booking_agent') is-invalid @enderror" id="booking_agent"
                                name="booking_agent" required>
                                {{-- The currently authenticated user --}}
                                <option value="{{ Auth::id() }}"
                                    {{ old('booking_agent', $booking->booking_agent) == Auth::id() ? 'selected' : '' }}>
                                    {{ Auth::user()->name }}
                                </option>

                                @foreach ($bookingAgents as $agent)
                                    @if ($agent->id !== Auth::id())
                                        <option value="{{ $agent->id }}"
                                            {{ old('booking_agent', $booking->booking_agent) == $agent->id ? 'selected' : '' }}>
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

                    {{-- Status --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status" required>
                                <option value="">Select Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ old('status', $booking->status) == $status->id ? 'selected' : '' }}>
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

                {{-- Submit Buttons --}}
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Update Booking</button>
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Inline Styles for Section Header --}}
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
    </style>

    {{-- JavaScript for calculating total amount --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Initial total
            calculateTotal();
        });
    </script>
@endsection
