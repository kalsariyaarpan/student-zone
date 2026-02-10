@extends('layouts.main')

@section('title', 'Create Note')

@section('content')
<form method="POST"
      action="{{ route('notes.store') }}"
      enctype="multipart/form-data"
      id="createNoteForm">
@csrf

<label>Title</label>
<input type="text" name="title" value="{{ old('title') }}" required>

<label>Cover Image</label>
<input type="file" name="cover_image" accept="image/*">

<label>Content</label>
<textarea name="content"
          id="editor"
          rows="10"></textarea>

<button class="btn-primary" type="submit" id="saveNoteBtn">
  Save Note
</button>
</form>
@endsection

@push('scripts')
<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

  let editorInstance;

  ClassicEditor
    .create(document.querySelector('#editor'), {
      placeholder: 'Start writing your note...',
      toolbar: [
        'heading', '|',
        'bold', 'italic', 'link',
        'bulletedList', 'numberedList', '|',
        'blockQuote', 'insertTable',
        'undo', 'redo'
      ]
    })
    .then(editor => {
      editorInstance = editor;
    })
    .catch(error => {
      console.error(error);
    });

  const form = document.getElementById('createNoteForm');
  const btn  = document.getElementById('saveNoteBtn');
  const contentTextarea = document.getElementById('editor');

  form.addEventListener('submit', (e) => {
    // Get content from CKEditor
    const content = editorInstance.getData().trim();

    // Prevent empty submit
    if (
      !content ||
      content === '<p><br></p>' ||
      content === '<p>&nbsp;</p>'
    ) {
      e.preventDefault();
      alert('⚠ Please write some content before saving.');
      return;
    }

    // ✅ CRITICAL: Set the textarea value with editor content
    contentTextarea.value = content;

    // Prevent double submit
    btn.disabled = true;
    btn.innerText = 'Saving…';
    btn.style.opacity = '0.7';
  });

});
</script>
@endpush
