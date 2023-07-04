@extends('./layouts/main')
@section('content')


<h3>Profile of Trainer : {{$myDetails->fName}}</h3> 

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
            @if(isset($myDetails))
            <tr id={{$myDetails->id}}>
                <td>{{$myDetails->fName}}</td>
                <td>{{$myDetails->lName}}</td>
                <td>{{$myDetails->email}}</td>
                <td>{{$myDetails->contactNo}}</td>
            </tr>
            @endif
        </tbody>
    </table>
    <br><br><br>

    <h2>Classes of Trainer : {{$myDetails->fName}}</h2>

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
                    <th scope="col">Feedbacks</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($myClassDetails[0])) 
                @foreach($myClassDetails as $class)
                <tr id={{$class->id}}>
                    <td>{{$class->description}}</td>
                    <td>{{$class->aim}}</td>
                    <td>{{$class->expectedExertion}}</td>
                    <td>{{$class->fitnessLevel}}</td>
                    <td>{{$class->date}}</td>
                    <td>{{$class->startingTime}} to {{$class->endingTime}}</td>
                    <td><a href="/feedback/view/{{$class->id}}" class="btn btn-primary">View Feedbacks</a> </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

</div>

@endsection