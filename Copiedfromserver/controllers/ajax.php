<html>
<head>
<script>
function showHint(str, insertFunction) {
  if (str.length == 0) { 
    document.getElementById("results").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        insertFunction(this);
      }
    };
    
    xmlhttp.open("POST", "testcontroller.php", true);
    xmlhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + str); 
    //xmlhttp.open("GET", "testcontroller.php?id=" + str, true);
    //xmlhttp.send();
  }
}

function myFunction(xhttp) {
  document.getElementById("results").innerHTML =
  xhttp.responseText;
}


</script>
</head>
<body>
    
<p><b>Start typing a name in the input field below:</b></p>
<form> 
First name: <input id="inputstuff" type="text" >
<!-- onkeyup="showHint(this.value)" -->
</form>
<button id="showinfo" onclick = "showHint(document.getElementById('inputstuff').value, myFunction)">Show Ticket Info</button>
<div id="results"></div>
</body>
</html>
