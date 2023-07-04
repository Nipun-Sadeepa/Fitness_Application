@extends('./layouts/main')
@section('content')

<div>
    @isset($classMngDetails)
    <form name="updateClassForm" id="updateClassForm" onsubmit="updateClass(event)">
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value={{$classMngDetails->id}} required>
        <div class="mb-3">
            <label for="name" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" value={{$classMngDetails->description}} required>
        </div>
        <div class="mb-3">
            <label for="aim" class="form-label">Aim</label>
            <input type="text" class="form-control" name="aim" id="aim" value={{$classMngDetails->aim}} required>
        </div>
        <div class="mb-3">
            <label for="expectedExertion" class="form-label">Expected Exertion</label>
            <input type="text" class="form-control" name="expectedExertion" id="expectedExertion" value={{$classMngDetails->expectedExertion}} required>
        </div>
        <div class="mb-3">
            <label for="fitnessLevel" class="form-label">Fitness Level</label>
            <input type="text" class="form-control" name="fitnessLevel" id="fitnessLevel" value={{$classMngDetails->fitnessLevel}} required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date of Week</label>
            <input type="text" class="form-control" name="date" id="date" value={{$classMngDetails->date}} required>
        </div>
        <div class="mb-3">
            <label for="trainer" class="form-label">Trainer</label>
            <select class="form-select" name="usersId" required>
                @foreach($trainers as $trainer)
                @if($trainer->id==$classMngDetails->usersId)
                <option value="{{$trainer->id}}" selected>{{$trainer->fName}}</option>
                @else
                <option value="{{$trainer->id}}">{{$trainer->fName}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-6">
            <label for="startingTime" class="form-label">Starting Time</label>
            <input type="time" class="form-control" name="startingTime" id="startingTime" value={{$classMngDetails->startingTime}}>
        </div>
        <div class="mb-3 col-6">
            <label for="endingTime" class="form-label">Ending Time</label>
            <input type="time" class="form-control" name="endingTime" id="endingTime" value={{$classMngDetails->endingTime}}>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/class/delete/{{$classMngDetails->id}}" class="btn btn-primary">Delete</a>
        <a href="/feedback/view/{{$classMngDetails->id}}" class="btn btn-primary">View Feedbacks</a>
    </form>
    @endisset

</div>

<script>
    async function updateClass(event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("updateClassForm"))
        await fetch("/class/update", {
                method: "POST",
                body: formData,
            })
            .then(response => {
                return response.json()
            })
            .then(data => {
                if (data.msg == "success") {
                    alert("class updated successfully")
                    window.location.href = "/manager";
                }
            })
    }
</script>

@endsection