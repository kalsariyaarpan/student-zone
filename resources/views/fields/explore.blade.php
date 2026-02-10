@extends('layouts.main')

@section('title', 'Explore Resources')

@section('content')

<div class="explore-container">

    <h1 class="explore-title">Explore Resources</h1>
    <p class="explore-subtitle">
        All uploaded study materials in one place
    </p>

    <div class="explore-grid">

        @forelse($resources as $res)
        <div class="explore-card">

            <!-- COVER IMAGE -->
            <div class="card-header-type {{ strtolower($res->resource_type) }}">
    <div class="type-icon">
        @if($res->resource_type === 'pdf')
            📄
        @elseif($res->resource_type === 'notes')
            📝
        @elseif($res->resource_type === 'ppt')
            📊
        @elseif($res->resource_type === 'video')
            🎥
        @else
            📚
        @endif
    </div>

    <span class="resource-type-badge">
        {{ strtoupper($res->resource_type) }}
    </span>
</div>


            <!-- BODY -->
            <div class="card-body">
                <h3>{{ $res->title }}</h3>
                <p>{{ $res->subject }} • {{ $res->year }} Year</p>

                  <div class="card-footer">
    <span>👤
        @if($res->user)
            @auth
                @if($res->user->id === Auth::id())
                    {{ $res->user->username }}
                    <span style="color:#10B981;">(you)</span>
                @else
                    {{ $res->user->username }}
                @endif
            @else
                {{ $res->user->username }}
            @endauth
        @else
            Anonymous
        @endif
    </span>

   <a href="{{ route('resources.final', [
    'field'    => $res->field_id,
    'year'     => $res->year,
    'semester' => $res->semester,
    'subject'  => $res->subject,
    'type'     => $res->resource_type,
]) }}">
    View →
</a>

</div>


            </div>

        </div>
        @empty
            <p style="color:#94a3b8">No resources available.</p>
        @endforelse

    </div>

</div>

<style>
    /* ===============================
   RESOURCE CARD HEADER (NO IMAGE)
================================ */

.card-header-type {
    height: 120px;
    border-radius: 16px 16px 0 0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    background: linear-gradient(135deg, #0f172a, #020617);
}

.card-header-type.pdf {
    background: linear-gradient(135deg, #ef4444, #b91c1c);
}

.card-header-type.notes {
    background: linear-gradient(135deg, #22c55e, #15803d);
}

.card-header-type.ppt {
    background: linear-gradient(135deg, #f97316, #c2410c);
}

.card-header-type.video {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
}

.type-icon {
    font-size: 42px;
    opacity: 0.9;
}

.resource-type-badge {
    position: absolute;
    bottom: 10px;
    right: 12px;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 999px;
    background: rgba(255,255,255,0.2);
    color: #fff;
    backdrop-filter: blur(6px);
}

</style>
@endsection
