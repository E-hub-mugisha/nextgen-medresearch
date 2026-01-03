<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $project->title }}</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 40px;
            color: #000;
        }

        .title-page {
            text-align: center;
            margin-top: 120px;
        }

        .title-page h1 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .meta {
            margin-top: 20px;
            font-size: 14px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 40px;
            margin-bottom: 5px;
            text-transform: uppercase;
            border-bottom: 1px solid #333;
            padding-bottom: 5px;
        }

        .content {
            font-size: 14px;
            line-height: 1.6;
            text-align: justify;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            font-size: 12px;
            text-align: center;
            width: 100%;
        }

        .collaborators {
            margin-top: 10px;
        }

        .collaborators li {
            margin-bottom: 4px;
        }

        .badge {
            display: inline-block;
            padding: 3px 6px;
            border: 1px solid #000;
            font-size: 11px;
        }

        .milestone {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    {{-- ---------------- TITLE PAGE ---------------- --}}
    <div class="title-page">
        <h1>{{ $project->title }}</h1>

        <div class="meta">
            <p><strong>Research Area:</strong> {{ $project->research_area }}</p>

            <p><strong>Lead Researcher:</strong>
                {{ $project->mentee->name ?? 'N/A' }}
            </p>

            @if(isset($collaborators) && $collaborators->count())
            <p><strong>Collaborators:</strong></p>
            <ul class="collaborators">
                @foreach($collaborators as $col)
                <li>
                    {{ $col->user->name }}
                    @if($col->user->email)
                    — {{ $col->user->email }}
                    @endif
                </li>
                @endforeach
            </ul>
            @endif

            <p><strong>Generated On:</strong> {{ now()->format('F d, Y') }}</p>
        </div>
    </div>

    <div style="page-break-after: always;"></div>


    {{-- ---------------- ABSTRACT ---------------- --}}
    <div>
        <div class="section-title">Abstract</div>
        <p class="content">
            {{ $project->abstract ?? 'No abstract provided.' }}
        </p>
    </div>


    {{-- ---------------- DESCRIPTION ---------------- --}}
    <div>
        <div class="section-title">Research Description</div>
        <p class="content">
            {{ $project->description }}
        </p>
    </div>


    {{-- ---------------- OBJECTIVES ---------------- --}}
    @if($project->objectives ?? false)
    <div>
        <div class="section-title">Research Objectives</div>
        <p class="content">
            {!! nl2br(e($project->objectives)) !!}
        </p>
    </div>
    @endif


    {{-- ---------------- MILESTONES ---------------- --}}
    @if($project->milestones && $project->milestones->count())
    <div>
        @foreach($project->milestones as $m)
        <div class="section-title">{{ $m->title }}</div>

        <div class="content">
            {{ $m->description }}
        </div>
        @endforeach
    </div>
    @endif


    {{-- ---------------- FOOTER ---------------- --}}
    <div class="footer">
        {{ $project->title }} — Academic Project Report
    </div>

</body>

</html>