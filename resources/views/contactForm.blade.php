@extends('./layouts/main')
@section('content')

<div>
    <form name="addContactForm" id="addContactForm" onsubmit="addContactForm(event)" autocomplete="on">
        @csrf
        <div class="mb-3">
            <label for="contactForm" class="form-label">Issue</label>
            <input type="text" class="form-control" name="contactForm" id="contactForm" autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    async function addContactForm(event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("addContactForm"))
        await fetch("/addContactForm", {
                method: "POST",
                body: formData,
            })
            .then(response => {
                return response.json()
            })
            .then(data => {
                if (data.msg == "success") {
                    alert("Contact Form added successfully")
                    window.location.href = "/contactForm/create";
                }
            })

    }
</script>

@endsection