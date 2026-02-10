@extends('layouts.main')

@section('title', 'Edit Document')

@section('content')

<div class="edit-doc-wrapper">

    <div class="edit-doc-card">

        <h2 class="edit-title">Edit Document</h2>

        <form method="POST"
              action="{{ route('documents.update', $doc->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Subject -->
            <div class="edit-field">
                <label>Subject</label>
                <input type="text"
                       name="subject"
                       value="{{ $doc->subject }}"
                       required>
            </div>

            <!-- Year & Semester -->
            <div class="edit-row">
                <div class="edit-field">
                    <label>Year</label>
                    <input type="text"
                           name="year"
                           value="{{ $doc->year }}"
                           required>
                </div>

                <div class="edit-field">
                    <label>Semester</label>
                    <input type="text"
                           name="semester"
                           value="{{ $doc->semester }}"
                           required>
                </div>
            </div>

            <!-- URL TYPE -->
            @if($doc->resource_type === 'external')
                <div class="edit-field">
                    <label>Document URL</label>
                    <input type="url"
                           name="url"
                           value="{{ $doc->url }}"
                           required>
                </div>
            @endif

            <!-- FILE TYPE -->
            @if($doc->resource_type !== 'external')
                <div class="edit-field">
                    <label>Replace File (optional)</label>
                    <input type="file" name="file">
                </div>
            @endif

            <!-- ACTIONS -->
            <div class="edit-actions">
                <button type="submit" class="btn-save">
                    Save Changes
                </button>

                <a href="{{ route('my.documents') }}" class="btn-cancel">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
