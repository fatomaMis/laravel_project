
<h1> Edite Profile </h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post"  action="{{route('updateprofile','1')}}" >
{{csrf_field()}}
Name :- <input type="text" name="name" value="{{$client->name}}">
<br><br>
Email:- <input type="text" name="email" value="{{$client->email}}">
<br>
<br>
<input type="submit" value="Update" class="btn btn-primary">
</form>
