@extends('layouts.app', ['pageTitle' => 'ΔΙΑΓΡΑΦΗ ΠΕΛΑΤΗ'])

@push('backbutton')
    <ul class="hi-menu">
        <li>
            <a href="{{ route('client.edit', $client->id) }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
        </li>
    </ul>
@endpush

@section('content')
<div class="card">
    <div class="card-body card-padding">
        <h4>Με την διαγραφή του πελάτη θα διαγραφούν και όλα τα σχετικά δεδομένα όπως:</h4>
        <div class="m-t-30">
            <h5>Εργασίες</h5>

            <ul>
                @foreach($client->labor as $labor)
                    <li>{{ $labor->item->name }} ({{ $labor->date }})</li>
                @endforeach
                @if($client->labor->count() === 0)
                    <li>Δεν υπάρχουν εργασίες</li>
                @endif
            </ul>
        </div>
        @if(config('crm.mode') === 'mechanic')
            <div class="m-t-30">
                <h5>Όχημα</h5>

                @if($client->vehicle->brand)
                    <ul>
                        <li>{!! $client->vehicle->brand ? $client->vehicle->brand : '–'!!} {!! $client->vehicle->model ? $client->vehicle->model : '–'!!}, ({!! $client->vehicle->production_year ? $client->vehicle->production_year : '–'!!})</li>
                    </ul>
                @else
                    <ul>
                        <li>Δεν υπάρχει κάποιο όχημα</li>
                    </ul>
                @endif
            </div>
        @endif

        <div class="m-t-30">
            {!! Form::open(['url' => route('client.destroy', $client->id), 'method' => 'DELETE']) !!}
            <Button type="submit" class="btn btn-danger btn-sm">Οριστική Διαγραφή</Button>
            {!! Form::close() !!}
        </div>

    </div>
</div>
@stop
