<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CargoHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" type="image/png" href="images/icon.png">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="container d-flex flex-column justify-content-center align-items-center">
    <div class="row align-items-center">
      <div class="col-sm-6 ">
        <img src="images/welcome.jpg" alt="Delivery Illustration" class="img-fluid">
      </div>
      <div class="col-sm-6 border rounded d-flex flex-column justify-content-center align-items-center " style='background-color: #f7f7f7;'>
        <h2 class="mt-3">Admin</h2>
        <img src="images/icon.png" style="height: auto; width: 30%;">
        <p>Welcome to CargoHub!</p>
        <form>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
            <input type="email" class="form-control" id="email" placeholder="Email address" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" class="form-control" id='password' placeholder="Password" required>
          </div>
          <div class="form-check mb-3">
            <label class="form-check-label"><input class="form-check-input" type="checkbox"> Agree to the terms of service
            </label>
          </div>
          <input type="button" value="Sign in!" id="login" class="mb-3">
          <div id='result'></div>
        </form>
      </div>
</body>
<script>
 
  $('#login').click(function(){
    var email = $('#email').val();
    var password = $('#password').val();
    // Client-side validation checks
    if (email.trim() === "") {
      displayErrorMessage("Email address is required.");
      return;
    }
    if (password.trim() === "") {
      displayErrorMessage("Password is required.");
      return;
    }
    if (!$('.form-check-input').is(':checked')) {
      displayErrorMessage("Please agree to the terms of service.");
      return;
    }
    function displayErrorMessage(message) {
    var errorDiv = $('<div>').addClass('alert alert-danger').text(message);
    $('#result').html(errorDiv);
}
    $.post('API/login_API.php',{email: email, password: password}, function(data){
        console.log(data); 
        $('#result').html(data);
        if (data.trim() === "Login Successful!") {
          alert('Login Successful!');
          window.location.href = "index.php";
        }
  });
});
</script>
</html>