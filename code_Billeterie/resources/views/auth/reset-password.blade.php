<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="mt-4">

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $request->email) }}" required autofocus autocomplete="email">

                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                    autocomplete="new-password">
                @error('password')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>


            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required autocomplete="new-password">
                @error('password_confirmation')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <br>


            <div class="col-lg-12">
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Reset Password</button>
                </div>
            </div>
            <br>
        </div>
    </form>
</x-guest-layout>