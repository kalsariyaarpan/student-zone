{{-- 3 resoureces  --}}
@extends('fields.main-field')

@section('content')
@php
    $typeLabels = [
        'video' => 'Video Lecture',
        'book' => 'Book/Notes',
        'handwritten' => 'Handwritten Notes',
        'assignment' => 'Assignment',
        'external' => 'External Resource',
        'project' => 'Project Material',
        'lab' => 'Lab Manual',
    ];
    $typeHeading = $typeLabels[$type] ?? ucfirst($type);
@endphp

<div class="resources-header mb-3">
    <h2 class="m-0">Resources: {{ $typeHeading }}</h2>
  
    </div>

<div class="table-responsive">
<table class="table resources-table align-middle">
    <thead>
        <tr>
            <th style="width: 160px;">Type</th>
            {{-- <th>Details</th> --}}
            <th style="width: 160px;">View & Download</th>
        </tr>
    </thead>
       {{-- <tbody>
        @forelse ($resources as $resource)
            @php
                $downloadUrl = !empty($resource->file) ? Storage::disk('public')->url($resource->file) : null;
                $viewUrl = $resource->url ?: $downloadUrl;
                $label = $typeLabels[$resource->resource_type] ?? ucfirst($resource->resource_type);
            @endphp
            <tr>
                <td>
                    <span class="badge bg-primary">{{ $label }}</span>
                </td>
                //old code
                {{-- <td>
                    <div>{{ $resource->description ?? 'No description' }}</div>
                    @if (!empty($resource->url))
                        <div class="small text-muted mt-1">Link: <a href="{{ $resource->url }}" target="_blank">{{ $resource->url }}</a></div>
                    @endif
                    @if ($downloadUrl)
                        <div class="small text-muted">File: <a href="{{ $downloadUrl }}" target="_blank">{{ basename($resource->file) }}</a></div>
                    @endif
                </td> --}}
                {{-- @dd($viewUrl , $downloadUrl) --}}
                
                    {{--<td>
                    @if ($viewUrl)
                        <a href="{{ $viewUrl }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="View">
                            👁️ View
                        </a>
                    @endif
                    @if ($downloadUrl)
                        <a href="{{ $downloadUrl }}" download class="btn btn-sm btn-primary ms-1" title="Download">
                            📥 Download
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No resources available.</td></tr>
        @endforelse
    </tbody>--}}

    <tbody>
    @forelse($resources as $res)
        <tr>
            <td>{{ $res->resource_type }}</td>
            <td>
                {{-- {{ $res->description ?? 'No description' }} --}}

                {{-- If file exists --}}
                @if($res->file)
                    <a href="{{ asset('storage/' . $res->file) }}" target="_blank" class="btn btn-sm btn-primary">👁️ View</a>
                    <a href="{{ asset('storage/' . $res->file) }}" download class="btn btn-sm btn-success">📥 Download</a>
                @endif

                {{-- If URL exists --}}
                @if($res->url)
                    <a href="{{ $res->url }}" target="_blank" class="btn btn-sm btn-info">🌐 Open Link</a>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="2">No resources found</td>
        </tr>
    @endforelse
</tbody>

</table>
</div>
@endsection
