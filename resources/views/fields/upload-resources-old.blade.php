@extends('layouts.main')
@section('title')
upload-resources
@endsection
{{-- 
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/upload.css') }}">
@endpush --}}

@section('content')
    <div class="container mb-3" style="max-width: 700px;">
      <a href="{{ url('/') }}" class="btn btn-outline-primary">
        <i class="bi bi-house-door"></i> Home
      </a>
    </div>
    
  <h2>Upload Academic Resource</h2>
  <div class="container">
     <form id="uploadForm" action="{{ route('fields.upload.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

      <label for="resourceType">Resource Type</label>
      <select id="resourceType" name="resource_type" required> 
        <option value="">-- Select Type --</option>
        <option value="video">Video Lecture</option>
        <option value="book">Book/Notes Link</option>
        <option value="handwritten">Handwritten Notes</option>
        <option value="assignment">Assignment</option>
        <option value="external">External Resource</option>
        <option value="project">Project Material</option>
        <option value="lab">Lab Manual</option>
      </select>

      <div class="field-group" id="urlGroup">
        <label for="url">URL (if applicable)</label>
         <input type="url" id="url" name="url" placeholder="https://example.com"> 
      </div>

      <div class="field-group" id="fileGroup">
        <label for="file">Upload File</label>
        <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"> 
      </div>

      <div class="field-group" id="descGroup">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" placeholder="Enter details..."></textarea>
      </div>

      <button type="submit">Upload</button>
    </form>
  </div>    
  
   <script>
    const typeSelector = document.getElementById("resourceType");
    const urlGroup = document.getElementById("urlGroup");
    const fileGroup = document.getElementById("fileGroup");
    const descGroup = document.getElementById("descGroup");

    typeSelector.addEventListener("change", function () {
      const type = this.value;
      urlGroup.style.display = "none";
      fileGroup.style.display = "none";
      descGroup.style.display = "none";

      if (type === "video") urlGroup.style.display = "block";
      else if (type === "book") {
        urlGroup.style.display = "block";
        descGroup.style.display = "block";
      }
      else if (type === "handwritten") fileGroup.style.display = "block";
      else if (type === "assignment") {
        fileGroup.style.display = "block";
        descGroup.style.display = "block";
      }
      else if (type === "external") {
        urlGroup.style.display = "block";
        descGroup.style.display = "block";
      }
      else if (type === "project") {
        fileGroup.style.display = "block";
        urlGroup.style.display = "block";
        descGroup.style.display = "block";
      }
      else if (type === "lab") {
        fileGroup.style.display = "block";
      }
    });

  </script>
@endsection