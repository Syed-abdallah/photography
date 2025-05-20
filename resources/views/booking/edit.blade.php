@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Booking</h4>

        <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Customer Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $booking->name) }}" required>
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
                               id="contact_number" name="contact_number" value="{{ old('contact_number', $booking->contact_number) }}" required>
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
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email', $booking->email) }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="service_id">Service</label>
                        <select class="form-control @error('service_id') is-invalid @enderror" 
                                id="service_id" name="services" required>
                            <option value="">Select Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ old('service_id', $booking->services) == $service->id ? 'selected' : '' }}>
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
                               id="no_of_guest" name="no_of_guest" value="{{ old('no_of_guest', $booking->no_of_guest) }}" min="1" required>
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
                        <select class="form-control @error('promotion_id') is-invalid @enderror" 
                                id="promotion_id" name="promotion_id">
                            <option value="">No Promotion</option>
                            @foreach($promotions as $promotion)
                                <option value="{{ $promotion->id }}" {{ old('promotion_id', $booking->promotions) == $promotion->id ? 'selected' : '' }}>
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
                        <label for="sales_agent_id">Sales Agent</label>
                        <select class="form-control @error('sales_agent_id') is-invalid @enderror" 
                                id="sales_agent_id" name="sales_agents" required>
                            <option value="">Select Sales Agent</option>
                            @foreach($salesAgents as $agent)
                                <option value="{{ $agent->id }}" {{ old('sales_agent_id', $booking->sales_agents) == $agent->id ? 'selected' : '' }}>
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
                               id="booking_agent" name="booking_agent" value="{{ old('booking_agent', $booking->booking_agent) }}" required>
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
                        <select class="form-control @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
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
                        <label for="deposit_amount">Deposit Amount</label>
                        <input type="number" step="0.01" class="form-control @error('deposit_amount') is-invalid @enderror" 
                               id="deposit_amount" name="deposit_amount" value="{{ old('deposit_amount', $booking->deposit_amount) }}" min="0" required>
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
                        <input type="number" step="0.01" class="form-control @error('sales_amount') is-invalid @enderror" 
                               id="sales_amount" name="sales_amount" value="{{ old('sales_amount', $booking->sales_amount) }}" min="0" required>
                        @error('sales_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="booking_date">Booking Date</label>
                        <input type="date" class="form-control @error('booking_date') is-invalid @enderror"
                            id="booking_date" name="booking_date"
                            value="{{ old('booking_date', $booking->booking_date) }}"
                            min="{{ now()->format('Y-m-d') }}"
                            required>
                        @error('booking_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="start_time">Start Time</label>
                        <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                            id="start_time" name="start_time" 
                            value="{{ old('start_time', $booking->start_time) }}"
                            min="09:00" max="17:00" required>
                        @error('start_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="end_time">End Time</label>
                        <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                            id="end_time" name="end_time" 
                            value="{{ old('end_time', $booking->end_time) }}" 
                            min="09:00" max="17:00" required>
                        @error('end_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
                
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Booking</button>
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection