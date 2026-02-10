{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Upload Resources</title>
  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      background: linear-gradient(to right, #00c9ff, #92fe9d);
      padding: 40px;
    }

    .container {
      background: white;
      padding: 30px;
      border-radius: 20px;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    h2 {
      text-align: center;
      color: #222;
    }

    label {
      font-weight: bold;
      margin-top: 20px;
      display: block;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    button {
      margin-top: 30px;
      padding: 12px 25px;
      font-size: 1rem;
      background-color: #00b894;
      color: white;
      border: none;
      border-radius: 25px;
      cursor: pointer;
    }

    button:hover {
      background-color: #019974;
    }

    .field-group {
      display: none;
    }
  </style>
</head>
<body>

  <h2>Upload Academic Resource</h2>
  <div class="container">
<form id="uploadForm" action="{{ route('resource.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

      <label for="resourceType">Resource Type</label>
      <select id="resourceType" required>
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
        <input type="url" id="url" placeholder="https://example.com">
      </div>

      <div class="field-group" id="fileGroup">
        <label for="file">Upload File</label>
        <input type="file" id="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
      </div>

      <div class="field-group" id="descGroup">
        <label for="description">Description</label>
        <textarea id="description" rows="4" placeholder="Enter details..."></textarea>
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
</body>
</html> --}}
