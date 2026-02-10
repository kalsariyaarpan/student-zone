@extends('fields.main-field')
@section('content')

<style>
   /* ===============================
   GLOBAL THEME (same as login)
   =============================== */
/* ===============================
   GLOBAL THEME (same as login)
   =============================== */

body {
  background: linear-gradient(135deg, #1c1c1e, #313133);
  color: white;
  /* padding: 40px 20px; */
  min-height: 100vh;
  font-family: "Poppins", sans-serif;
}

.page-title, h2, h4 {
  text-align: center;
  font-size: 2rem;
  background: -webkit-linear-gradient(#fff, #bcd8f6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 20px;
}

/* MAIN CARD */
.main-box {
  background: #222;
  padding: 30px;
  border-radius: 20px;
  width: 95%;
  max-width: 850px;
  margin: 0 auto 25px;
  box-shadow: 0 0 35px rgba(0, 255, 234, 0.12);
}

/* STEP HANDLING */
.step-section {
  display: none;
}

.step-section.active {
  display: block;
}

/* INPUTS */
select, input {
  width: 100%;
  padding: 12px;
  background: #2a3146;
  border: none;
  border-radius: 12px;
  color: white;
  margin-bottom: 15px;
}

select:focus, input:focus {
  outline: 2px solid #10a3d7;
}

/* BUTTONS (same as login/register) */
.theme-btn {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 12px;
  background: #10a3d7;
  font-weight: 600;
  color: #1c1c1e;
  cursor: pointer;
  margin-top: 10px;
  transition: 0.25s;
}

.theme-btn:hover {
  background: #0d8bb7;
}

/* BACK BUTTON */
.back-btn {
  background: #444;
  color: white;
}

.back-btn:hover {
  background: #555;
}

/* RESOURCE TYPE BUTTONS */
.resource-type-btn {
  padding: 12px;
  width: 100%;
  border-radius: 12px;
  border: 1px solid #10a3d7;
  background: rgba(16, 163, 215, 0.12);
  color: #10a3d7;
  font-weight: 600;
  transition: 0.25s;
}

.resource-type-btn:hover {
  background: #10a3d7;
  color: #1c1c1e;
}

/* RESOURCE TABLE */
.resource-table {
  width: 100%;
  border-radius: 12px;
  overflow: hidden;
  border: 1px solid #10a3d7;
  background: #222;
}

.resource-table thead {
  background: #10a3d7;
  color: #1c1c1e;
  font-size: 1.1rem;
}

.resource-table td, .resource-table th {
  padding: 12px;
  border-bottom: 1px solid #444;
}

.resource-table tr:hover {
  background: rgba(255, 255, 255, 0.05);
}

.open-link {
  padding: 5px 12px;
  background: #10a3d7;
  color: #1c1c1e;
  border-radius: 8px;
  text-decoration: none;
}

.open-link:hover {
  background: #0d8bb7;
}

</style>

<div class="main-box step-section active" id="step1">
    <h2 class="page-title">🎓 View Academic Resources</h2>

    <div class="row">
        <div class="col-md-3">
            <label>Select Field</label>
            <select id="field">
                <option value="">-- Select Field --</option>
                <option>MSC IT</option>
                <option>B.E.</option>
                <option>Computer Engineering</option>
                <option>Mechanical Engineering</option>
                <option>Electrical Engineering</option>
                <option>BCA</option>
                <option>MCA</option>
                <option>B.Sc. IT</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Select Year</label>
            <select id="year">
                <option value="">-- Select Year --</option>
                <option>1st Year</option>
                <option>2nd Year</option>
                <option>3rd Year</option>
                <option>4th Year</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Select Semester</label>
            <select id="semester">
                <option value="">-- Select Semester --</option>
                <option>Sem 1</option>
                <option>Sem 2</option>
                <option>Sem 3</option>
                <option>Sem 4</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Select Subject</label>
            <select id="subject">
                <option value="">-- Select Subject --</option>
                <option>OS</option>
                <option>Data Structures</option>
                <option>DBMS</option>
                <option>AI</option>
                <option>
Mathematics I
</option>
            </select>
        </div>
    </div>

    <button class="theme-btn" onclick="goStep2()">Next</button>
</div>


<!-- STEP 2 -->
<div class="main-box step-section" id="step2">
    <h2 class="page-title">Select Resource Type</h2>

    <div class="row">
        @php
            $types = ["Video Lecture", "Book/Notes", "Handwritten Notes", "Assignment", "External Resource", "Project Material", "Lab Manual"];
        @endphp

        @foreach($types as $t)
        <div class="col-md-4 mb-3">
            <button class="resource-type-btn" onclick="showResources('{{ $t }}')">
                {{ $t }}
            </button>
        </div>
        @endforeach
    </div>

    <button class="theme-btn back-btn" onclick="backStep1()">⬅ Back</button>
</div>


<!-- STEP 3 -->
<div class="main-box step-section" id="step3">
    <h2 class="page-title" id="resourceTypeTitle">Resources</h2>

    <table class="resource-table mt-3">
        <thead>
            <tr>
                <th>Resource Type</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody id="resourceTableBody"></tbody>
    </table>

    <button class="theme-btn back-btn" onclick="backStep2()">⬅ Back</button>
</div>


    <script>
   function goStep2() {
    const ids = ["field", "year", "semester", "subject"];
    for (let id of ids) {
        if (!document.getElementById(id).value) {
            alert("Please complete all fields.");
            return;
        }
    }
    step1.classList.remove("active");
    step2.classList.add("active");
}

function backStep1() {
    step2.classList.remove("active");
    step1.classList.add("active");
}

function backStep2() {
    step3.classList.remove("active");
    step2.classList.add("active");
}

function showResources(type) {
    resourceTypeTitle.textContent = type + " Resources";
    step2.classList.remove("active");
    step3.classList.add("active");

    resourceTableBody.innerHTML = `
        <tr>
            <td>${type}</td>
            <td>Sample description <a href="#" class="open-link">Open</a></td>
        </tr>`;
}

</script>

@endsection
