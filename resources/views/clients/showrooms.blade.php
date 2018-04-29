@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action='/allroom'>
{{csrf_field()}}
Number Of Accompany:-
<br>
<br>
<input type="text"   name="number" >
<br>
<br>
<p></p>

<button onclick="checkfunc()" type="submit">Submit Your Recervation </button>
</form>

<script>
function checkfunc(){
var x = document.getElementById("number").value;
if($rooom->capacity < x)
alert ('You can receved This Room ');
}
</script>
