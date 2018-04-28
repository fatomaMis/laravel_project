@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{route('updatenumber',$room->id)}}">
Number Of Accompany:-
<br>
<br>
<input type="text"  id="number" name="number of accompany" >
<br>
<br>

<button onclick="checkfunc()" >Submit Your Recervation </button>
</form>

<!-- <script>
function checkfunc(){
var x = document.getElementById("number").value;
if($rooom->capacity < x)
alert ('You can receved This Room ');
}
</script> -->
