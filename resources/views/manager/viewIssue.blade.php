@extends('./layouts/main')
@section('content')

<div>
    <ul class="list-group">
        @isset($issues)
        @foreach($issues as $issue)
        Issue :<li class="list-group-item">{{$issue->issue}}</li>
        Creator : <li class="list-group-item">{{$issue->fName}}</li><br><br>
        @endforeach
        @endisset
    </ul>
    {{ $issues->links() }}
</div>

@endsection