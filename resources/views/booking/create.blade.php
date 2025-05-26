@extends('dashboard.layout.layout')

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
                    {{-- <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="start_time">Start Time</label>
                            <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                                id="start_time" name="start_time" value="{{ old('start_time', '09:00') }}"
                                min="09:00" max="17:00" required>
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
                            <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                id="end_time" name="end_time" value="{{ old('end_time', '10:00') }}" min="09:00"
                                max="17:00" required>
                            @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}
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
@endsection
