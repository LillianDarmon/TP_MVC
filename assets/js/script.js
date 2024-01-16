//Regex email return true ou false
function validateEmail(email) {
  var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  return re.test(email);
}
$(function () {
  console.log("ahahah");
  //Requete Ajax connexion
  $("#btnConnexion").on("click", function () {
    var login = $("#email").val();
    var password = $("#password").val();
    if (login != "") {
      if (password != "") {
        if (validateEmail(login) == true) {
          $.ajax({
            url: "controler/login.php",
            type: "POST",
            data: {
              login: login,
              password: password,
            },
            cache: false,
          }).done(function (returnData) {
            response = JSON.parse(returnData);
            if (response.type == "Success") {
              document.getElementById("form").remove();
              var elem = document.getElementsByClassName("elem");
              elem.innerHTML = response.data;
              alert("connexion réussie ");
              setTimeout(() => {
                document.location.href = response.url;
              }, "5000");
            } else {
              var elem = document.getElementById("elem");
              elem.innerHTML = response.type + " " + response.data;
              alert(response.type);
            }
          });
        } else {
          var elem = document.getElementById("elem");
          elem.innerHTML = "Veuillez renseigner une adresse email valide !";
        }
      } else {
        var elem = document.getElementById("elem");
        elem.innerHTML = "Le champs ne peut être vide";
      }
    } else {
      var elem = document.getElementById("elem");
      elem.innerHTML = "Le champs ne peut être vide";
    }
  });

  //Requete Ajax inscription
  $("#btnData").on("click", function () {
    var login = $("#login").val();
    var password = $("#password").val();
    if (login != "") {
      if (password != "") {
        if (validateEmail(login) == true) {
          $.ajax({
            url: "controler/register.php",
            type: "POST",
            data: {
              login: login,
              password: password,
            },
            cache: false,
          }).done(function (returnData) {
            response = JSON.parse(returnData);
            if (response.type == "Success") {
              document.getElementById("form").remove();
              var elem = document.getElementsByClassName("elem");
              elem.innerHTML = response.data;
              alert("inscription réussie ");
              setTimeout(() => {
                document.location.href = response.url;
              }, "5000");
            } else {
              var elem = document.getElementById("elem");
              elem.innerHTML = response.type + " " + response.data;
              alert(response.type);
            }
          });
        } else {
          var elem = document.getElementById("elem");
          elem.innerHTML = "Veuillez renseigner une adresse email valide !";
        }
      } else {
        var elem = document.getElementById("elem");
        elem.innerHTML = "Le champs ne peut être vide";
      }
    } else {
      var elem = document.getElementById("elem");
      elem.innerHTML = "Le champs ne peut être vide";
    }
  });
});
