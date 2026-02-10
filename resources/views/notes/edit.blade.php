@extends('layouts.main')

@section('title', 'Edit Note')

@section('content')
<form method="POST"
      action="{{ route('notes.update', $note->id) }}"
      enctype="multipart/form-data"
      id="noteEditForm">
@csrf
@method('PUT')

<label>Title</label>
<input type="text"
       name="title"
       value="{{ old('title', $note->title) }}"
       required>

<label>Cover Image</label>
<input type="file" name="cover_image" accept="image/*">

<label>Content</label>
<textarea name="content"
          id="editor"
          rows="10"></textarea>

<button class="btn-primary" type="submit" id="updateNoteBtn">
  Update Note
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
      placeholder: 'Start editing your note...',
      toolbar: [
        'heading', '|',
        'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
        'blockQuote', 'insertTable', 'undo', 'redo'
      ]
    })
    .then(editor => {
      editorInstance = editor;
    })
    .catch(error => {
      console.error(error);
    });

  const form = document.getElementById('noteEditForm');
  const submitBtn = document.getElementById('updateNoteBtn');
  const contentTextarea = document.getElementById('editor');

  form.addEventListener('submit', (e) => {
    const content = editorInstance.getData().trim();

    // Empty content validation
    if (
      !content ||
      content === '<p>&nbsp;</p>' ||
      content === '<p><br></p>'
    ) {
      e.preventDefault();
      alert('⚠ Please write some content before saving.');
      return;
    }

    // ✅ CRITICAL: Set the textarea value with editor content
    contentTextarea.value = content;

    // Prevent double submit
    submitBtn.disabled = true;
    submitBtn.innerText = 'Saving…';
    submitBtn.style.opacity = '0.7';
  });

});
</script>
@endpush
