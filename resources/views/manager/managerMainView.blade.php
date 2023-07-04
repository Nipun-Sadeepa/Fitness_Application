@extends('./layouts/main')
@section('content')

<nav class="navbar navbar-expand-lg custom-bg border">
    <div class="collapse navbar-collapse d-flex" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link active btn btn-primary" aria-current="page" href="/class/create">Add Class</a>
            </li>&nbsp&nbsp
            <li class="nav-item">
                <a class="nav-link active btn btn-primary" aria-current="page" href="/search">Promote Users</a>
            </li>&nbsp&nbsp
            <li class="nav-item">
                <a class="nav-link active btn btn-primary" aria-current="page" href="/issue/view">View Issues</a>
            </li>&nbsp&nbsp
            <li class="nav-item">
                <a class="nav-link active btn btn-primary" aria-current="page" href="/contactForm/view">View Contact Forms</a>
            </li>&nbsp&nbsp
        </ul>
    </div>
</nav>

<h3>Class Details</h3>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Description</th>
            <th scope="col">Trainer</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">View</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($classes[0]))
        @foreach($classes as $class)
        <tr id={{$class->id}}>
            <td>{{$class->description}}</td>
            <td>{{$class->fName}}</td>
            <td>{{$class->date}}</td>
            <td>{{$class->startingTime}} to {{$class->endingTime}}</td>
            <td><a href="/class/view/{{$class->id}}" class="btn btn-primary">View More</a></td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>



@endsection