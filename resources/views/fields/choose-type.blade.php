{{-- 2 resoureces  --}}
@extends('fields.main-field')

@section('content')

<h3 class="mb-3">Select Resource Type</h3>

@php
$types = [
    ['code' => 'video', 'label' => 'Video Lecture'],
    ['code' => 'book', 'label' => 'Book/Notes'],
    ['code' => 'handwritten', 'label' => 'Handwritten Notes'],
    ['code' => 'assignment', 'label' => 'Assignment'],
    ['code' => 'external', 'label' => 'External Resource'],
    ['code' => 'project', 'label' => 'Project Material'],
    ['code' => 'lab', 'label' => 'Lab Manual'],
];
@endphp

<div class="mb-4 table-responsive">
  <table class="resources-table" style="width:100%">
    <thead>
      <tr>
        <th style="width: 120px;">Resource No</th>
        <th>Type Name</th>
        <th style="width: 140px;">Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($types as $index => $t)
        <tr>
          <td>#{{ $index + 1 }}</td>
          <td>{{ $t['label'] }}</td>
          <td>
            <form action="{{ route('resources.final') }}" method="GET">
              <input type="hidden" name="field" value="{{ $field }}">
              <input type="hidden" name="year" value="{{ $year }}">
              <input type="hidden" name="semester" value="{{ $semester }}">
              <input type="hidden" name="subject" value="{{ $subject }}">
              <input type="hidden" name="type" value="{{ $t['code'] }}">
              <button type="submit">Select</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-muted">No types available.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<a class="back-link" href="{{ route('resources.select') }}">Back</a>
@endsection 
