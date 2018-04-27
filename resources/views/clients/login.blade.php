<form method="post" action="/index.php/clients/loginUser">
{!! csrf_field() !!}
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
  </div>

</form>