@extends('layouts.main')

@section('title', 'My Documents')

@section('content')

<div class="profile-card">

    <h2>My Uploaded Documents</h2>

    @if($docs->count() == 0)

        <p style="color:gray;">No documents uploaded.</p>

        <a href="{{ route('fields.upload') }}" class="btn-primary">
            Add Documents
        </a>

    @else

        <div class="doc-grid">

            @foreach($docs as $doc)
                <div class="doc-card delete-anim-card">
                     {{-- <div class="doc-card type-{{ strtolower($doc->resource_type) }}"> temp --}}

                    <!-- RESOURCE TYPE -->
                    <div class="doc-type">
                    {{ optional($doc->field)->name ?? 'Field Removed' }} • 
                    {{ ucfirst($doc->resource_type) }}
                </div>


                    <!-- SUBJECT -->
                    <div class="doc-subject">
                        📘 {{ $doc->subject }}
                    </div>

                    <!-- YEAR + SEMESTER -->
                    <div class="doc-meta">
                        {{ $doc->year }} Year • Semester {{ $doc->semester }}
                    </div>

                    <!-- DESCRIPTION -->
                    @if($doc->description)
                        <p class="doc-desc">{{ $doc->description }}</p>
                    @endif

                    <!-- ACTION BUTTONS -->
                    <!-- ACTION MENU -->
<div class="doc-menu">
    <button class="menu-btn" onclick="toggleMenu(this)">
        ⋮
    </button>

    <div class="menu-dropdown">
        @if($doc->file)
            <a href="{{ asset('storage/'.$doc->file) }}" target="_blank">👁️ View</a>
            <a href="{{ asset('storage/'.$doc->file) }}" download>📥 Download</a>
        @endif

        @if($doc->url)
            <a href="{{ $doc->url }}" target="_blank">🌐 Open Link</a>
        @endif

        <a href="{{ route('documents.edit', $doc->id) }}">✏️ Edit</a>

        <form action="{{ route('documents.delete', $doc->id) }}"
              method="POST"
              class="delete-form">
            @csrf
            @method('DELETE')
            <button type="button"
                    class="menu-delete"
                    onclick="confirmDelete(this)">
                🗑 Delete
            </button>
        </form>
    </div>
</div>


             <!-- META -->
                <div class="doc-stats">
                    <span>
                        📦 {{ $doc->file ? strtoupper(pathinfo($doc->file, PATHINFO_EXTENSION)) : 'LINK' }}
                    </span>
                    <span>•</span>
                    <span>⏱ {{ $doc->created_at->diffForHumans() }}</span>
                </div>

            </div>
             @endforeach


                    {{-- <div class="doc-time">
                        Uploaded {{ $doc->created_at->diffForHumans() }}
                    </div>

                </div>
            @endforeach --}}

        </div>

        <a href="{{ route('fields.upload') }}" class="add-doc-btn" style="margin-top:20px; display:inline-block;">
            Add More Documents
        </a>

    @endif

</div>

<script>
function confirmDelete(button) {
    const form = button.closest('form');
    const card = button.closest('.delete-anim-card');

    // Start animation immediately
    button.classList.add('deleting');
    card.classList.add('deleting');

    setTimeout(() => {
        Swal.fire({
            title: 'Delete Document?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else {
                // Rollback animation if canceled
                button.classList.remove('deleting');
                card.classList.remove('deleting');
            }
        });
    }, 250);
}

function toggleMenu(btn) {
    // Close other menus
    document.querySelectorAll('.menu-dropdown').forEach(menu => {
        if (menu !== btn.nextElementSibling) {
            menu.classList.remove('active');
        }
    });

    btn.nextElementSibling.classList.toggle('active');
}

// Close menu on outside click
document.addEventListener('click', function (e) {
    if (!e.target.closest('.doc-menu')) {
        document.querySelectorAll('.menu-dropdown')
            .forEach(menu => menu.classList.remove('active'));
    }
});
</script>

<style>
    .doc-card {
    position: relative;
}

/* 3-dot button */
.menu-btn {
    background: none;   
    border: none;
    color: #000000;
    font-size: 22px;
    cursor: pointer;
    padding: 6px;
}

.menu-btn:hover {
    color: #170e6b;
}

/* Menu container */
.doc-menu {
    position: absolute;
    top: 12px;
    right: 12px;
}

/* Dropdown */
.menu-dropdown {
    position: absolute;
    top: 28px;
    right: 0;
    background: #1f2933;
    border-radius: 10px;
    width: 160px;
    display: none;
    flex-direction: column;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    overflow: hidden;
    z-index: 10;
}
    
.menu-dropdown a,
.menu-dropdown button {
    padding: 10px 14px;
    font-size: 14px;
    color: #e5e7eb;
    text-align: left;
    background: none;
    border: none;
    width: 100%;
    cursor: pointer;
}

.menu-dropdown a:hover,
.menu-dropdown button:hover {
    background: #374151;
}

/* Delete highlight */
.menu-delete {
    color: #ef4444;
}

/* Show menu */
.menu-dropdown.active {
    display: flex;
}


/* META */
.doc-stats {
    font-size: 12px;
    color: #777;
    display: flex;
    gap: 6px;
    align-items: center;
    margin-top: 10px;
    margin-top: auto;
}

    
</style>
@endsection
