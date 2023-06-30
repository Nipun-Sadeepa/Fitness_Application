@extends('./layouts/main')
@section('content')

<!-- Form for add classes -->
<form name="addClassForm" action="" id="addClassForm" autocomplete="on" onsubmit="addClass(event)">
    @csrf
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" id="description" autofocus required>
    </div>
    <div class="mb-3">
        <label for="aim" class="form-label">Aim</label>
        <input type="text" class="form-control" name="aim" id="aim" required>
    </div>


    <div class="mb-3">
        <label for="expectedExertion" class="form-label">Expected Exertion</label>
        <input type="text" class="form-control" name="expectedExertion" id="expectedExertion" required>
    </div>

    <div class="mb-3">
        <label for="fitnessLevel" class="form-label">Fitness Level</label>
        <input type="text" class="form-control" name="fitnessLevel" id="fitnessLevel" required>
    </div>

    <select class="form-select" name="trainerId" required>
        <option value="">Select Trainer</option>
        @isset($trainer)
        @foreach($trainer as $oneTrainer)
        <option value="{{$oneTrainer->id}}">{{$oneTrainer->fName}}</option>
        @endforeach
        @endisset
    </select><br>


    <select class="form-select" name="date" required>
        <option value="">Select Day</option>
        <option value="monday">Monday</option>
        <option value="tuesday">Tuesday</option>
        <option value="wednesday">Wednesday</option>
        <option value="thursday">Thursday</option>
        <option value="friday">Friday</option>
        <option value="saturday">Saturday</option>
        <option value="sunday">Sunday</option>
    </select><br>


    <div class="col-6 mb-3">
        <label for="startingTime" class="form-label">Starting Time</label>
        <input type="time" class="form-control" name="startingTime" id="startingTime" required />
    </div><br>

    <div class="col-6 mb-3">
        <label for="endingTime" class="form-label">Ending Time</label>
        <input type="time" class="form-control" name="endingTime" id="endingTime" required />
    </div>


    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<script>
    async function addClass(event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("addClassForm"))
        await fetch("/class", {
                method: "POST",
                body: formData,
            })
            .then(response => {
                return response.json()
            })
            .then(data => {
                if (data.msg == "success") {
                    alert("class added successfully")
                    window.location.href = "/class/create";

                }
            })
    }
</script>
@endsection