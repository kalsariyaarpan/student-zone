@extends('layouts.main')

@section('title', 'My Notes')

@section('content')

<div class="notes-dashboard">

  <div class="notes-header">
    <h1>Your Notes</h1>
    <a href="{{ route('notes.create') }}" class="btn-primary">
      + Create New Note
    </a>
  </div>
  
  {{-- Success overlay shown after creating/updating a note --}}
  @if(session('status'))
  <div id="noteSuccessOverlay" class="note-success-overlay">
    <div class="note-success-box">
      <svg class="checkmark" viewBox="0 0 52 52" width="96" height="96">
        <circle cx="26" cy="26" r="25" fill="none" stroke="#10B981" stroke-width="3" />
        <path fill="none" stroke="#10B981" stroke-width="4" d="M14 27 L22 35 L38 18"/>
      </svg>
      <h3>{{ session('status') }}</h3>
    </div>
  </div>
  @endif
  
  <div class="notes-grid">
    @forelse($notes as $note)
      <div class="note-card">

        <img src="{{ $note->cover_image 
            ? asset('storage/'.$note->cover_image)
            : asset('assets/img/note-default.jpg') }}">

        <div class="note-body">
          <h3>{{ $note->title }}</h3>
          <span class="badge {{ $note->status }}">
            {{ ucfirst($note->status) }}
          </span>

          <a href="{{ route('notes.edit', $note->id) }}"
             class="edit-btn">✏️ Edit</a>
        </div>
      </div>
    @empty
      <p style="color:#94a3b8">No notes created yet.</p>
    @endforelse
  </div>
</div>
@if(session('status'))
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('noteSuccessOverlay');
  if (!overlay) return;

  // run a small confetti burst
  try {
    confetti({
      particleCount: 40,
      spread: 60,
      origin: { y: 0.6 }
    });
  } catch (err) {
    console.warn('confetti failed', err);
  }

  overlay.classList.add('visible');

  // auto-hide after 2.2s
  setTimeout(() => {
    overlay.classList.remove('visible');
    overlay.style.opacity = 0;
  }, 2200);
});
</script>
<style>
/* Success overlay styles */
.note-success-overlay{
  position: fixed;
  left: 50%;
  top: 18%;
  transform: translateX(-50%);
  z-index: 9999;
  pointer-events: none;
  opacity: 0;
  transition: opacity .25s ease, transform .4s ease;
}
.note-success-overlay.visible{opacity:1; transform: translateX(-50%) translateY(0);} 
.note-success-box{background: rgba(255,255,255,0.98); padding:18px 26px; border-radius:12px; box-shadow:0 8px 30px rgba(2,6,23,0.3); display:flex; gap:14px; align-items:center}
.note-success-box h3{margin:0; font-size:16px; color:#064E3B}
.note-success-box .checkmark{flex:0 0 auto}
</style>
@endif

@endsection
