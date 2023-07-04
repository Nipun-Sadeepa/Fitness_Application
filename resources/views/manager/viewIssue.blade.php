@extends('./layouts/main')
@section('content')

<div>
    @isset($issues)
        <ul class="list-group">
            @foreach($issues as $issue)
                Issue :<li class="list-group-item">{{$issue->issue}}</li>
                Creator : <li class="list-group-item">{{$issue->fName}}</li><br><br>
            @endforeach
    </ul>
    {{ $issues->links() }}
    @endisset


    @isset($contactForms)
        <ul class="list-group">
            @foreach($contactForms as $contactForm)
                Contact Form :<li class="list-group-item">{{$contactForm->contactForm}}</li><br><br>
            @endforeach
    </ul>
    {{ $contactForms->links() }}
    @endisset

    
</div>

@endsection