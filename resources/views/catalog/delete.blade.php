@extends('layouts.app', ['pageTitle' => 'ΔΙΑΓΡΑΦΗ'])

@push('backbutton')
    <ul class="hi-menu">
        <li>
            <a href="{{ route('catalog.edit', $item->id) }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
        </li>
    </ul>
@endpush

@section('content')
<div class="card">
    <div class="card-body card-padding">
        <h4>Με την διαγραφή του προιόντος δεν θα επηρεαστούν τα στατιστικά.</h4>

        <div class="m-t-30">
            {!! Form::open(['url' => route('catalog.destroy', $item->id), 'method' => 'DELETE']) !!}
            <Button type="submit" class="btn btn-danger btn-sm">Οριστική Διαγραφή</Button>
            {!! Form::close() !!}
        </div>

    </div>
</div>
@stop
