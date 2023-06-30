@extends('./layouts/main')
@section('content')

<div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Description</th>
                <th scope="col">Aim</th>
                <th scope="col">Expected Exertion</th>
                <th scope="col">Fitness Level</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($bookingDetails))
            @foreach($bookingDetails as $bookedClass)
            <tr id={{$bookedClass->gymClassesId}}>
                <td>{{$bookedClass->description}}</td>
                <td>{{$bookedClass->aim}}</td>
                <td>{{$bookedClass->expectedExertion}}</td>
                <td>{{$bookedClass->fitnessLevel}}</td>
                <td>{{$bookedClass->date}}</td>
                <td>{{$bookedClass->startingTime}} to {{$bookedClass->endingTime}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>


@endsection