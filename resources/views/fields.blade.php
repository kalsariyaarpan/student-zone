{{-- @extends('fields.main-field s')
@section('title')
fields
@endsection
@section('fields-content')
 --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Choose Your Field</title>
  <style> --}}
    
    {{-- /* body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
    }

    h1 {
      margin-bottom: 30px;
      font-size: 2.5rem;
      background: -webkit-linear-gradient(#fff, #ccc);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .field-container {
      display: grid;
      grid-template-columns: repeat(2, minmax(200px, 1fr));
      gap: 20px;
      max-width: 800px;
      width: 100%;
    }

    .field-box {
      background-color: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border-radius: 15px;
      text-align: center;
      font-weight: bold;
      font-size: 1.2rem;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 2px solid transparent;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .field-box:hover {
      background-color: rgba(255, 255, 255, 0.2);
      transform: scale(1.05);
    }

    .field-box.selected {
      background-color: #ffffff;
      color: #2575fc;
      border-color: #fff;
    }

    .submit-btn {
      margin-top: 30px;
      padding: 12px 25px;
      background-color: white;
      color: #2575fc;
      border: none;
      border-radius: 25px;
      font-size: 1rem;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #f1f1f1;
      transform: scale(1.05);
    } */ --}}
  {{-- </style> --}}
{{-- </head>
<body> --}}
{{-- 
  <h1>Choose Your Field</h1>

  <div class="field-container">
    <div class="field-box" data-value="msc-it">M.Sc. IT</div>
    <div class="field-box" data-value="be">B.E.</div>
    <div class="field-box" data-value="civil">Civil Engineering</div>
    <div class="field-box" data-value="computer">Computer Engineering</div>
    <div class="field-box" data-value="mechanical">Mechanical Engineering</div>
    <div class="field-box" data-value="electrical">Electrical Engineering</div>
    <div class="field-box" data-value="ec">Electronics & Comm.</div>
    <div class="field-box" data-value="it">Information Technology</div>
    <div class="field-box" data-value="bca">BCA</div>
    <div class="field-box" data-value="mca">MCA</div>
    <div class="field-box" data-value="bsc-it">B.Sc. IT</div>
    <div class="field-box" data-value="other">Other</div>
  </div>
<!-- <button >Next</button> -->
  <button class="submit-btn" onclick="openUploadPage()">Submit</button>

   --}}

{{-- <script>
  let selected = null;

  // When a box is clicked
  document.querySelectorAll('.field-box').forEach(box => {
    box.addEventListener('click', () => {
      document.querySelectorAll('.field-box').forEach(b => b.classList.remove('selected'));
      box.classList.add('selected');
      selected = box.dataset.value;
    });
  });

  // When the user clicks "Next"
  function openUploadPage() {
    if (!selected) {
      alert("Please select a field.");
      return;
    }

    // Open selection.html with field name as URL parameter
    const url = `selection.html?field=${encodeURIComponent(selected)}`;
    window.open(url, '_blank');
  }
</script>

  <!-- </script> -->

</body> --}}
{{-- </html>
@endsection --}}