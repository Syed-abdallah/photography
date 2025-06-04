@php
    // Fetch the single Logo record (since you said “no user_id”)
    $logoRecord = \App\Models\Logo::first();
@endphp

<div class="card mt-3">
    <div class="card-header bg-dark">
        <p class="text-muted mt-1 ">
            {{ __("Update your logo.") }}
        </p>
    </div>
    <div class="card-body">
        <form action="{{ route('logo.update') }}" method="post" enctype="multipart/form-data">
            @csrf

        

  <div class="mb-3">
                <label for="name" class="form-label">{{ __('title') }}</label>
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name"
                    value="{{ old('name',  $logoRecord->name ?? '' ) }}"
                    name="name"
                
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>






            {{-- 2) File input for uploading a new logo --}}
            <div class="mb-3">
                <label for="logo" class="form-label">{{ __('Logo') }}</label>
                <input
                    type="file"
                    class="form-control @error('logo') is-invalid @enderror"
                    id="logo"
                    name="logo"
                    accept="image/*"
                >
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


                {{-- 1) Show current logo if it exists --}}
            @if($logoRecord && $logoRecord->logo_path)
                <div class="mb-3">
                    <label class="form-label">{{ __('Current Logo') }}</label>
                    <div>
                        <img
                            src="{{ asset('dashboard/assets/images/logo/' . $logoRecord->logo_path) }}"
                            alt="Current Logo"
                            class="img-thumbnail"
                            style="max-width: 100px; max-height: 100px;"
                        >
                    </div>
              
                </div>
            @endif
            <div class="d-flex align-items-center gap-4">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                @if (session('status') === 'profile-updated')
                    <div id="profile-updated-message" class="text-success">
                        {{ __('Saved.') }}
                    </div>
                    <script>
                        setTimeout(() => {
                            document.getElementById('profile-updated-message').style.display = 'none';
                        }, 2000);
                    </script>
                @endif
            </div>
        </form>
    </div>
</div>
