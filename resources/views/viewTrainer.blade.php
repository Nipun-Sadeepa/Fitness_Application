@extends('./layouts/main')
@section('content')


<h3>Profile of Trainer : {{$trainerDetails->fName}}</h3>

<div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No Level</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($trainerDetails))
            <tr id={{$trainerDetails->id}}>
                <td>{{$trainerDetails->fName}}</td>
                <td>{{$trainerDetails->lName}}</td>
                <td>{{$trainerDetails->email}}</td>
                <td>{{$trainerDetails->contactNo}}</td>
            </tr>
            @endif
        </tbody>
    </table>
    <br><br><br>

    <h3>Class Details of Trainer : {{$trainerDetails->fName}}</h3>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Description</th>
                <th scope="col">aim</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($trainerClassDetails[0]))
            @foreach($trainerClassDetails as $class)
            <tr id={{$class->id}}>
                <td>{{$class->description}}</td>
                <td>{{$class->aim}}</td>
                <td>{{$class->date}}</td>
                <td>{{$class->startingTime}} to {{$class->endingTime}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

@endsection