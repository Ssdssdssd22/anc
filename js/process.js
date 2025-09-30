function signInProcess() {
  let code = document.getElementById("exampleInputEmail1").value;
  let pass = document.getElementById("exampleInputPassword1").value;
  let remember = document.getElementById("exampleCheck1").value;
  const res = remember === "on"? true : false;
  alert(res);

  const verify = code !== "" ? (pass !== "" ? true : false) : false;
  if (verify === true) {
    var form = new FormData();
    form.append("code",code);
    form.append("pass",pass);
    form.append("remember",res);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            if(request.responseText === "error"){
            document.getElementById("alert").innerHTML='<div class="alert alert-danger mt-3" role="alert">'+request.responseText+'</div>';
            }else{
            document.getElementById("alert").innerHTML='<div class="alert alert-success mt-3" role="alert">'+request.responseText+'</div>';
            }
        }
    }
    request.open("POST","process/loginProcess.php",true);
    request.send(form);
  }
}

document.onkeydown = function(e) {
  if (e.ctrlKey && (e.keyCode === 85 || e.keyCode === 83 || e.keyCode === 73)) {
      return false;
  }
};

