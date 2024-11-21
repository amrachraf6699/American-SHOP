@extends('manage.layout')
@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- Profile Card -->
            <div class="card shadow-lg border-0 mt-5">
                <div class="card-header text-center">
                    <h3 class="my-2">Profile Information</h3>
                </div>
                <div class="card-body text-center p-4">
                    
                    <!-- Profile Image -->
                    <img src="{{ $user->cover }}" alt="Profile Image" class="rounded-circle mb-3" width="150" height="150">
                    
                    <!-- Profile Data -->
                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>

                </div>
            </div>

            <!-- Edit Profile Form -->
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Edit Profile Card -->
                <div class="card shadow-lg border-0 mt-4">
                    <div class="card-header text-center">
                        <h3 class="my-2">Edit Profile</h3>
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- Profile Image Upload -->
                        <div class="mb-3 text-center">
                            <label for="profile_image" class="form-label">Update Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                            @error('profile_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Leave blank to keep current password">
                        </div>

                    </div>
                </div>

                <!-- Save Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                </div>
            </form>
            <!-- End of Form Wrapper -->

        </div>
    </div>
</div>
@endsection
