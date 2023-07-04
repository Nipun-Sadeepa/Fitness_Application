@extends('./layouts/main')
@section('content')

<div>
    <form name="addContactForm" id="addContactForm" onsubmit="addContactForms(event)">
        @csrf
        <div class="mb-3">
            <label for="contactForm" class="form-label">Contact Form</label>
            <input type="text" class="form-control" name="contactForm" id="contactForm" autofocus required>
        </div>
        <input type="submit" class="btn btn-primary" value="Submit form">
    </form>
</div>

<script>
    async function addContactForms(event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("addContactForm"))
        await fetch("/contactForm", {
                method: "POST",
                body: formData,
        })
        .then(response => {
            return response.json()
        })
        .then(data => {
            if (data.msg == "success") {
                alert("Contact Form added successfully")
                window.location.href = "/guest";
            }
        })

    }
</script>

@endsection