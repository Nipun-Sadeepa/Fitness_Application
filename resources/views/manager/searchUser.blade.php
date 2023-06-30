@extends('./layouts/main')
@section('content')

<div class="d-flex ms-auto">
    <input class="form-control me-2" type="search" placeholder="Searchc by email" aria-label="Search" name="email" id="email">
    <a href="#" class="btn btn-outline-success" onclick="getSearchString()" id="searchLink">Search</a>
</div>

@isset($userResult)
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Contact No</th>
            <th scope="col">Current Role</th>
            <th scope="col">Promote</th>
        </tr>
    </thead>
    <tbody>
        @foreach($userResult as $user)
        <tr id={{$user['id']}}>
            <td>{{$user['fName']}}</td>
            <td>{{$user['lName']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['contactNo']}}</td>
            <td>{{$user['role']}}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Role
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="/promote/trainer/{{$user['id']}}">Trainer</a></li>
                        <li><a class="dropdown-item" href="/promote/siteMember/{{$user['id']}}">Site Member</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endisset


<script>
    function getSearchString() {
        let searchString = document.getElementById('email')
        const searchLink = document.getElementById('searchLink')

        searchString = searchString.value
        const url = '/search/' + encodeURIComponent(searchString)
        searchLink.setAttribute('href', url)
    }
</script>
@endsection