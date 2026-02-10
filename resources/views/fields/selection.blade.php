@extends('fields.main-field')

@section('title')
selections
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/upload.css') }}">
@endpush

@section('content')
  <h2>Upload Details</h2>

  <div class="box-main">
    <!-- Display selected field name -->
    <div id="fieldName">Field: (loading...)</div>

    <!-- Year selection -->
    <label for="year">Select Year:</label>
    <select id="year">
      <option value="">-- Select Year --</option>
      <option value="First">First Year</option>
      <option value="Second">Second Year</option>
      <option value="Third">Third Year</option>
    </select>

    <!-- Semester selection -->
    <div id="semesterSection" class="hidden">
      <label for="semester">Select Semester:</label>
      <select id="semester"></select>
    </div>

    <!-- Subject selection -->
    <div id="subjectSection" class="hidden">
      <label for="subject">Select Subject:</label>
      <select id="subject">
        <option value="">-- Select Subject --</option>
      </select>

      <div id="newSubjectDiv" class="hidden">
        <input type="text" id="newSubject" placeholder="Enter new subject name">
        <button type="button" onclick="addSubject()">Add Subject</button>
      </div>
    </div>

    <!-- Submit button -->
    <button type="button" onclick="goToResourcePage()">Submit</button>
  </div>
@endsection

@push('script')
<script>
  // Parse field from query string and update UI
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
  const semesterSelect = document.getElementById("semester");
  const subjectSelect = document.getElementById("subject");
  const semesterSection = document.getElementById("semesterSection");
  const subjectSection = document.getElementById("subjectSection");
  const newSubjectDiv = document.getElementById("newSubjectDiv");

  yearSelect.addEventListener("change", () => {
    const selectedYear = yearSelect.value;
    semesterSelect.innerHTML = '<option value="">-- Select Semester --</option>';

    if (semesterMap[selectedYear]) {
      semesterMap[selectedYear].forEach(sem => {
        const option = document.createElement("option");
        option.value = sem;
        option.textContent = "Semester " + sem;
        semesterSelect.appendChild(option);
      });
      semesterSection.classList.remove("hidden");
    } else {
      semesterSection.classList.add("hidden");
    }

    subjectSection.classList.add("hidden");
    newSubjectDiv.classList.add("hidden");
  });

  semesterSelect.addEventListener("change", () => {
    const selectedSemester = semesterSelect.value;
    subjectSelect.innerHTML = '<option value="">-- Select Subject --</option>';

    if (subjectData[selectedSemester]) {
      subjectData[selectedSemester].forEach(subject => {
        const option = document.createElement("option");
        option.value = subject;
        option.textContent = subject;
        subjectSelect.appendChild(option);
      });
    }

    const newOption = document.createElement("option");
    newOption.value = "new";
    newOption.textContent = "Create New Subject";
    subjectSelect.appendChild(newOption);

    subjectSection.classList.remove("hidden");
    newSubjectDiv.classList.add("hidden");
  });

  subjectSelect.addEventListener("change", () => {
    if (subjectSelect.value === "new") {
      newSubjectDiv.classList.remove("hidden");
    } else {
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
      newSubjectDiv.classList.add("hidden");
      alert("Subject '" + newSub + "' added!");
    }
  }

  function goToResourcePage() {
    const year = yearSelect.value;
    const semester = semesterSelect.value;
    const subject = subjectSelect.value;

    if (!year || !semester || !subject) {
      alert("Please fill all fields.");
      return;
    }

    const url = `{{ url('upload-resources') }}?field=${encodeURIComponent(field)}&year=${encodeURIComponent(year)}&semester=${encodeURIComponent(semester)}&subject=${encodeURIComponent(subject)}`;
    window.location.href = url;
    
    
  }
</script>
@endpush

