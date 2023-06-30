@extends('./layouts/main')
@section('content')

<div>
    <ul class="list-group">
        @isset($classDetails)
        Description :<li class="list-group-item">{{$classDetails->description}}</li><br>
        Aim : <li class="list-group-item">{{$classDetails->aim}}</li><br>
        Expected Exertion : <li class="list-group-item">{{$classDetails->expectedExertion}}</li><br>
        Fitness Level : <li class="list-group-item">{{$classDetails->fitnessLevel}}</li><br>
        Trainer<li class="list-group-item">{{$classDetails->fName}}</li><br>
        Date : <li class="list-group-item">{{$classDetails->date}}</li><br>
        Time : <li class="list-group-item">{{$classDetails->startingTime}} to {{$classDetails->endingTime}}</li><br>

        <a href="/class/book/{{$classDetails->id}}" class="btn btn-primary">Book place</a>
        <a href="/feedback/create/{{$classDetails->id}}" class="btn btn-primary">Add Feedback</a>
        @endisset
    </ul>
</div>

@endsection