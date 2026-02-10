{{-- main resoureces view --}}
@extends('fields.main-field')

@section('content')

{{-- 
    STEP HANDLING:
    Controller will pass: $step = 1 / 2 / 3
    Example:
        return view('resources.select', ['step' => 1]);
--}}
@php


    $types = $types ?? [
        ['code' => 'video', 'label' => 'Video Lecture'],
        ['code' => 'book', 'label' => 'Book / Notes'],
        ['code' => 'handwritten', 'label' => 'Handwritten Notes'],
        ['code' => 'assignment', 'label' => 'Assignment'],
        ['code' => 'external', 'label' => 'External Resource'],
        ['code' => 'project', 'label' => 'Project Material'],
        ['code' => 'lab', 'label' => 'Lab Manual'],
    ];

    $resources = $resources ?? [];

    $typeLabels = [
        'video' => 'Video Lecture',
        'book' => 'Book/Notes',
        'handwritten' => 'Handwritten Notes',
        'assignment' => 'Assignment',
        'external' => 'External Resource',
        'project' => 'Project Material',
        'lab' => 'Lab Manual',
    ];

    $currentTypeKey = $type ?? ($resources[0]->resource_type ?? null);

    $typeHeading = $currentTypeKey
        ? ($typeLabels[$currentTypeKey] ?? ucfirst($currentTypeKey))
        : 'Resources';




    $resources = $resources ?? [];
    $currentTypeKey = $type ?? ($resources[0]->resource_type ?? null);
    $typeHeading = $currentTypeKey
        ? ($typeLabels[$currentTypeKey] ?? ucfirst($currentTypeKey))
        : 'Resources';
@endphp





<div class="main-box">

    {{-- ---------------------------------------------------------
        STEP 1 → SELECT FIELD, YEAR, SEMESTER, SUBJECT
    ---------------------------------------------------------- --}}
    <div class="step-section {{ $step == 1 ? 'active' : '' }}">
        <h2 class="page-title">Select Resource Filters</h2>

        <form method="GET" action="{{ route('resources.chooseType') }}">

            <label class="form-label">Field</label>
            <select name="field" class="{{ $errors->has('field') ? 'input-error' : '' }}">
                <option disabled selected>Select Field</option>
                @isset($fields)
  @foreach ($fields as $fieldItem)
    <option value="{{ $fieldItem->id }}">{{ $fieldItem->name }}</option>
  @endforeach
@endisset

            </select>
            @error('field')
            <div class="field-error">{{ $message }}</div>
            @enderror


            <label class="form-label">Year</label>
    <select name="year" class="{{ $errors->has('year') ? 'input-error' : '' }}">
    <option disabled selected>Select Year</option>
    <option value="First" {{ old('year') == 'First' ? 'selected' : '' }}>First Year</option>
    <option value="Second" {{ old('year') == 'Second' ? 'selected' : '' }}>Second Year</option>
    <option value="Third" {{ old('year') == 'Third' ? 'selected' : '' }}>Third Year</option>
    </select>
    @error('year')
    <div class="field-error">{{ $message }}</div>
    @enderror


          <label class="form-label">Semester</label>
<select name="semester" class="{{ $errors->has('semester') ? 'input-error' : '' }}">
    <option disabled selected>Select Semester</option>
    @for ($i = 1; $i <= 6; $i++)
        <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>
            Semester {{ $i }}
        </option>
    @endfor
</select>
@error('semester')
  <div class="field-error">{{ $message }}</div>
@enderror


            <label class="form-label">Subject</label>
    <input type="text"
       name="subject"
       value="{{ old('subject') }}"
       placeholder="Enter Subject"
       class="{{ $errors->has('subject') ? 'input-error' : '' }}">

        @error('subject')
        <div class="field-error">{{ $message }}</div>
        @enderror


            <button class="theme-btn" type="submit">Next</button>
        </form>
    </div>

    {{-- ---------------------------------------------------------
        STEP 2 → SELECT RESOURCE TYPE
    ---------------------------------------------------------- --}}
    <div class="step-section {{ $step == 2 ? 'active' : '' }}">
        <h2 class="page-title">Select Resource Type</h2>

        <table class="resource-table">
            <thead>
                <tr>
                    <th style="width: 120px;">#</th>
                    <th>Type Name</th>
                    <th style="width: 140px;">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($types as $i => $t)
                <tr>
                    <td>#{{ $i + 1 }}</td>
                    <td>{{ $t['label'] }}</td>
                    <td>
                        <form action="{{ route('resources.final') }}" method="GET">
                            <input type="hidden" name="field" value="{{ $field ?? '' }}">
                            <input type="hidden" name="year" value="{{ $year ?? '' }}">
                            <input type="hidden" name="semester" value="{{ $semester ?? '' }}">
                            <input type="hidden" name="subject" value="{{ $subject ?? '' }}">
                            <input type="hidden" name="type" value="{{ $t['code'] }}">
                            <button class="resource-type-btn" type="submit">Select</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <a href="javascript:void(0)" class="theme-btn back-btn">Back</a>


    </div>

    {{-- ---------------------------------------------------------
        STEP 3 → RESOURCE LIST (View + Download)
    ---------------------------------------------------------- --}}
    <div class="step-section {{ $step == 3 ? 'active' : '' }}">
       <h2 class="page-title">Resources: {{ $typeHeading }}</h2>


        <table class="resource-table">
            <thead>
                <tr>
                <th style="width:160px;">Type</th>
                <th style="width:260px;">View & Download</th>
                <th>Uploaded By</th>
            </tr>
            </thead>

            <tbody>
                @forelse ($resources as $res)
                <tr>
                    <td>
                        <span style="font-weight:600; color:#10a3d7;">
                            {{ $res->resource_type }}
                        </span>
                        

                    </td>

                    <td>
                        {{-- View file --}}
                        @if($res->file)
                            <a href="{{ asset('storage/'.$res->file) }}" target="_blank" class="open-link">👁️ View</a>
                            <a href="{{ asset('storage/'.$res->file) }}" download class="open-link" style="background:#28d77d;">📥 Download</a>
                        @endif

                        {{-- External URL --}}
                        @if($res->url)
                            <a href="{{ $res->url }}" target="_blank" class="open-link" style="background:#0d8bb7;">
                                🌐 Open Link
                            </a>
                        @endif
                        <td>
                        @php
                          $uploader = $res->user->username ?? 'Unknown';
                        @endphp

                        @if($res->uploaded_by == Auth::id())
                            {{ $uploader }} <span style="color: #10B981;">(you)</span>
                        @else
                            {{ $uploader }}
                        @endif
                        
                    
                    </td>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" style="text-align:center; padding:20px;">
                        No resources found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <br>
        <a href="javascript:void(0)" class="theme-btn back-btn">Back</a>

    </div>

</div>


<script>
document.addEventListener("DOMContentLoaded", () => {

  /* ===============================
     UTILITIES
  =============================== */
  function clearErrors(form) {
    form.querySelectorAll(".error-text").forEach(e => e.remove());
    form.querySelectorAll("input, select").forEach(el => {
      el.classList.remove("error-field");
    });
  }

  function showError(el, message) {
    el.classList.add("error-field");

    const error = document.createElement("div");
    error.className = "error-text";
    error.innerHTML = `⚠ ${message}`;

    el.closest("label")?.appendChild(error) ||
    el.parentElement.appendChild(error);

    el.focus();
  }

  /* ===============================
     STEP 1 – HARD VALIDATION
  =============================== */
  const step1Form = document.querySelector(
    'form[action*="resources.chooseType"]'
  );

  if (step1Form) {
    step1Form.addEventListener("submit", (e) => {
      e.preventDefault(); // ⛔ ALWAYS BLOCK FIRST

      clearErrors(step1Form);

      const field = step1Form.querySelector('[name="field"]');
      const year = step1Form.querySelector('[name="year"]');
      const semester = step1Form.querySelector('[name="semester"]');
      const subject = step1Form.querySelector('[name="subject"]');

      if (field.selectedIndex === 0) {
        return showError(field, "Please select your field.");
      }

      if (year.selectedIndex === 0) {
        return showError(year, "Please select academic year.");
      }

      if (semester.selectedIndex === 0) {
        return showError(semester, "Please select semester.");
      }

      if (!subject.value.trim()) {
        return showError(subject, "Subject name is required.");
      }

      // ✅ ALL VALID
      const btn = step1Form.querySelector("button[type='submit']");
      btn.disabled = true;
      btn.textContent = "Loading…";
      btn.style.opacity = "0.6";

      step1Form.submit();
    });
  }

  /* ===============================
     STEP 2 – SAFETY + BACK FIX
  =============================== */
  document.querySelectorAll(
    'form[action*="resources.final"]'
  ).forEach(form => {
    form.addEventListener("submit", e => {
      const required = ["field", "year", "semester", "subject", "type"];
      for (let r of required) {
        const input = form.querySelector(`[name="${r}"]`);
        if (!input || !input.value) {
          e.preventDefault();
          alert("⚠ Missing required filter data.\nPlease go back and try again.");
          return;
        }
      }
    });
  });

  /* ===============================
     STEP 2 & 3 – BACK BUTTON (SMART)
  =============================== */
  document.querySelectorAll(".back-btn").forEach(btn => {
    btn.addEventListener("click", e => {
      e.preventDefault();
      window.history.back();
    });
  });

});





document.addEventListener("DOMContentLoaded", () => {

  /* ===============================
     HELPER FUNCTIONS
  =============================== */
  function showError(el, message) {
    removeError(el);

    el.classList.add("input-error");

    const error = document.createElement("div");
    error.className = "field-error";
    error.innerText = message;

    el.insertAdjacentElement("afterend", error);
  }

  function removeError(el) {
    el.classList.remove("input-error");
    const next = el.nextElementSibling;
    if (next && next.classList.contains("field-error")) {
      next.remove();
    }
  }

  /* ===============================
     FIELD REFERENCES
  =============================== */
  const field    = document.querySelector('[name="field"]');
  const year     = document.querySelector('[name="year"]');
  const semester = document.querySelector('[name="semester"]');
  const subject  = document.querySelector('[name="subject"]');

  /* ===============================
     REAL-TIME VALIDATION RULES
  =============================== */

  if (field) {
    field.addEventListener("change", () => {
      field.selectedIndex === 0
        ? showError(field, "Please select a field.")
        : removeError(field);
    });
  }

  if (year) {
    year.addEventListener("change", () => {
      year.selectedIndex === 0
        ? showError(year, "Please select academic year.")
        : removeError(year);
    });
  }

  if (semester) {
    semester.addEventListener("change", () => {
      semester.selectedIndex === 0
        ? showError(semester, "Please select semester.")
        : removeError(semester);
    });
  }

  if (subject) {
    subject.addEventListener("input", () => {
      if (!subject.value.trim()) {
        showError(subject, "Subject name is required.");
      } else if (subject.value.length < 2) {
        showError(subject, "Subject must be at least 2 characters.");
      } else {
        removeError(subject);
      }
    });
  }

});
</script>



@endsection
