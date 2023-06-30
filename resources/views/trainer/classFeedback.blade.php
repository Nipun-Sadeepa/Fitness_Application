@extends('./layouts/main')
@section('content')

<div>
    <ul class="list-group">
        @isset($feedback)
        @foreach($feedback as $aFeedback)
        Feedback :<li class="list-group-item">{{$aFeedback->feedback}}</li>
        Creator : <li class="list-group-item">{{$aFeedback->fName}}</li><br>
        @endforeach
        @endisset
    </ul>
</div>

@endsection