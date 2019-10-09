@php
    $title = __('Members');
@endphp
@extends('../layouts/navbar')
@section('content')
    <div class="container">
        <h1 id="post-title">{{ $title }}</h1>

        {{-- 編集・削除ボタン --}}
        <div class="edit">
            <a href="{{ url('members/'.$member->id.'/edit') }}" class="btn btn-primary">
                {{ __('Edit') }}
            </a>
            @component('components.btn-del')
                @slot('name', 'group_id')
                @slot('id', $member->id)
            @endcomponent
        </div>

        {{-- 記事内容 --}}
        <dl class="row">
            <dt class="col-md-2">{{ __('Created') }}:</dt>
            <dd class="col-md-10">
                <time itemprop="dateCreated" datetime="{{ $member->created_at }}">
                    {{ $member->created_at }}
                </time>
            </dd>
            <dt class="col-md-2">{{ __('Updated') }}:</dt>
            <dd class="col-md-10">
                <time itemprop="dateModified" datetime="{{ $member->updated_at }}">
                    {{ $member->updated_at }}
                </time>
            </dd>
        </dl>
        <hr>
        <div id="post-body">
            {{ $member->day_1 }}
        </div>
    </div>
@endsection
