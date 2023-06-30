@extends('./layouts/main')
@section('content')

<div>
    <form action="" name="addFeedbackForm" id="addFeedbackForm" onsubmit="addFeedback(event)" autocomplete="on">
        @csrf
        <input type="hidden" class="form-control" name="classId" id="classId" value="{{$classId}}">
        <div class="mb-3">
            <label for="feedbackForm" class="form-label">Feedback</label>
            <input type="text" class="form-control" name="feedback" id="feedback" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    async function addFeedback(event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("addFeedbackForm"))
        await fetch("/feedback", {
                method: "POST",
                body: formData,
            })
            .then(response => {
                return response.json()
            })
            .then(data => {
                if (data.msg == "success") {
                    alert("Feedback added successfully")
                    window.location.href = "/user";
                }
            })
    }
</script>

@endsection