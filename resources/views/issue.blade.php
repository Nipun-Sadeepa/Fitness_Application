@extends('./layouts/main')
@section('content')

<div>
    <form name="addIssueForm" id="addIssueForm" onsubmit="addIssue(event)" autocomplete="on">
        @csrf
        <div class="mb-3">
            <label for="issue" class="form-label">Issue</label>
            <input type="text" class="form-control" name="issue" id="issue" autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    async function addIssue(event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("addIssueForm"))
        await fetch("/issue", {
                method: "POST",
                body: formData,
            })
            .then(response => {
                return response.json()
            })
            .then(data => {
                if (data.msg == "success") {
                    alert("Issue reported successfully")
                    window.location.href = "/issue/create";
                }
            })

    }
</script>

@endsection