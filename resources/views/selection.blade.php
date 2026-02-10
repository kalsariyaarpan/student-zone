  {{-- <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Upload Student Resources</title> --}}
    {{-- <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(to right, #fc466b, #3f5efb);
        margin: 0;
        padding: 40px 20px;
        color: white;
      }

      h2 {
        text-align: center;
        font-size: 2.5rem;
      }

      .box {
        background: white;
        color: #333;
        padding: 30px;
        border-radius: 20px;
        max-width: 700px;
        margin: auto;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      }

      label {
        font-weight: bold;
        margin-top: 20px;
        display: block;
      }

      select, input[type="text"], input[type="url"], input[type="file"] {
        width: 100%;
        padding: 12px;
        margin-top: 8px;
        border-radius: 10px;
        border: 2px solid #ccc;
        font-size: 1rem;
      }

      button {
        margin-top: 25px;
        padding: 12px 25px;
        font-size: 1rem;
        background-color: #3f5efb;
        color: white;
        border: none;
        border-radius: 25px;
        cursor: pointer;
      }

      button:hover {
        background-color: #2f3ecc;
      }

      .hidden {
        display: none;
      }
    </style> --}}

  @extends('fields.main-field')   {{-- no stray space! --}}

  @section('title')
  selections
  @endsection


  @section('content')

    <h2>Upload Details</h2>

    <div class="box-main">
      <div id="fieldName">Field: (loading...)</div>

      <!-- Step 1: Year -->
      <label for="year">Select Year:</label>
      <select id="year">
        <option value="">-- Select Year --</option>
        <option value="First">First Year</option>
        <option value="Second">Second Year</option>
        <option value="Third">Third Year</option>
      </select>

      <!-- Step 2: Semester -->
      <div id="semesterSection" class="hidden">
        <label for="semester">Select Semester:</label>
        <select id="semester"></select>
      </div>

      <!-- Step 3: Subject -->
      <div id="subjectSection" class="hidden">
        <label for="subject">Select Subject:</label>
        <select id="subject">
          <option value="">-- Select Subject --</option>
        </select>
        <div id="newSubjectDiv" class="hidden">
          <input type="text" id="newSubject" placeholder="Enter new subject name">
          <button onclick="addSubject()">Add Subject</button>
        </div>
      </div>

      <!-- Step 4: Upload Resources
      <form id="uploadForm" class="hidden">
        <label>Video/Book URL:</label>
        <input type="url" placeholder="https://example.com">

        <label>Upload Image:</label>
        <input type="file" accept="image/*">

        <label>Upload Notes (PDF/DOC):</label>
        <input type="file" accept=".pdf,.doc,.docx"> -->

        <button type="button" onclick="goToResourcePage()">Submit</button>

      @endsection
  @push('script ')
  <script>
    function goToResourcePage() {
      const year = document.getElementById("year").value;
      const semester = document.getElementById("semester").value;
      const subject = document.getElementById("subject").value;

      if (!year || !semester || !subject) {
        alert("Please fill all fields");
        return;
      }

      // Redirect to the upload-resources.html page with query parameters
      const url = `upload-resources.html?year=${encodeURIComponent(year)}&semester=${encodeURIComponent(semester)}&subject=${encodeURIComponent(subject)}`;
      window.location.href = url;
    }
  </script>

    
    <script>
      // Extract field from URL
      const urlParams = new URLSearchParams(window.location.search);
  const field = urlParams.get('field') || 'Unknown';
  document.getElementById('fieldName').textContent = "Field: " + field;


      const semesterMap = {
        "First": ["1", "2"],
        "Second": ["3", "4"],
        "Third": ["5", "6"]
      };

      const subjectData = {
        "1": ["Mathematics I", "Programming Basics"],
        "2": ["Mathematics II", "Digital Logic"],
        "3": ["Data Structures", "DBMS"],
        "4": ["Operating Systems", "OOP"],
        "5": ["Web Tech", "AI"],
        "6": ["ML", "Big Data"]
      };

      const yearSelect = document.getElementById("year");
      const semesterSection = document.getElementById("semesterSection");
      const semesterSelect = document.getElementById("semester");
      const subjectSection = document.getElementById("subjectSection");
      const subjectSelect = document.getElementById("subject");
      const uploadForm = document.getElementById("uploadForm");
      const newSubjectDiv = document.getElementById("newSubjectDiv");

      yearSelect.addEventListener("change", () => {
        const selectedYear = yearSelect.value;
        semesterSelect.innerHTML = '<option value="">-- Select Semester --</option>';
        if (semesterMap[selectedYear]) {
          semesterMap[selectedYear].forEach(sem => {
            const opt = document.createElement("option");
            opt.value = sem;
            opt.textContent = "Semester " + sem;
            semesterSelect.appendChild(opt);
          });
          semesterSection.classList.remove("hidden");
        } else {
          semesterSection.classList.add("hidden");
        }
        subjectSection.classList.add("hidden");
        uploadForm.classList.add("hidden");
      });

      semesterSelect.addEventListener("change", () => {
        const sem = semesterSelect.value;
        subjectSelect.innerHTML = '<option value="">-- Select Subject --</option>';
        if (subjectData[sem]) {
          subjectData[sem].forEach(sub => {
            const opt = document.createElement("option");
            opt.value = sub;
            opt.textContent = sub;
            subjectSelect.appendChild(opt);
          });
        }
        const newOpt = document.createElement("option");
        newOpt.value = "new";
        newOpt.textContent = "Create New Subject";
        subjectSelect.appendChild(newOpt);

        subjectSection.classList.remove("hidden");
        uploadForm.classList.add("hidden");
        newSubjectDiv.classList.add("hidden");
      });

      subjectSelect.addEventListener("change", () => {
        if (subjectSelect.value === "new") {
          newSubjectDiv.classList.remove("hidden");
          uploadForm.classList.add("hidden");
        } else if (subjectSelect.value !== "") {
          newSubjectDiv.classList.add("hidden");
          uploadForm.classList.remove("hidden");
        } else {
          uploadForm.classList.add("hidden");
          newSubjectDiv.classList.add("hidden");
        }
      });

      function addSubject() {
        const newSub = document.getElementById("newSubject").value.trim();
        if (newSub !== "") {
          const newOption = document.createElement("option");
          newOption.value = newSub;
          newOption.textContent = newSub;
          subjectSelect.appendChild(newOption);
          subjectSelect.value = newSub;
          uploadForm.classList.remove("hidden");
          newSubjectDiv.classList.add("hidden");
          alert("Subject '" + newSub + "' added!");
        }
      }

      uploadForm.addEventListener("submit", function (e) {
        e.preventDefault();
        alert("Resources submitted successfully!");
      });

        
    </script>
  @endpush
