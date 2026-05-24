  {{-- main fields  --}}
  @extends('fields.main-field')

  {{-- @section('title') --}}

  @section('title', 'Upload Resource')

  @section('content')

  <!-- SUCCESS ANIMATION OVERLAY -->
{{-- <div id="successOverlay" class="success-overlay hidden">
  <div class="success-box">
    <svg class="checkmark" viewBox="0 0 52 52">
      <circle class="checkmark-circle" cx="26" cy="26" r="25"/>
      <path class="checkmark-check" d="M14 27l7 7 17-17"/>
    </svg>

    <h2>Upload Successful 🎉</h2>
    <p>Your resource has been added successfully.</p>
  </div>
</div> --}}



<div id="successOverlay" class="success-overlay hidden">
  <div class="success-box">
    {{-- <lottie-player
      src="https://assets10.lottiefiles.com/packages/lf20_jbrw3hcz.json"
      background="transparent"
      speed="1"
      style="width: 360px; height: 360px;"
      autoplay>
    </lottie-player> --}}




    <svg class="checkmark" viewBox="0 0 52 52">
    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
    <path class="checkmark-check" fill="none" d="M14 27 L22 35 L38 18"/>
  </svg>

    <h2>Upload Complete 🎉</h2>
    <p>Your academic resource was added successfully</p>
  </div>
</div>

{{-- 
<div class="success-box">Change Password


  <!-- PERFECT GREEN TICK -->
  <svg class="checkmark" viewBox="0 0 52 52">
    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
    <path class="checkmark-check" fill="none" d="M14 27 L22 35 L38 18"/>
  </svg>

  <h2>Upload Complete 🎉</h2>
  <p>Your academic resource was added successfully</p>

</div> --}}



@if($fields->isEmpty())
    <p style="color:red">⚠ No fields found in database</p>
@endif



<div class="progress-bar">
  <div class="progress-step active">1</div>
  <div class="progress-line"></div>
  <div class="progress-step">2</div>
  <div class="progress-line"></div>
  <div class="progress-step">3</div>
</div>

 <form id="wizardForm"
      action="{{ route('fields.upload.store') }}"
      method="POST"
      enctype="multipart/form-data">
  @csrf

    
    {{-- Step 1: Choose Field --}}
 
    {{-- <div class="step" id="step1"> --}}
      <div class="step active" id="step1">

      <h1>Choose Your Field</h1>
      <div id="fieldAlert" class="form-alert" role="alert" style="display:none;"></div>
      <div id="keyboardHint" class="keyboard-hint hidden" aria-live="polite">
        <small style="opacity:.6">Use ← → keys to navigate steps</small>
        {{-- <button type="button" id="dismissHint" class="hint-close">Got it</button> --}}
      </div>
      <div class="field-container">
        @foreach ($fields as $field)
          <div class="field-box" data-value="{{ $field->id }}">{{ $field->name }}</div>
        @endforeach
      </div>
      <input type="hidden" id="fieldInput" name="field_id"> 
    <div class="step-nav">
        <button type="button" class="auth-btn next-btn" onclick="goToStep(2)">Next</button>
    </div>
    </div>  
    

    {{-- Step 2: Upload Details --}}
  <div class="step" id="step2">
      <h2 class="page-title">Upload Details</h2>
      <div class="main-box">

      <div id="fieldName">Field: <span id="selectedFieldName">(loading...)</span></div>
      <label for="year">Select Year:</label>
        <select id="year" name="year">
          <option value="" selected disabled >-- Select Year --</option>
          <option value="First">First Year</option>
          <option value="Second">Second Year</option>
          <option value="Third">Third Year</option>
        </select>

        <div id="semesterSection" class="hidden">
          <label for="semester" >Select Semester:</label>
          <select id="semester" name="semester"></select>
        </div>

        <div id="subjectSection" class="hidden">
          <label for="subject">Select Subject:</label>
          <select id="subject" name="subject">
            <option value="" selected disabled >-- Select Subject --</option>
          </select>

          <div id="newSubjectDiv" class="hidden">
            <input type="text" id="newSubject" placeholder="Enter new subject name">
            <button type="button" class="auth-btn" onclick="addSubject()">Add Subject</button>
          </div>
        </div>

        <div class="BtnControl">
          <button type="button" class="auth-btn btn-secondary" onclick="goToStep(1)">Previous</button>
          <button type="button" class="auth-btn next-btn" onclick="goToStep(3)">Next</button>
        </div>
        
      </div>
    </div>

    {{-- Step 3: Upload Resource --}}
  <div class="step" id="step3">
      <h2 class="page-title">Upload Academic Resource</h2>
    <div class="main-box">
      <label for="resourceType">Resource Type</label>
      <select id="resourceType" name="resource_type" required>
        <option value="" selected disabled>-- Select Type --</option>
        <option value="video">Video Lecture</option>
        <option value="book">Book/Notes Link</option>
        <option value="handwritten">Handwritten Notes</option>
        <option value="assignment">Assignment</option>
        <option value="external">External Resource</option>
        <option value="project">Project Material</option>
        <option value="lab">Lab Manual</option>
      </select>

      <div class="field-group" id="urlGroup" style="display:none">
        <label for="url">URL (if applicable)</label>
        <input type="url" id="url" name="url" placeholder="https://example.com">
      </div>

      <div class="field-group" id="fileGroup" style="display:none">
        <label for="file">Upload File</label>
        <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
      </div>

        <small id="fileNamePreview" style="color:#9aa4bf;"></small>


      <div class="field-group" id="descGroup" style="display:none">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" placeholder="Enter details..."></textarea>
      </div>


      <div id="uploadProgress" class="hidden">
  <div class="progress-track">
    <div id="progressFill"></div>
  </div>
  <span id="progressText">0%</span>
</div>

      <div class="BtnControl">
        <button type="button" class="auth-btn btn-secondary" onclick="goToStep(2)">Previous</button>
        <button type="submit" class="auth-btn">Upload</button>
      </div>
      
    </div>

    {{-- <h2>Uploaded Resources</h2>
    <ul>
        @foreach ($resources as $item)
        <li>{{ $item->subject }} ({{ $item->year }} - {{ $item->semester }})</li>
      @endforeach
    </ul>  --}}

  </form>
  @endsection

  @push('scripts')

{{-- External Libraries --}}
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<script>
// document.addEventListener("DOMContentLoaded", () => {

  /* ===============================
     STEP / PROGRESS LOGIC
  =============================== */
  const steps = document.querySelectorAll(".step");
  let currentStep = 0;
  
function updateProgress(stepIndex) {
  const stepsUI = document.querySelectorAll(".progress-step");
  const lines = document.querySelectorAll(".progress-line");

  stepsUI.forEach((s, i) => {
    s.classList.toggle("active", i <= stepIndex);
  });

  lines.forEach((line, i) => {
    line.classList.toggle("active", i < stepIndex);
  });
}


  // function showStep(index) {
  //   steps.forEach((step, i) =>
  //     step.classList.toggle("hidden", i !== index)
  //   );
  //   currentStep = index;
  //   updateProgress(index);
  // }

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle("active", i === index);
  });

  currentStep = index;
  updateProgress(index);
  localStorage.setItem("wizardStep", index);

  steps[index].scrollIntoView({
    behavior: "smooth",
    block: "start"
  });
}




function showFieldAlert(message) {
  const alertBox = document.getElementById("fieldAlert");
  if (!alertBox) return;
  alertBox.textContent = message;
  alertBox.classList.add("show");
  alertBox.style.display = "block";
  setTimeout(() => {
    alertBox.classList.remove("show");
    alertBox.style.display = "none";
  }, 4500);
}

  window.goToStep = function(step) {
    const visibleIndex = Array.from(steps).findIndex(s => s.classList.contains('active'));
    const toValidate = visibleIndex === -1 ? currentStep : visibleIndex;

    if (validateStep(toValidate)) {
      showStep(step - 1);
    } else {
      showFieldAlert("Please complete all required fields.");
    }
  };

 function validateStep(stepIndex) {
  if (stepIndex === 0) {
    if (!fieldInput.value) {
      showFieldAlert("Please select a field to continue.");
      return false;
    }
  }

  if (stepIndex === 1) {
    if (!yearSelect.value) {
      showFieldAlert("Please select the year.");
      return false;
    }
    if (!semesterSelect.value) {
      showFieldAlert("Please select the semester.");
      return false;
    }
    if (!subjectSelect.value) {
      showFieldAlert("Please select the subject.");
      return false;
    }
  }

  return true;
}


  /* ===============================
     STEP 1 – FIELD SELECTION
  =============================== */
  const fieldBoxes = document.querySelectorAll(".field-box");
  const fieldInput = document.getElementById("fieldInput");
  const fieldNameLabel = document.getElementById("selectedFieldName");

  fieldBoxes.forEach(box => {
    box.addEventListener("click", () => {
      fieldBoxes.forEach(b => b.classList.remove("selected"));
      box.classList.add("selected");
      fieldInput.value = box.dataset.value;
      fieldNameLabel.textContent = box.textContent;
      localStorage.setItem("wizardFieldId", box.dataset.value);
      
        toggleNextButton(0, true); 
    });
  });

  // Restore field selection on page load
  const savedFieldId = localStorage.getItem("wizardFieldId");
  if (savedFieldId) {
    const savedBox = document.querySelector(`.field-box[data-value="${savedFieldId}"]`);
    if (savedBox) {
      savedBox.click();
    }
  }

   


  /* ===============================
     STEP 2 – YEAR / SEM / SUBJECT
  =============================== */
  const yearSelect = document.getElementById("year");
  const semesterSelect = document.getElementById("semester");
  const subjectSelect = document.getElementById("subject");
  const semesterSection = document.getElementById("semesterSection");
  const subjectSection = document.getElementById("subjectSection");
  const newSubjectDiv = document.getElementById("newSubjectDiv");

  const semesterMap = {
    First: ["1","2"],
    Second: ["3","4"],
    Third: ["5","6"]
  };

  const subjectData = {
    "1":["Mathematics I","Programming Basics"],
    "2":["Mathematics II","Digital Logic"],
    "3":["Data Structures","DBMS"],
    "4":["Operating Systems","OOP"],
    "5":["Web Tech","AI"],
    "6":["ML","Big Data"]
  };

  yearSelect.addEventListener("change", () => {
    localStorage.setItem("wizardYear", yearSelect.value);
    semesterSelect.innerHTML = '<option value="" selected disabled  >-- Select Semester --</option>';
    subjectSection.classList.add("hidden");
    newSubjectDiv.classList.add("hidden");

    if (semesterMap[yearSelect.value]) {
      semesterMap[yearSelect.value].forEach(sem => {
        semesterSelect.innerHTML += `<option value="${sem}">Semester ${sem}</option>`;
      });
      semesterSection.classList.remove("hidden");
    } else {
      semesterSection.classList.add("hidden");
    }
  });

  semesterSelect.addEventListener("change", () => {
    localStorage.setItem("wizardSemester", semesterSelect.value);
    subjectSelect.innerHTML = '<option value="" selected disabled >-- Select Subject --</option>';

    if (subjectData[semesterSelect.value]) {
      subjectData[semesterSelect.value].forEach(sub => {
        subjectSelect.innerHTML += `<option value="${sub}">${sub}</option>`;
      });
    }

    subjectSelect.innerHTML += `<option value="new">Create New Subject</option>`;
    subjectSection.classList.remove("hidden");
    newSubjectDiv.classList.add("hidden");
  });

  subjectSelect.addEventListener("change", () => {
    localStorage.setItem("wizardSubject", subjectSelect.value);
    newSubjectDiv.classList.toggle("hidden", subjectSelect.value !== "new");
      toggleNextButton(1, subjectSelect.value !== "");
  });

  window.addSubject = function () {
    const newSub = document.getElementById("newSubject").value.trim();
    if (!newSub) {
      showFieldAlert("Enter subject name");
      return;
    }

    subjectSelect.innerHTML += `<option value="${newSub}">${newSub}</option>`;
    subjectSelect.value = newSub;
    newSubjectDiv.classList.add("hidden");
  };

  /* ===============================
     STEP 3 – RESOURCE TYPE
  =============================== */
  const resourceTypeSelect = document.getElementById("resourceType");
  const urlGroup = document.getElementById("urlGroup");
  const fileGroup = document.getElementById("fileGroup");
  const descGroup = document.getElementById("descGroup");

  function resetResourceFields() {
    urlGroup.style.display = "none";
    fileGroup.style.display = "none";
    descGroup.style.display = "none";
  }

  resourceTypeSelect.addEventListener("change", () => {
    resetResourceFields();
    const type = resourceTypeSelect.value;

    if (["video","book","external"].includes(type)) {
      urlGroup.style.display = "block";
      descGroup.style.display = "block";
    } 
    else if (["handwritten","assignment","project","lab"].includes(type)) {
      fileGroup.style.display = "block";
      descGroup.style.display = "block";
    }
  });

  /* ===============================
     FORM SUBMIT + ANIMATIONS
  =============================== */

  const wizardForm = document.getElementById("wizardForm");
  const successOverlay = document.getElementById("successOverlay");

  wizardForm.addEventListener("submit", e => {
    e.preventDefault();


    const submitBtn = wizardForm.querySelector("button[type='submit']");
submitBtn.disabled = true;
submitBtn.textContent = "Uploading…";
submitBtn.style.opacity = "0.7";


    const xhr = new XMLHttpRequest();
    xhr.open("POST", wizardForm.action);

    document.getElementById("uploadProgress").classList.remove("hidden");

    
      localStorage.removeItem("wizardStep");
      localStorage.removeItem("wizardFieldId");
      localStorage.removeItem("wizardYear");
      localStorage.removeItem("wizardSemester");
      localStorage.removeItem("wizardSubject");
    
      
    xhr.upload.onprogress = e => {
      if (e.lengthComputable) {
        const percent = Math.round((e.loaded / e.total) * 100);
        document.getElementById("progressFill").style.width = percent + "%";
        document.getElementById("progressText").innerText = percent + "%";
      }
    };

    xhr.onload = () => {
      if (xhr.status === 200) {
        localStorage.removeItem("wizardStep");
        successOverlay.classList.remove("hidden");
        successOverlay.classList.add("show");

        confetti({ particleCount:150, spread:80, origin:{y:0.6} });
        // navigator.vibrate?.([100,50,100]);

        setTimeout(() => {
          window.location.href = "{{ route('my.documents') }}";
        }, 2500);
      }
    };

    xhr.send(new FormData(wizardForm));
  });


  
/* ===============================
   KEYBOARD NAVIGATION (FIXED)
=============================== */
document.addEventListener("keydown", (e) => {

  const tag = e.target.tagName.toLowerCase();
  const isTyping = ["input", "textarea", "select"].includes(tag);

  // ← ArrowLeft → Previous step (ONLY when not typing)
  if (!isTyping && e.key === "ArrowLeft" && currentStep > 0) {
    e.preventDefault();
    showStep(currentStep - 1);
  }

  // → ArrowRight → Next step
  if (!isTyping && e.key === "ArrowRight" && currentStep < steps.length - 1) {
    e.preventDefault();
    if (validateStep(currentStep)) {
      showStep(currentStep + 1);
    }
  }

  // Enter → Next step (only outside inputs)
  if (!isTyping && e.key === "Enter" && currentStep < steps.length - 1) {
    e.preventDefault();
    if (validateStep(currentStep)) {
      showStep(currentStep + 1);
    }
  }
});



  function toggleNextButton(stepIndex, isValid) {
  const btn = document.querySelector(`#step${stepIndex + 1} .next-btn`);
  if (!btn) return;

  btn.disabled = !isValid;
  btn.style.opacity = isValid ? "1" : "0.5";
}


  /* ===============================
   FILE PREVIEW (CLIENT UX)
=============================== */
const fileInput = document.getElementById("file");
const filePreview = document.getElementById("fileNamePreview");

if (fileInput && filePreview) {
  fileInput.addEventListener("change", () => {
    filePreview.textContent = fileInput.files.length
      ? `Selected: ${fileInput.files[0].name}`
      : "";
  });
}





  // INIT
  // INIT
const savedStep = parseInt(localStorage.getItem("wizardStep"), 10);

// Restore year/semester/subject selections
const savedYear = localStorage.getItem("wizardYear");
const savedSemester = localStorage.getItem("wizardSemester");
const savedSubject = localStorage.getItem("wizardSubject");

if (savedYear) {
  yearSelect.value = savedYear;
  yearSelect.dispatchEvent(new Event("change"));
  
  if (savedSemester) {
    setTimeout(() => {
      semesterSelect.value = savedSemester;
      semesterSelect.dispatchEvent(new Event("change"));
      
      if (savedSubject) {
        setTimeout(() => {
          subjectSelect.value = savedSubject;
          subjectSelect.dispatchEvent(new Event("change"));
        }, 50);
      }
    }, 50);
  }
}

if (!isNaN(savedStep) && savedStep < steps.length) {
  showStep(savedStep);
} else {
  showStep(0);
}




  // Show keyboard hint once for first-time users
  function showKeyboardHintIfNeeded() {
    try {
      const HINT_KEY = 'fieldKeyboardHintShown';
      const hintEl = document.getElementById('keyboardHint');
      const dismiss = document.getElementById('dismissHint');
      if (!hintEl || !dismiss) return;

      if (!localStorage.getItem(HINT_KEY)) {
        hintEl.classList.remove('hidden');

        const hide = function(e) {
          if (e) {
            e.preventDefault();
            e.stopPropagation();
          }
          hintEl.classList.add('hidden');
          localStorage.setItem(HINT_KEY, '1');
          document.removeEventListener('keydown', onAnyArrow);
          dismiss.removeEventListener('click', hide);
        };

        dismiss.addEventListener('click', hide, false);

        const onAnyArrow = function(e) {
          if (['ArrowLeft','ArrowRight','Enter'].includes(e.key)) {
            hide(e);
          }
        };

        document.addEventListener('keydown', onAnyArrow);
      }
    } catch (err) {
      console.error('Keyboard hint error:', err);
    }
  }

  showKeyboardHintIfNeeded();
  
  
  
  
  
  
  // showStep(0);







</script>

@endpush



  
