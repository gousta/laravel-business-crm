@extends('layouts.app', ['pageTitle' => $item->name])

@push('backbutton')
    <ul class="hi-menu">
        <li>
            <a href="{{ route('catalog.index') }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
        </li>
    </ul>
@endpush

@section('content')
<div class="card" id="profile-main">

    <div class="card-body card-padding">
        {{ dump($item->toArray()) }}
    </div>
</div>
@stop

@push('scripts')

@endpush