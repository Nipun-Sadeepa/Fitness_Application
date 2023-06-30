@extends('./layouts/main')
@section('content')

<nav class="navbar navbar-expand-lg custom-bg border">
    <div class="collapse navbar-collapse d-flex" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link active btn btn-primary" aria-current="page" href="/issue/create">Report Issue</a>
            </li>
        </ul>
    </div>
</nav>

<h2>Profile of Trainer : {{$userName}}</h2>

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
            @if(isset($myClassDetails))
            @foreach($myClassDetails as $class)
            <tr id={{$class->id}}>
                <td>{{$class->description}}</td>
                <td>{{$class->aim}}</td>
                <td>{{$class->expectedExertion}}</td>
                <td>{{$class->fitnessLevel}}</td>
                <td>{{$class->date}}</td>
                <td>{{$class->startingTime}} to {{$class->endingTime}}</td>
                <td><a href="/class/feedback/{{$class->id}}" class="btn btn-primary">View Feedbacks</a> </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

@endsection