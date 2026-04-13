@extends('layouts.main')

@section('title', 'My Profile')

@section('content')

<div class="profile-wrapper">

    <!-- COVER -->
    <div class="profile-cover">
    <div class="cover-content">
        <h1 class="cover-name">
            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </h1>
    </div>

    <div class="profile-avatar">
        <img 
            src="{{ Auth::user()->profile_photo 
                ? asset('storage/' . Auth::user()->profile_photo) 
                : asset('images/default-avatar.png') }}"
            class="avatar"
        >
    </div>
</div>


    <!-- CARD -->
    <div class="profile-card">

        <h2 class="name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
        <p class="username">{{ Auth::user()->username }}</p>
        <p class="email">{{ Auth::user()->email }}</p>

        <!-- STATS -->
        <div class="profile-stats">
            <div class="stat clickable" onclick="window.location.href='{{ route('my.documents') }}'">
                <span class="value">{{ $docCount ?? 0 }}</span>
                <span class="label">Documents Uploaded</span>
            </div>
            <div class="stat clickable" onclick="handleStatClick({{ $qrCount ?? 0 }}, 'QR Scans')">
                <span class="value">{{ $qrCount ?? 0 }}</span>
                <span class="label">QR Scans</span>
            </div>
            <div class="stat clickable" onclick="handleStatClick({{ $notesCount ?? 0 }}, 'Notes Created')">
                {{-- <div class="stat clickable" onclick="handleStatClick({{ $notesCount ?? 0 }}, 'Notes Created')"> --}}
                <span class="value">{{ $notesCount ?? 0 }}</span>   
                <span class="label">Notes Created</span>
            </div>
            <div class="stat clickable" onclick="handleStatClick({{ $tasksCount ?? 0 }}, 'Tasks Completed')">
                <span class="value">{{ $tasksCount ?? 0 }}</span>
                <span class="label">Tasks Completed</span>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="profile-actions">
            <button class="btn-primary" onclick="openEdit()">Edit Profile</button>
            <button class="btn-secondary" onclick="openPassword()">Change Password</button>  
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button  type="submit " class="btn-danger">Logout</button>
            </form>
        
           <button class="btn-primary" onclick="window.location.href='{{ route('my.documents') }}'">
    Your Documents
</button>

            {{-- @if($docCount == 0)
    <p style="color:gray; margin-top:10px;">No documents uploaded.</p>

    <a href="{{ route('fields.upload') }}" 
       class="btn-primary" 
       style="margin-top: 10px; display:inline-block;">
       Add Documents
    </a>
@endif --}}


        </div>
    </div>


    <!-- =======================
         EDIT PROFILE MODAL
    ======================== -->
    <div class="modal" id="editModal">
        <div class="modal-box">
            <h3>Edit Profile</h3>
            <form action="{{ route('account.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>First Name</label>
                <input type="text" name="first_name" value="{{ Auth::user()->first_name }}">

                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ Auth::user()->last_name }}">

                <label>Username</label>
                <input type="text" name="username" value="{{ Auth::user()->username }}">

                
                <label>Upload Profile Photo</label>
                <input type="file" name="profile_photo">

                <button class="btn-primary">Save</button>
                <button type="button" class="btn-close" onclick="closeEdit()">Cancel</button>
            </form>
        </div>
    </div>


    <!-- =======================
         CHANGE PASSWORD MODAL
    ======================== -->
    <div class="modal" id="passwordModal">
        <div class="modal-box">
            <h3>Change Password</h3>
            <form action="{{ route('account.profile.password') }}" method="POST">
                @csrf

                <label>Current Password</label>
                <input type="password" name="current_password">

                <label>New Password</label>
                <input type="password" name="password">

                <label>Confirm Password</label>
                <input type="password" name="password_confirmation">

                <button class="btn-primary">Update</button>
                <button type="button" class="btn-close" onclick="closePassword()">Cancel</button>
            </form>
        </div>
    </div>

    <!-- =======================
         COMING SOON MODAL
    ======================== -->
    <div class="modal" id="comingSoonModal" style="display: none;">
        <div class="modal-box coming-soon-box">
            <h3>Coming Soon</h3>
            <p id="comingSoonText" style="
    color: aliceblue;">This feature is coming soon.</p>
            <button class="btn-primary" onclick="closeComingSoon()">Okay</button>
        </div>
    </div>

</div>

<script>
function openEdit() {
    document.getElementById("editModal").style.display = "flex";
}
function closeEdit() {
    document.getElementById("editModal").style.display = "none";
}
function openPassword() {
    document.getElementById("passwordModal").style.display = "flex";
}
function closePassword() {
    document.getElementById("passwordModal").style.display = "none";
}

function showComingSoonModal(message) {
    var modal = document.getElementById('comingSoonModal');
    var text = document.getElementById('comingSoonText');
    text.textContent = message;
    modal.style.display = 'flex';
}

function closeComingSoon() {
    document.getElementById('comingSoonModal').style.display = 'none';
}

function handleStatClick(count, label, route) {
    if (count === 0) {
        showComingSoonModal('Service coming soon for ' + label + '.');
    } else if (route) {
        window.location.href = route;
    } else {
        showComingSoonModal('Service coming soon for ' + label + '.');
    }
}

function goToDocuments() {
    window.location.href = "{{ route('resources.select') }}";
}

</script>

<style>
    .stat.clickable {
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
}
.stat.clickable:hover {
  transform: translateY(-6px);
  box-shadow: 0 15px 40px rgba(56,189,248,0.35);
}

.modal#comingSoonModal {
  align-items: center;
  justify-content: center;
}

.coming-soon-box {
  max-width: 380px;
  padding: 28px 26px;
  text-align: center;
  border-radius: 20px;
  box-shadow: 0 24px 70px rgba(15, 23, 42, 0.18);
}

.coming-soon-box h3 {
  margin-bottom: 14px;
  color: #1e3a8a;
}

.coming-soon-box p {
  margin-bottom: 20px;
  color: #334155;
  line-height: 1.6;
}

</style>
@endsection
