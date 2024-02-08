var statususer;
var userLogin;
var usernameLogin;
var dataFromUserTable;
var server = "10.20.1.175:8090";


function Login() {
  let username = document.querySelector('#username');
  let password = document.querySelector('#password');

  // Creating a XHR object
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/login";

  // open a connection
  xhr.open("POST", url, true);
  // Set the request header i.e. which type of content you are sending
  xhr.setRequestHeader("Content-Type", "text/plain");
  // xhr.setRequestHeader("Content-Type", "Application/Json");

  // Create a state change callback
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Print received data from server
      //result.innerHTML = this.responseText;
      console.log(this.responseText);
      var users = JSON.parse(this.responseText);
      var status = JSON.parse(this.responseText);

      //alert(status.STATUS);
      if (users.username == users.username && status.status == 'BERHASIL') {
        // They clicked Yes
        alert(status.status);
        window.location = 'dashboard.html'
        userLogin = users.username;
        hakAkses = users.hak_akses;
        //GetUserLogin();
        localStorage.setItem("userstr", users.nama);
        localStorage.setItem("userstr2", users.username);
        localStorage.setItem("HAKAKSES", users.hak_akses);


      } else {
        // They clicked no
        window.location = '#'
        alert(status.pesan);
      }
    }
  };

  // Converting JSON data to string
  var data = JSON.stringify({
    "username": username.value,
    "password": password.value
  });
  // Sending data with the request
  xhr.send(data);

}

function Register() {

  let username = document.querySelector('#username-createUser');
  let password = document.querySelector('#password-createUser');
  let name = document.querySelector('#nama-createUser');
  let hakakses = document.getElementById('selectHakAkses');

  // Creating a XHR object
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/register";

  // open a connection
  xhr.open("POST", url, true);
  // Set the request header i.e. which type of content you are sending
  xhr.setRequestHeader("Content-Type", "text/plain");
  // xhr.setRequestHeader("Content-Type", "Application/Json");
  //  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
  // Create a state change callback
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Print received data from server
      //result.innerHTML = this.responseText;
      var users = JSON.parse(this.responseText);
      var status = JSON.parse(this.responseText);
      //alert(status.STATUS);
      if (users.USERNAME == users.USERNAME && status.STATUS == 'BERHASIL') {
        // They clicked Yes
        alert(status.STATUS);
        window.location = 'user.html'
        //  alert(this.responseText);
      } else {
        // They clicked no
        alert(status.STATUS);
      }
    }
  };

  // Converting JSON data to string
  var data = JSON.stringify({
    "username": username.value,
    "password": password.value,
    "nama": name.value,
    "hak_akses": hakakses.value
  });
  // Sending data with the request
  xhr.send(data);

}

function changePassword() {
  let password = document.querySelector('#password');
  let newPassword = document.querySelector('#new-password');
  let username = document.getElementById('usernameChangePassword');
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/update";

  xhr.open("POST", url, true);

  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var status = JSON.parse(this.responseText);
      alert(status.status + "-" + status.pesan);
      console.log(this.responseText);
    }
  };

  // Converting JSON data to string
  var data = JSON.stringify({
    "username": localStorage.getItem("userstr2"),
    "password": password.value,
    "password2": newPassword.value
  });
  // Sending data with the request
  xhr.send(data);
}

function ClearSession() {

  //let result = document.querySelector('.result');
  let username = document.querySelector('#username');
  let password = document.querySelector('#password');

  // Creating a XHR object
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/clearsession";

  // open a connection
  xhr.open("POST", url, true);
  // Set the request header i.e. which type of content you are sending
  xhr.setRequestHeader("Content-Type", "text/plain");
  // xhr.setRequestHeader("Content-Type", "Application/Json");
  //  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
  // Create a state change callback
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Print received data from server
      //result.innerHTML = this.responseText;
      var status = JSON.parse(this.responseText);
      alert(status.STATUS);

    }
  };

  // Converting JSON data to string
  var data = JSON.stringify({
    "username": username.value,
    "password": password.value
  });
  // Sending data with the request
  xhr.send(data);

}

function Logout() {

  //let result = document.querySelector('.result');
  let user = localStorage.getItem("userstr2");

  // Creating a XHR object
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/logout";

  // open a connection
  xhr.open("POST", url, true);
  // Set the request header i.e. which type of content you are sending
  xhr.setRequestHeader("Content-Type", "text/plain");
  // xhr.setRequestHeader("Content-Type", "Application/Json");
  //  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
  // Create a state change callback
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Print received data from server
      //result.innerHTML = this.responseText;
      if (confirm("Yakin Logout ???") == true) {
        var status = JSON.parse(this.responseText);
        if (status.status == 'BERHASIL') {
          // They clicked Yes
          window.location = 'index.html'
      } else {
        text = "You canceled!";
      }
      } else {
        // They clicked no
        window.location = '#'
        alert(status.status);
      }
    }
  };

  // Converting JSON data to string
  var data = JSON.stringify({
    "username": user
  });
  // Sending data with the request
  xhr.send(data);

}

function GetUser() {

  //let result = document.querySelector('.result');
  // Creating a XHR object
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/user";

  // open a connection
  xhr.open("POST", url, true);
  // Set the request header i.e. which type of content you are sending
  xhr.setRequestHeader("Content-Type", "text/plain");
  // xhr.setRequestHeader("Content-Type", "Application/Json");
  //  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
  // Create a state change callback
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Print received data from server
      //result.innerHTML = this.responseText;
      user = JSON.parse(this.responseText);

      builTable();
    }
  };
  xhr.send("");
}

function builTable() {

  var table = document.getElementById('tbuser')
  for (var i = 0; i < user.length; i++) {
    var row = `<tr align="Center">
              <td>${user[i].username}</td>
              <td>${user[i].nama}</td>
              <td>${user[i].hak_akses}</td>
              <td><button onclick="resetPassword()" class="btn btn-primary btn-block">Reset</button></td>
              <td><button onClick="deleteUser()" class="btn btn-primary btn-block">Delete</button></td>
              </tr>`
    table.innerHTML += row
    //  deleteUser(i);
  }
}

function deleteUser() {
  let user;
  if (!document.getElementsByTagName || !document.createTextNode) return;
  var rows = document.getElementById('tbuser').getElementsByTagName('tr');
  for (i = 0; i < rows.length; i++) {
    rows[i].onclick = function() {
      user = (document.getElementById("tbuser").rows[this.rowIndex - 1].cells.item(0).innerHTML);
      //  alert(user);
      let xhr = new XMLHttpRequest();
      let url = "http://" + server + "/delete";
      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-Type", "text/plain");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Print received data from server
          var status = JSON.parse(this.responseText);
          if (status.STATUS == 'BERHASIL DIHAPUS') {
            // They clicked Yes
            alert("USER " + user + " " + status.STATUS);
            window.location = 'user.html'
          } else {
            // They clicked no
            window.location = 'user.html'
            alert(status.STATUS);
          }
        }
      };
      var data = JSON.stringify({
        "username": user
      });
      xhr.send(data);
    }
  }

}

function resetPassword() {
  let user;
  if (!document.getElementsByTagName || !document.createTextNode) return;
  var rows = document.getElementById('tbuser').getElementsByTagName('tr');
  for (i = 0; i < rows.length; i++) {
    rows[i].onclick = function() {
      user = (document.getElementById("tbuser").rows[this.rowIndex - 1].cells.item(0).innerHTML);
      //  alert(user);
      let xhr = new XMLHttpRequest();
      let url = "http://" + server + "/reset";
      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-Type", "text/plain");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Print received data from server
          var status = JSON.parse(this.responseText);

          alert(status.USERNAME + ' - ' + status.PESAN);
        }
      };
      var data = JSON.stringify({
        "username": user
      });
      xhr.send(data);
    }
  }

}

function GetUserLogin() {
  let result = document.querySelector('.userlogin');
  let usernameChangePassword = document.getElementById('usernameChangePassword');
  result.innerHTML = localStorage.getItem("userstr").toUpperCase();
  usernameChangePassword.innerHTML = localStorage.getItem("userstr2").toUpperCase();
  usernameChangePassword.disabled = true;
}

function accessMenu() {

  var admin = "ADMIN";
  var operation = "OPERATION";
  var helpdesk = "HELPDESK";

  if (localStorage.getItem("HAKAKSES") == admin) {
    document.getElementById('menuProsesRekon').href = 'rekon.html';
    document.getElementById('menuProsesSuspect').href = 'force-suspect.html';
  } else if (localStorage.getItem("HAKAKSES") == operation) {
    document.getElementById('menuProsesRekon').href = 'rekon.html';
    document.getElementById('menuProsesSuspect').href = 'force-suspect.html';
  } else if (localStorage.getItem("HAKAKSES") == helpdesk) {
    document.getElementById('menuProsesRekon').href = '#';
    document.getElementById('menuProsesSuspect').href = '#';
  }
}

function Rekon() {
  // showLoader()
  let firstDate = document.getElementById('firstDate');
  let endDate = document.getElementById('endDate');
  let procesName = document.getElementById('procesName');
  let checkboxBank = document.getElementsByClassName('checkboxBank');
  let produkPLN = document.getElementsByClassName('produkPLN');
  let mitraName = document.getElementsByClassName('mitraName');
  let result = document.querySelector('.logProsesPLN');
  var tombolProses = document.getElementById("plnProses");
  var tombolReset = document.getElementById("resetProses");
  var overlay = document.getElementById("overlay");
  var loading = document.getElementById("loading");

  var bank = '';
  var produk = '';
  var mitra = '';
  var row = '';
  result.innerHTML = '';
  tombolProses.disabled = true;
  tombolReset.disabled = true;
  overlay.style.display = "block";
  loading.style.display = "block";
  var x = 0;
  for (i = 0; i < checkboxBank.length; i++) {
    if (checkboxBank[i].checked) {
      x++
    }
    if (checkboxBank[i].checked && x == 1) {
      bank += checkboxBank[i].value;
    } else if (checkboxBank[i].checked && x >> 1) {
      bank += "," + checkboxBank[i].value;
    }
  }
  x = 0;
  for (i = 0; i < produkPLN.length; i++) {
    if (produkPLN[i].checked) {
      x++
    }
    if (produkPLN[i].checked && x == 1) {
      produk += produkPLN[i].value;
    } else if (produkPLN[i].checked && x >> 1) {
      produk += "," + produkPLN[i].value;
    }
  }
  x = 0;
  for (i = 0; i < mitraName.length; i++) {
    if (mitraName[i].checked) {
      x++
    }
    if (mitraName[i].checked && x == 1) {
      mitra += mitraName[i].value;
    } else if (mitraName[i].checked && x >> 1) {
      mitra += "," + mitraName[i].value;
    }
  }

  let xhr = new XMLHttpRequest();
  if (procesName.value === "rekonsiliasi") {
    let url = "http://" + server + "/rekonsiliasi";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Print received data from server
        var status = JSON.parse(this.responseText);
        for (var i = 0; i < status.length; i++) {
          row = `<b>${status[i].STATUS} : ${status[i].PESAN}</b><br>`;
          result.innerHTML += row;
          tombolProses.disabled = false;
          tombolReset.disabled = false;
          overlay.style.display = "none";
          loading.style.display = "none";
        }
      } else {
        tombolProses.disabled = false;
        tombolReset.disabled = false;
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  } else if (procesName.value === "uploadFileFTR") {

    let url = "http://" + server + "/uploadftr";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Print received data from server
        var status = JSON.parse(this.responseText);
        for (var i = 0; i < status.length; i++) {
          row = `<b>${status[i].PESAN} ${status[i].STATUS}</b><br>`;
          result.innerHTML += row;
          tombolProses.disabled = false;
          tombolReset.disabled = false;
          overlay.style.display = "none";
          loading.style.display = "none";
        }
      } else {
        tombolProses.disabled = false;
        tombolReset.disabled = false;
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  } else if (procesName.value === "download") {
    let url = "http://" + server + "/downloadfile";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var status = JSON.parse(this.responseText);
        for (var i = 0; i < status.length; i++) {
          row = `<b>${status[i].FILE} ${status[i].STATUS}</b><br>`;
          result.innerHTML += row;
          tombolProses.disabled = false;
          tombolReset.disabled = false;
          overlay.style.display = "none";
          loading.style.display = "none";
        }
      } else {
        tombolProses.disabled = false;
        tombolReset.disabled = false;
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  } else if (procesName.value === "compare") {
    let url = "http://" + server + "/comparedata";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Print received data from server
        var status = JSON.parse(this.responseText);
        for (var i = 0; i < status.length; i++) {
          row = `<b>${status[i].STATUS}</b><br>`;
          result.innerHTML += row;
          tombolProses.disabled = false;
          tombolReset.disabled = false;
          overlay.style.display = "none";
          loading.style.display = "none";

        }
      } else {
        tombolProses.disabled = false;
        tombolReset.disabled = false;
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  } else if (procesName.value === "uploadHasilCompare") {
    let url = "http://" + server + "/uploadfinalpln";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Print received data from server
        var status = JSON.parse(this.responseText);
        console.log(status);
        for (var i = 0; i < status.length; i++) {
          row = `<b>${status[i].PESAN}</b><br>`;
          result.innerHTML += row;
          tombolProses.disabled = false;
          tombolReset.disabled = false;
          overlay.style.display = "none";
          loading.style.display = "none";

        }
      } else {
        tombolProses.disabled = false;
        tombolReset.disabled = false;
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  }
  var data = JSON.stringify({
    "bank": bank,
    "produk": produk,
    "mitra": mitra,
    "tanggal": firstDate.value.replace(/-/g, "") + "-" + endDate.value.replace(/-/g, "")
  });
  xhr.send(data);
}

function resetRekon() {
  var log = document.querySelector('.logProsesPLN');
  var checkboxBank = document.getElementsByClassName('checkboxBank');
  var produkPLN = document.getElementsByClassName('produkPLN');
  var mitraName = document.getElementsByClassName('mitraName');
  log.innerHTML = ''
  for (var i = 0; i < checkboxBank.length; i++) {
    if (checkboxBank[i].type == 'checkbox')
      checkboxBank[i].checked = false;
  }
  for (var i = 0; i < produkPLN.length; i++) {
    if (produkPLN[i].type == 'checkbox')
      produkPLN[i].checked = false;
  }
  for (var i = 0; i < mitraName.length; i++) {
    if (mitraName[i].type == 'checkbox')
      mitraName[i].checked = false;
  }
}

function selectAllRekon() {
  var checkboxBank = document.getElementsByClassName('checkboxBank');
  var produkPLN = document.getElementsByClassName('produkPLN');
  var mitraName = document.getElementsByClassName('mitraName');
  for (var i = 0; i < checkboxBank.length; i++) {
    if (checkboxBank[i].type == 'checkbox')
      checkboxBank[i].checked = true;
  }
  for (var i = 0; i < produkPLN.length; i++) {
    if (produkPLN[i].type == 'checkbox')
      produkPLN[i].checked = true;
  }
  for (var i = 0; i < mitraName.length; i++) {
    if (mitraName[i].type == 'checkbox')
      mitraName[i].checked = true;
  }
}

function selectAllRekonMbiller() {
  var checkboxProduk = document.getElementsByClassName('checkboxProduk');
  for (var i = 0; i < checkboxProduk.length; i++) {
    if (checkboxProduk[i].type == 'checkbox')
      checkboxProduk[i].checked = true;
  }
}

function ResetAllRekonMbiller() {
  var checkboxProduk = document.getElementsByClassName('checkboxProduk');
  for (var i = 0; i < checkboxProduk.length; i++) {
    if (checkboxProduk[i].type == 'checkbox')
      checkboxProduk[i].checked = false;
  }
}


function uploadbukopin() {
  const result = document.getElementById("logupload");
  const inpFile = document.getElementById("inpFile");
  var tombolProses = document.getElementById("uploadBukopinProses");
  var tombolReset = document.getElementById("resetBukopinProses");
  tombolProses.disabled = true;
  tombolReset.disabled = true;

  const xhr = new XMLHttpRequest();
  const url = "http://" + server + "/uploadbukopin";
  const formData = new FormData();
  for (const file of inpFile.files) {
    formData.append("myFiles[]", file);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var status = JSON.parse(this.responseText);
        for (var i = 0; i < status.length; i++) {
          var row = `<b>${status[i].FILE} - ${status[i].STATUS}  </b><br>`
          result.innerHTML += row;
          tombolProses.disabled = false;
          tombolReset.disabled = false;

        }
      } else {
        tombolProses.disabled = false;
        tombolReset.disabled = false;
      }
    };
  }
  xhr.open("POST", url, true);
  xhr.send(formData);

}

function poresAlfa() {
  const inpFile = document.getElementById("inpFile");
  var tombolProses = document.getElementById("uploadBukopinProses");
  tombolProses.disabled = true;

  const xhr = new XMLHttpRequest();
  const url = "http://" + server + "/casemidi";
  const formData = new FormData();
  for (const file of inpFile.files) {
    formData.append("myFiles[]", file);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var status = JSON.parse(this.responseText);
        localStorage.setItem("STATUS", this.responseText);
        tabelAlfa()
        tombolProses.disabled = false;
      }
    };
  }
  xhr.open("POST", url, true);
  xhr.send(formData);

}

function tabelAlfa() {
  var status = JSON.parse(localStorage.getItem("STATUS"));
  var table = document.getElementById('tbAlfa');
  var Parent = document.getElementById('tbAlfa');

  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }

  for (var i = 0; i < status.length; i++) {
    var row = `<tr align="Center">
    <td>${status[i].tanggal}</td>
    <td>${status[i].idpel}</td>
    <td>${status[i].scref}</td>
    <td>${status[i].keterangan}</td>
              </tr>`
    table.innerHTML += row
    //  deleteUser(i);
  }
}

function resetuploadbukopin() {
  document.getElementById("inpFile").value = "";
}

function uploadNote() {
  var x = document.getElementById("procesName").value;
  var log = document.getElementById("logupload").innerHTML = "";

  if (x === "uploadHasilCompare") {
    document.getElementById("uploadNote").innerHTML = "*Meliputi Proses Upload Final, Upload Cancel, Upload Pending & Upload Force Ditolak";
  } else {
    document.getElementById("uploadNote").innerHTML = "";
  }

}

function GetSelisihSaldo() {
  let firstDate = document.getElementById('firstDate');
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/saldoharian";
  var overlay = document.getElementById("overlay");
  var loading = document.getElementById("loading");

  overlay.style.display = "block";
  loading.style.display = "block";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      selisih = JSON.parse(this.responseText);
      console.log(selisih);
      overlay.style.display = "none";
      loading.style.display = "none";
      tableSelisih()

    }
  };
  var data = JSON.stringify({
    "tanggal": firstDate.value.replace(/-/g, "")
  });
  xhr.send(data);

}

function tableSelisih() {
  var table = document.getElementById('tbselisih');
  var Parent = document.getElementById('tbselisih');

  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }

  for (var i = 0; i < selisih.length; i++) {
    var row = `<tr align="Center">
              <td>${selisih[i].MITRA}</td>
              <td>${selisih[i].TANGGAL}</td>
              <td>${selisih[i].LOKET}</td>
              <td>${selisih[i].NAMA}</td>
              <td>${selisih[i].SALDO_AWAL}</td>
              <td>${selisih[i].TOTAL_STOR}</td>
              <td>${selisih[i].TOTAL_TRANSAKSI}</td>
              <td>${selisih[i].SALDO_AKHIR}</td>
              <td>${selisih[i].SALDO_CURRENT}</td>
              <td>${selisih[i].SELISIH}</td>
              </tr>`
    table.innerHTML += row
    //  deleteUser(i);
  }
}

function getHakAkses() {
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/hakakses";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      result = JSON.parse(this.responseText);

      valueHakAkses()
    }
  };
  xhr.send("");
}

function valueHakAkses() {
  var select = document.getElementById('selectHakAkses')
  for (var i = 0; i < result.length; i++) {
    var option = `<tr align="Center">
              <option value="${result[i].hakakses}">${result[i].hakakses}</option>
              </tr>`
    select.innerHTML += option
  }
}

function getMenu() {
  let username = document.querySelector('#username');
  let password = document.querySelector('#password');
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/menu";

  // open a connection
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var result = JSON.parse(this.responseText);
      localStorage.setItem("menu", this.responseText);

    }
  };
  var data = JSON.stringify({
    "username": username.value,
    "password": password.value
  });
  xhr.send(data);
}

function valueMenu() {
  var result = JSON.parse(localStorage.getItem("menu"));
  var menuGDB = document.getElementById('menuGDB');
  var menuCompare = document.getElementById('menuCompare');
  var menuReconcile = document.getElementById('menuReconcile');
  var menuTools = document.getElementById('menuTools');
  var menuAccount = document.getElementById('menuAccount');
  for (var i = 0; i < result.length; i++) {


    if (result[i].mainmenu == "GetDataBiller") {
      var option =
        `<li class="nav-item">
      <a href="${result[i].link}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>${result[i].submenu}</p>
      </a>
    </li>`
      submenu = document.createElement('li');
      submenu.innerHTML += option
      menuGDB.appendChild(submenu);
    }else if (result[i].mainmenu == "Compare") {
      var option =
        `<li class="nav-item">
      <a href="${result[i].link}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>${result[i].submenu}</p>
      </a>
    </li>`
      submenu = document.createElement('li');
      submenu.innerHTML += option
      menuCompare.appendChild(submenu);
    } else if (result[i].mainmenu == "Reconcile") {
      var option =
        `<li class="nav-item">
      <a href="${result[i].link}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>${result[i].submenu}</p>
      </a>
    </li>`
      submenu = document.createElement('li');
      submenu.innerHTML += option
      menuReconcile.appendChild(submenu);
    } else if (result[i].mainmenu == "Tools") {
      var option =
        `<li class="nav-item">
      <a href="${result[i].link}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>${result[i].submenu}</p>
      </a>
    </li>`
      submenu = document.createElement('li');
      submenu.innerHTML += option
      menuTools.appendChild(submenu);
    } else if (result[i].mainmenu == "Account") {
      var option =
        `<li class="nav-item">
      <a href="${result[i].link}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>${result[i].submenu}</p>
      </a>
    </li>`
      submenu = document.createElement('li');
      submenu.innerHTML += option
      menuAccount.appendChild(submenu);
    }
  }

}

function cekLog() {

  let idpel = document.getElementById('idpel');
  let tanggal = document.getElementById('tanggal');
  let biller = document.getElementById('switching');
  let result = document.querySelector('.logupload');
  let tombolCekLog = document.getElementById('tombolCekLog');

  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/logsinglegateway";

  var row = '';
  result.innerHTML = '';
  tombolCekLog.disabled = true;

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var status = JSON.parse(this.responseText);
      localStorage.setItem("LOG", this.responseText);

      tableLog();
      tombolCekLog.disabled = false;
      for (var i = 0; i < status.length; i++) {
        // row = `<b>${status[i].LOG}</b><br>`;
        result.innerHTML += row;
        tombolCekLog.disabled = false;
      }
    } else {
      tombolCekLog.disabled = false;

    }
  };

  // Converting JSON data to string
  var data = JSON.stringify({
    "tanggal": tanggal.value.replace(/-/g, ""),
    "biller": biller.value,
    "idpel": idpel.value
  });
  // Sending data with the request
  xhr.send(data);
}

function tableLog() {
  var log = JSON.parse(localStorage.getItem("LOG"));
  let biller = document.getElementById('switching');
  var table = document.getElementById('tableLogSingleGw');
  var table2 = document.getElementById('theadLogSinglegw');

  var Parent = table;
  var Parent2 = table2;

  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
  while (Parent2.hasChildNodes()) {
    Parent2.removeChild(Parent2.firstChild);
  }


  if (biller.value == "BIMASAKTI" || biller.value == "CPN" || biller.value == "PDAM_MADIUN") {
    var thead = `<tr >
                      <th> TIME </th>
                      <th> SESSION </th>
                      <th> PROCESS </th>
                      <th> DETAIL </th>
                      </tr>`
    table2.innerHTML += thead
    for (var i = 0; i < log.length; i++) {
      var array = log[i].LOG.split("|");
      var logArrayA = array[1],
        logArrayB = array[2],
        logArrayC = array[3],
        logArrayD = array[4];
      var row = `<tr >
                        <td>${logArrayA}</td>
                        <td>${logArrayB}</td>
                        <td>${logArrayC}</td>
                        <td>${logArrayD}</td>
                        </tr>`
      table.innerHTML += row
    }
  } else if (biller.value == "DJI" || biller.value == "BAKOEL" || biller.value == "MULTIBILLER_JPA") {
    var thead = `<tr >
                      <th> TIME </th>
                      <th> SESSION </th>
                      <th> DETAIL </th>
                      </tr>`
    table2.innerHTML += thead
    for (var i = 0; i < log.length; i++) {
      var array = log[i].LOG.split("|");
      var logArrayA = array[1],
        logArrayB = array[2],
        logArrayC = array[3];
      var row = `<tr >
                        <td>${logArrayA}</td>
                        <td>${logArrayB}</td>
                        <td>${logArrayC}</td>
                        </tr>`
      table.innerHTML += row
    }
  } else {
    for (var i = 0; i < log.length; i++) {
      var array = log[i].LOG.split("|");
      var row = `<tr >
                        <td>${array}</td>
                        </tr>`
      table.innerHTML += row
    }

  }

}

function getSwitchingName() {
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/getbillerlogsinglegateway";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      result = JSON.parse(this.responseText);

      valueSwitchingName()
    }
  };
  xhr.send("");
}

function valueSwitchingName() {
  var select = document.getElementById('switching')
  for (var i = 0; i < result.length; i++) {
    var option = `<tr align="Center">
              <option value="${result[i].BILLER}">${result[i].BILLER}</option>
              </tr>`
    select.innerHTML += option

    //  deleteUser(i);
  }
}

function getlistDb() {
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/getlistdb";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      result = JSON.parse(this.responseText);

      valuelistDb()
    }
  };
  xhr.send("");
}

function valuelistDb() {
  var select = document.getElementById('selectDb')
  for (var i = 0; i < result.length; i++) {
    var option = `<tr align="Center">
              <option value="${result[i].DB}">${result[i].DB}</option>
              </tr>`
    select.innerHTML += option

    //  deleteUser(i);
  }
}

function getlistProduk() {
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/getproduk";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      result = JSON.parse(this.responseText);

      valuelistProduk()
    }
  };
  xhr.send("");
}

function valuelistProduk() {
  var select = document.getElementById('selectProduk')
  for (var i = 0; i < result.length; i++) {
    var option = `<tr align="Center">
              <option value="${result[i].PRODUK}">${result[i].PRODUK}</option>
              </tr>`
    select.innerHTML += option
  }
}

function getlistSwitching() {
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/getswitching";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      result = JSON.parse(this.responseText);

      valuelistSwitching()
    }
  };
  xhr.send("");
}

function valuelistSwitching() {
  var select = document.getElementById('selectSwitching')
  for (var i = 0; i < result.length; i++) {
    var option = `<tr align="Center">
              <option value="${result[i].SWITCHING}">${result[i].SWITCHING}</option>
              </tr>`
    select.innerHTML += option
  }
}

function getFormatLog() {
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/getformat";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      result = JSON.parse(this.responseText);

      valueFormatLog()
    }
  };
  xhr.send("");
}

function valueFormatLog() {
  var select = document.getElementById('selectFormatLog')
  for (var i = 0; i < result.length; i++) {
    var option = `<tr align="Center">
              <option value="${result[i].FORMAT}">${result[i].FORMAT}</option>
              </tr>`
    select.innerHTML += option
  }
}

function forceSuspect() {
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/force";
  let tombolProses = document.getElementById("SuspectProses");
  // let tombolReset = document.getElementById("suspectCancel");
  let log = document.querySelector('.logProsesSuspect');
  let db = document.getElementById("selectDb");
  let produk = document.getElementById("selectProduk");
  let switching = document.getElementById("selectSwitching");
  let idpel = document.getElementById("idPel");
  let kodeloket = document.getElementById("kdLoket");
  let tanggal = document.getElementById("tanggalTrx");
  let logclient = document.querySelector(".logClient");
  let loginq = document.querySelector(".logInquery");
  let logpay = document.querySelector(".logPayment");
  let bit48 = document.querySelector(".bit48");
  let format = document.getElementById("selectFormatLog");

  tombolProses.disabled = true;
  // tombolReset.disabled = false;
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var status = JSON.parse(this.responseText);
      for (var i = 0; i < status.length; i++) {
        row = `<p><b>
        INFO             : ${status[i].INFO}<br>
        PROCESS CODE     : ${status[i].ProcessCode}<br>
        USER ID          : ${status[i].UserID}<br>
        TRANSACTION DATE : ${status[i].CustomerDate}<br>
        TRANSACTION TIME : ${status[i].CustomerTime}<br>
        CUSTOMER ID      : ${status[i].CustomerID}<br>
        CUSTOMER NAME    : ${status[i].CustomerName}<br>
        SWITHCING        : ${status[i].Switching}<br>
        SWITCHING REFF   : ${status[i].SwitchingReff}<br>
        CUBICATION       : ${status[i].Cubication}<br>
        PERIOD           : ${status[i].Period}<br>
        CUSTOMER BILL    : ${status[i].CustomerBill}<br>
        </b><p>`;
        log.innerHTML += row;
        tombolProses.disabled = false;
      }
    }
  };

  var data = JSON.stringify({
    "produk": produk.value,
    "switching": switching.value,
    "link": db.value,
    "LogClient": logclient.value,
    "loginq": loginq.value,
    "logpay": logpay.value,
    "bit48": bit48.value,
    "format": format.value
  });
  xhr.send(data);
}

// function suspectCancel(){
//   let tombolProses = document.getElementById("SuspectProses");
//   let tombolReset document.getElementById("suspectCancel");
//   tombolProses.disabled = false;
//   tombolReset.disabled = true;
// }

function getProdukSwitchingDb() {
  getlistDb()
  getlistProduk()
  getlistSwitching()
  getFormatLog()
}

function overlay() {
  var overlay = document.getElementById("overlay");
  var loading = document.getElementById("loading");

  overlay.style.display = "none";
  loading.style.display = "none";
}

function overlay2() {
  var overlay = document.getElementById("overlay2");
  var loading = document.getElementById("loading2");

  overlay.style.display = "none";
  loading.style.display = "none";
}

function prosesComparePLN() {
  let firstDate = document.getElementById('firstDate');
  let endDate = document.getElementById('endDate');
  let procesName = document.getElementById('procesName');
  let checkboxBank = document.getElementsByClassName('checkboxBank');
  let produkPLN = document.getElementsByClassName('produkPLN');
  let mitraName = document.getElementsByClassName('mitraName');
  let result = document.querySelector('.logComparePLN');
  var tombolProses = document.getElementById("plnProses");
  var tombolReset = document.getElementById("resetProses");
  var overlay = document.getElementById("overlay");
  var loading = document.getElementById("loading");

  var bank = '';
  var produk = '';
  var mitra = '';
  var row = '';
  result.innerHTML = '';
  tombolProses.disabled = true;
  tombolReset.disabled = true;
  overlay.style.display = "block";
  loading.style.display = "block";
  var x = 0;
  for (i = 0; i < checkboxBank.length; i++) {
    if (checkboxBank[i].checked) {
      x++
    }
    if (checkboxBank[i].checked && x == 1) {
      bank += checkboxBank[i].value;
    } else if (checkboxBank[i].checked && x >> 1) {
      bank += "," + checkboxBank[i].value;
    }
  }
  x = 0;
  for (i = 0; i < produkPLN.length; i++) {
    if (produkPLN[i].checked) {
      x++
    }
    if (produkPLN[i].checked && x == 1) {
      produk += produkPLN[i].value;
    } else if (produkPLN[i].checked && x >> 1) {
      produk += "," + produkPLN[i].value;
    }
  }
  x = 0;
  for (i = 0; i < mitraName.length; i++) {
    if (mitraName[i].checked) {
      x++
    }
    if (mitraName[i].checked && x == 1) {
      mitra += mitraName[i].value;
    } else if (mitraName[i].checked && x >> 1) {
      mitra += "," + mitraName[i].value;
    }
  }

  let xhr = new XMLHttpRequest();
  if (procesName.value === "getDataWeb") {
    let url = "http://" + server + "/getdatawebpln";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Print received data from server
        var status = JSON.parse(this.responseText);
        for (var i = 0; i < status.length; i++) {
          row = `<b>${status[i].STATUS} : ${status[i].PESAN}</b><br>`;
          result.innerHTML += row;
          tombolProses.disabled = false;
          tombolReset.disabled = false;
          overlay.style.display = "none";
          loading.style.display = "none";
        }
      } else {
        tombolProses.disabled = false;
        tombolReset.disabled = false;
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  } else if (procesName.value === "compareData") {

    let url = "http://" + server + "/comparewebftppln";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Print received data from server
        var status = JSON.parse(this.responseText);
        for (var i = 0; i < status.length; i++) {
          row = `<b>${status[i].STATUS} ${status[i].PESAN}</b><br>`;
          result.innerHTML += row;
          tombolProses.disabled = false;
          tombolReset.disabled = false;
          overlay.style.display = "none";
          loading.style.display = "none";
        }
      } else {
        tombolProses.disabled = false;
        tombolReset.disabled = false;
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  }
  var data = JSON.stringify({
    "bank": bank,
    "produk": produk,
    "mitra": mitra,
    "tanggal": firstDate.value.replace(/-/g, "") + "-" + endDate.value.replace(/-/g, "")
  });
  xhr.send(data);
}

function prosesReportPLN() {
  let xhr = new XMLHttpRequest();
  let bulan = document.getElementById("selectBulan");

  let tahun = document.getElementById("selectTahun");
  let bank = document.getElementById("selectBank");
  let tipeData = document.getElementById("selectTipeData");

  var overlay = document.getElementById("overlay2");
  var loading = document.getElementById("loading2");

  overlay.style.display = "block";
  loading.style.display = "block";

  if (bulan.value == "JANUARI") {
    var bulan2 = "01";
  } else if (bulan.value == "FEBRUARI") {
    var bulan2 = "02";
  } else if (bulan.value == "MARET") {
    var bulan2 = "03";
  } else if (bulan.value == "APRIL") {
    var bulan2 = "04";
  } else if (bulan.value == "MEI") {
    var bulan2 = "05";
  } else if (bulan.value == "JUNI") {
    var bulan2 = "06";
  } else if (bulan.value == "JULI") {
    var bulan2 = "07";
  } else if (bulan.value == "AGUSTUS") {
    var bulan2 = "08";
  } else if (bulan.value == "SEPTEMBER") {
    var bulan2 = "09";
  } else if (bulan.value == "OKTOBER") {
    var bulan2 = "10";
  } else if (bulan.value == "NOVEMBER") {
    var bulan2 = "11";
  } else if (bulan.value == "DESEMBER") {
    var bulan2 = "12";
  }

  if (tipeData.value == "dataAwal") {
    let url = "http://" + server + "/dataawalpln";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        status = JSON.parse(this.responseText);
        localStorage.setItem("STATUS", this.responseText);
        tabelReportPLN();
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  } else if (tipeData.value == "dataFinal") {
    let url = "http://" + server + "/datafinalpln";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        status = JSON.parse(this.responseText);
        localStorage.setItem("STATUS", this.responseText);
        tabelReportPLN();
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  }

  var data = JSON.stringify({
    "blth": tahun.value + bulan2,
    "bank": bank.value
  });
  xhr.send(data);

}

function tabelReportPLN() {
  var status = JSON.parse(localStorage.getItem("STATUS"));
  var headerBulan = document.getElementsByClassName('bulanPLN');
  var headerTahun = document.getElementsByClassName('tahunPLN');
  var tableDuta = document.getElementById('tbDuta');
  var tableSS = document.getElementById('tbSS');
  var tableKEKAL = document.getElementById('tbKEKAL');
  var tablePSB = document.getElementById('tbPSB');
  var tableMTR = document.getElementById('tbMTR');
  var tablePJT = document.getElementById('tbPJT');
  var tableMMM = document.getElementById('tbMMM');
  var tableCAQ = document.getElementById('tbCAQ');
  var tableSKP = document.getElementById('tbSKP');
  var tableALFA = document.getElementById('tbALFA');
  var tableMIDI = document.getElementById('tbMIDI');
  var tableLAWSON = document.getElementById('tbLAWSON');
  var tableALL = document.getElementById('tbALL');

  while (tableALL.rows.length > 0) {
    tableALL.deleteRow(0);
    tableDuta.deleteRow(0);
    tableSS.deleteRow(0);
    tableKEKAL.deleteRow(0);
    tablePSB.deleteRow(0);
    tableMTR.deleteRow(0);
    tablePJT.deleteRow(0);
    tableMMM.deleteRow(0);
    tableCAQ.deleteRow(0);
    tableSKP.deleteRow(0);
    tableALFA.deleteRow(0);
    tableMIDI.deleteRow(0);
    tableLAWSON.deleteRow(0);

  }


  for (var i = 0; i < status.length; i++) {
    if (status[i].Header == "BLTH") {

      headerBulan.innerHTML = status[i].Bulan;
      headerTahun.innerHTML = status[i].Tahun;

    } else if (status[i].Mitra == "DUTA") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableDuta.innerHTML += row
    } else if (status[i].Mitra == "SS") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableSS.innerHTML += row
    } else if (status[i].Mitra == "KEKAL") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableKEKAL.innerHTML += row
    } else if (status[i].Mitra == "PSB") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tablePSB.innerHTML += row
    } else if (status[i].Mitra == "MTR") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableMTR.innerHTML += row
    } else if (status[i].Mitra == "PJT") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tablePJT.innerHTML += row
    } else if (status[i].Mitra == "MMM") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableMMM.innerHTML += row
    } else if (status[i].Mitra == "CAQ") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableCAQ.innerHTML += row
    } else if (status[i].Mitra == "SKP") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableSKP.innerHTML += row
    } else if (status[i].Mitra == "ALFA") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableALFA.innerHTML += row
    } else if (status[i].Mitra == "MIDI") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableMIDI.innerHTML += row
    } else if (status[i].Mitra == "LAWSON") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tableLAWSON.innerHTML += row
    } else if (status[i].Mitra == "ALL MITRA") {
      var row = `<tr align="Center">
      <td>${status[i].Tanggal}</td>
      <td>${status[i].LembarWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Postpaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Postpaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Postpaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Prepaid.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Prepaid.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Prepaid.toLocaleString('en')}</p></td>
      <td>${status[i].LembarWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagWeb_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].LembarBiller_Nontaglis.toLocaleString('en')}</td>
      <td>${status[i].RptagBiller_Nontaglis.toLocaleString('en')}</td>
      <td><p style="color:red">${status[i].LembarSelisih_Nontaglis.toLocaleString('en')}</p></td>
      <td><p style="color:red">${status[i].RptagSelisih_Nontaglis.toLocaleString('en')}</p></td>
                </tr>`
      tbALL.innerHTML += row
    }
  }
}


function dataExcel() {
  var wb = XLSX.utils.book_new();
  var ws = XLSX.utils.table_to_sheet(document.getElementById('tbDUTA0'));
  wb.SheetNames.push("DUTA ARIES");
  wb.Sheets["DUTA ARIES"] = ws;

  var ws2 = XLSX.utils.table_to_sheet(document.getElementById('tbSS0'));
  wb.SheetNames.push("SAMUDERA SOLUSINDO");
  wb.Sheets["SAMUDERA SOLUSINDO"] = ws2;

  var ws3 = XLSX.utils.table_to_sheet(document.getElementById('tbKEKAL0'));
  wb.SheetNames.push("KARYA EKA KALBU");
  wb.Sheets["KARYA EKA KALBU"] = ws3;

  var ws4 = XLSX.utils.table_to_sheet(document.getElementById('tbPSB0'));
  wb.SheetNames.push("PUSKUD SUMBAR");
  wb.Sheets["PUSKUD SUMBAR"] = ws4;

  var ws5 = XLSX.utils.table_to_sheet(document.getElementById('tbMTR0'));
  wb.SheetNames.push("PUSKUD METARAM");
  wb.Sheets["PUSKUD METARAM"] = ws5;

  var ws6 = XLSX.utils.table_to_sheet(document.getElementById('tbPJT0'));
  wb.SheetNames.push("PUSKUD JATENG");
  wb.Sheets["PUSKUD JATENG"] = ws6;

  var ws7 = XLSX.utils.table_to_sheet(document.getElementById('tbMMM0'));
  wb.SheetNames.push("MULTI MITRA MANDIRI");
  wb.Sheets["MULTI MITRA MANDIRI"] = ws7;

  var ws8 = XLSX.utils.table_to_sheet(document.getElementById('tbCAQ0'));
  wb.SheetNames.push("CAHAYA AQILA");
  wb.Sheets["CAHAYA AQILA"] = ws8;

  var ws9 = XLSX.utils.table_to_sheet(document.getElementById('tbSKP0'));
  wb.SheetNames.push("SUWA KARYA PRATAMA");
  wb.Sheets["SUWA KARYA PRATAMA"] = ws9;

  var ws10 = XLSX.utils.table_to_sheet(document.getElementById('tbALFA0'));
  wb.SheetNames.push("SUMBER ALFARIA TRIJAYA");
  wb.Sheets["SUMBER ALFARIA TRIJAYA"] = ws10;

  var ws11 = XLSX.utils.table_to_sheet(document.getElementById('tbMIDI0'));
  wb.SheetNames.push("MIDI UTAMA INDONESIA");
  wb.Sheets["MIDI UTAMA INDONESIA"] = ws11;

  var ws12 = XLSX.utils.table_to_sheet(document.getElementById('tbLAWSON0'));
  wb.SheetNames.push("LANCAR WHIGUNA SEJAHTERA");
  wb.Sheets["LANCAR WHIGUNA SEJAHTERA"] = ws12;

  var ws13 = XLSX.utils.table_to_sheet(document.getElementById('tbALL'));
  wb.SheetNames.push("ALL MITRA");
  wb.Sheets["ALL MITRA"] = ws13;

  var wbout = XLSX.write(wb, {
    bookType: 'xlsx',
    bookSST: true,
    type: 'binary'
  });


  saveAs(new Blob([s2ab(wbout)], {
    type: "application/octet-stream"
  }), 'REKAP KOMPARASI PLN.xlsx');

}

function s2ab(s) {
  var buf = new ArrayBuffer(s.length);
  var view = new Uint8Array(buf);
  for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
  return buf;
}

function RekonMultiBiller() {
  // showLoader()
  let firstDate = document.getElementById('firstDate');
  let endDate = document.getElementById('endDate');
  let procesName = document.getElementById('procesName');
  let checkboxProduk = document.getElementsByClassName('checkboxProduk');
  let result = document.querySelector('.logProsesMbiller');
  var tombolProses = document.getElementById("multibillerProses");
  var tombolReset = document.getElementById("resetProses");
  var overlay = document.getElementById("overlay");
  var loading = document.getElementById("loading");

  var produk = '';
  var row = '';
  result.innerHTML = '';
  tombolProses.disabled = true;
  tombolReset.disabled = true;
  overlay.style.display = "block";
  loading.style.display = "block";
  var x = 0;
  for (i = 0; i < checkboxProduk.length; i++) {
    if (checkboxProduk[i].checked) {
      x++
    }
    if (checkboxProduk[i].checked && x == 1) {
      produk += checkboxProduk[i].value;
    } else if (checkboxProduk[i].checked && x >> 1) {
      produk += "," + checkboxProduk[i].value;
    }
  }

  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/rekonmultibiller";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Print received data from server
      var status = JSON.parse(this.responseText);
      for (var i = 0; i < status.length; i++) {
        row = `<b>${status[i].STATUS} : ${status[i].PESAN}</b><br>`;
        result.innerHTML += row
        tombolProses.disabled = false;
        tombolReset.disabled = false;
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    } else {
      tombolProses.disabled = false;
      tombolReset.disabled = false;
      overlay.style.display = "none";
      loading.style.display = "none";
    }
  };
  var data = JSON.stringify({
    "request": procesName.value,
    "tanggal": firstDate.value.replace(/-/g, "") + "-" + endDate.value.replace(/-/g, ""),
    "biller": produk
  });
  xhr.send(data);
}

function GetMenuList() {
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/crudmenu";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      menulist = JSON.parse(this.responseText);
      builTableMenuList();
    }
  };
  var data = JSON.stringify({
    "tipe": "GET"
  });
  xhr.send(data);
}

function builTableMenuList() {

  var table = document.getElementById('tbmenulist')
  for (var i = 0; i < menulist.length; i++) {
    var row = `<tr align="Center">
              <td>${menulist[i].Main_Menu}</td>
              <td>${menulist[i].Sub_Menu}</td>
              <td>${menulist[i].Link}</td>
              <td>${menulist[i].hak_akses}</td>
              <td><button onclick="alertbuildtablemenulist()" class="btn btn-primary btn-block">Edit</button></td>
              <td><button onClick="alertbuildtablemenulist()" class="btn btn-danger btn-block">Delete</button></td>
              </tr>`
    table.innerHTML += row

  }
}

function alertbuildtablemenulist() {
  window.alert("Maintenance");
}

function AddMenu() {

  let submenu = document.querySelector('#submenu');
  let urlAddMenu = document.querySelector('#url');
 // let inputMainMenu = document.querySelector('#inputMainMenu');
  let inputMainMenu = document.getElementById('#inputMainMenu');
  let checkboxHakAkses = document.getElementsByClassName('checkboxHakAkses');
  var hakAkses = '';

  var x = 0;
  for (i = 0; i < checkboxHakAkses.length; i++) {
    if (checkboxHakAkses[i].checked) {
      x++
    }
    if (checkboxHakAkses[i].checked && x == 1) {
      hakAkses += checkboxHakAkses[i].value;
    } else if (checkboxHakAkses[i].checked && x >> 1) {
      hakAkses += "," + checkboxHakAkses[i].value;
    }
  }

  
  // Creating a XHR object
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/crudmenu";
  
  // open a connection
  xhr.open("POST", url, true);
  // Set the request header i.e. which type of content you are sending
  xhr.setRequestHeader("Content-Type", "text/plain");
  // Create a state change callback
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Print received data from server
      //result.innerHTML = this.responseText;
      var status = JSON.parse(this.responseText);
      alert(status);
      status.reduce((r, a) => {
        r[a.Main_Menu] = r[a.Main_Menu] || [];
        r[a.Main_Menu].push(a.Main_Menu);
        return r;
      }, Object.create(null));

      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = JSON.parse(http.responseText);
        var grup = response.filter((v, i, a) => a.findIndex(v2 => (v2.Main_Menu === v.Main_Menu)) === i).map(x => x.Main_Menu);
        console.log(grup);
      }
    };
    var body = `{
      "tipe": "GET",
      "sub_menu": "",
      "main_menu": "",
      "link": "",
      "hak_akses": ""
    }`;
    http.send(body);

      //alert(status.STATUS);
      // if (users.USERNAME == users.USERNAME && status.STATUS == 'BERHASIL') {
        //   // They clicked Yes
      //   alert(status.STATUS);
      //   window.location = 'user.html'
      //   //  alert(this.responseText);
      // } else {
      //   // They clicked no
      //   alert(status.STATUS);
      // }
 
  };

  // Converting JSON data to string
  var data = JSON.stringify({
    "tipe": "CREATE",
    "main_menu": inputMainMenu.value,
    "sub_menu": submenu.value,
    "link": urlAddMenu.value,
    "hak_akses": hakAkses
  });
  // Sending data with the request
  xhr.send(data);

}

function KroscekDataLIM() {
  let xhr = new XMLHttpRequest();
  let firstDate = document.getElementById('firstDate');
  let endDate = document.getElementById('endDate');
  let procesName = document.getElementById('selectProcess');
  let checkboxProd = document.getElementsByClassName('produkMenuKroscek');
  var overlay = document.getElementById("overlay");
  var loading = document.getElementById("loading");
  var result = document.querySelector('.logKroscekDataLIM');

  var produk = '';
  var mitra = '';
  var row = '';
  result.innerHTML = '';

  overlay.style.display = "block";
  loading.style.display = "block";
  var x = 0;
  for (i = 0; i < checkboxProd.length; i++) {
    if (checkboxProd[i].checked) {
      x++
    }
    if (checkboxProd[i].checked && x == 1) {
      produk += checkboxProd[i].value;
    } else if (checkboxProd[i].checked && x >> 1) {
      produk += "," + checkboxProd[i].value;
    }
  }
  if (procesName.value === "COMPARE") {
    let url = "http://" + server + "/rekonmultibillercompare";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Print received data from server
        var status = JSON.parse(this.responseText);
        console.log(status);
        for (var i = 0; i < status.length; i++) {
          row = `<b>${status[i].STATUS}</b><br>`;
          console.log(row);
          result.innerHTML += row
          overlay.style.display = "none";
          loading.style.display = "none";
        }
      } else {
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };
  } else if (procesName.value === "RESULT") {

    let url = "http://" + server + "/rekonmultibillercompare";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Print received data from server
        var status = JSON.parse(this.responseText);

        localStorage.setItem("STATUS", this.responseText);
        buildTableKroscekDataLIM();
        overlay.style.display = "none";
        loading.style.display = "none";
      } else {
        overlay.style.display = "none";
        loading.style.display = "none";
      }
    };

  }
  var data = JSON.stringify({
    "produk": produk,
    "proses": procesName.value,
    "tanggal": firstDate.value.replace(/-/g, "") + "-" + endDate.value.replace(/-/g, "")
  });
  xhr.send(data);
}

function buildTableKroscekDataLIM() {

  var status = JSON.parse(localStorage.getItem("STATUS"));

  var tablePulsa = document.getElementById('tbKorscekPulsa');
  var tableRKFinnet = document.getElementById('tbKorscekRekapFinnet');
  delRowsTbPulsa();
  delRowsTbFinnet();

  for (var i = 0; i < status.length; i++) {
    if (status[i].GRUP_PRODUK == "PULSA") {
      var row = `<tr align="Center">
              <td>${status[i].TANGGAL}</td>
              <td>${status[i].PRODUK}</td>
              <td>${status[i].PRODUK}</td>
              <td>${status[i].LBR_DRC.toLocaleString('en')}</td>
              <td>${status[i].LBR_WEB.toLocaleString('en')}</td>
              <td><p style="color:red">${status[i].LBR_SELISIH.toLocaleString('en')}</p></td>
              <td>${status[i].RPBELI_DRC.toLocaleString('en')}</td>
              <td>${status[i].RPBELI_WEB.toLocaleString('en')}</td>
              <td><p style="color:red">${status[i].RPBELI_SELISIH.toLocaleString('en')}</p></td>
              <td>${status[i].RPJUAL_DRC.toLocaleString('en')}</td>
              <td>${status[i].RPJUAL_WEB.toLocaleString('en')}</td>
              <td><p style="color:red">${status[i].RPJUAL_SELISIH.toLocaleString('en')}</p></td>
              </tr>`
      tablePulsa.innerHTML += row
    } else if (status[i].GRUP_PRODUK == "FINNET") {
      var row = `<tr align="Center">
            <td>${status[i].TANGGAL}</td>
            <td>${status[i].PRODUK}</td>
            <td>${status[i].LEMBAR_DRC.toLocaleString('en')}</td>
            <td>${status[i].LEMBAR_REKAP.toLocaleString('en')}</td>
            <td><p style="color:red">${status[i].LEMBAR_SELISIH.toLocaleString('en')}</p></td>
            <td>${status[i].RPTAG_DRC.toLocaleString('en')}</td>
            <td>${status[i].RPTAG_REKAP.toLocaleString('en')}</td>
            <td><p style="color:red">${status[i].RPTAG_SELISIH.toLocaleString('en')}</p></td>
            </tr>`
      tableRKFinnet.innerHTML += row
    }
  }
}

function delRowsTbPulsa() {
  var tablePulsa = document.getElementById('tbKorscekPulsa');
  var Parent = document.getElementById('tbKorscekPulsa');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function delRowsTbFinnet() {
  var tableRKFinnet = document.getElementById('tbKorscekRekapFinnet');
  var Parent = document.getElementById('tbKorscekRekapFinnet');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

// [START] JS MENU PRODUK_MENU REKON
function getSwitchingMenuCompare() {
  var div = document.getElementById("divNewSwitching");
  div.style.display = "none";


  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/produkreconbiller";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    console.log(xhr.status);
    if (xhr.readyState === 4 && xhr.status === 200) {
      result = JSON.parse(this.responseText);
      console.log(this.responseText);
      valueSwitchingMenuCompare()

    }
  };
  var data = JSON.stringify({
    "request": "tab"
  });
  xhr.send(data);
}

function valueSwitchingMenuCompare() {


  var select = document.getElementById('selectSwitchingMenuCompare')
  for (var i = 0; i < result.length; i++) {
    var option = `<tr align="Center">
              <option value="${result[i].SWITCHING}">${result[i].SWITCHING}</option>
              </tr>
              `
    select.innerHTML += option
  }

  var newswitching = `<option value="newSwitching">CREATE NEW</option>`
  select.innerHTML += newswitching
}

function getProductandSwitching() {
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/produkreconbiller";
  var div = document.getElementById("divNewSwitching");
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      fortable = JSON.parse(this.responseText);
      builTableProductandSwitching();
    }
  };
  var data = JSON.stringify({
    "request": "get"
  });
  xhr.send(data);
}

function builTableProductandSwitching() {

  var table = document.getElementById('tbprodukandswitching')
  for (var i = 0; i < fortable.length; i++) {
    var row = `<tr align="Center">
              <td>${fortable[i].SWITCHING}</td>
              <td>${fortable[i].PRODUK}</td>
              <td><button onclick="alertbuildtablemenulist()" class="btn btn-primary btn-block">Edit</button></td>
              <td><button onClick="alertbuildtablemenulist()" class="btn btn-danger btn-block">Delete</button></td>
              </tr>`
    table.innerHTML += row

  }
}

function customSwitching() {
  var x = document.getElementById("selectSwitchingMenuCompare").value;
  var div = document.getElementById("divNewSwitching");
  if (x == "newSwitching") {
    console.log(x);
    div.style.display = "block";
  } else {
    div.style.display = "none";
  }

}

function AddProdukMenuCompare() {
  var switchingExsisting = document.getElementById('selectSwitchingMenuCompare').value;
  var div = document.getElementById("divNewSwitching");
  var produk = document.getElementById('inputProdukMenuCompare');
  var status = document.getElementById('logProsesAddProduk');
  console.log();
  if (div.style.display = "block" && switchingExsisting == "newSwitching") {
    var switchingNew = document.getElementById('inputNewSwitching');
    let xhr = new XMLHttpRequest();
    let url = "http://" + server + "/produkreconbiller";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var infoproses = JSON.parse(this.responseText);
        console.log(this.responseText);
      }
    };
    console.log(switchingExsisting.value);
    var data1 = JSON.stringify({
      "request": "add",
      "switching": switchingNew.value,
      "produk": produk.value
    });
    xhr.send(data1);
  } else {
    console.log(switchingExsisting);
    let xhr = new XMLHttpRequest();
    let url = "http://" + server + "/produkreconbiller";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var infoproses = JSON.parse(this.responseText);
        status.innerHTML += this.responseText;
        console.log(this.responseText);
        console.log(infoproses);
      }
    };
    var data2 = JSON.stringify({
      "request": "add",
      "switching": switchingExsisting,
      "produk": produk.value

    });
    xhr.send(data2);
  }
}

function getSwitchingRekon(){
  var tabed = document.getElementById('custom-tabs-one-tab');
  var divtable = document.getElementById('custom-tabs-one-tabContent');
  let xhr = new XMLHttpRequest();
  let url = "http://192.168.5.16:8080/produkreconbiller";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var result = JSON.parse(this.responseText);
      console.log(result);
      for (var i = 0; i < result.length; i++) {
        var tabs =
          `<a class="nav-link" id="custom-tabs-one-${result[i].SWITCHING}-tab"
        data-toggle="pill" href="#custom-tabs-one-${result[i].SWITCHING}" role="tab" aria-controls="custom-tabs-one-${result[i].SWITCHING}"
         aria-selected="false">${result[i].SWITCHING}</a>`;
        createTabs = document.createElement('li');
        createTabs.setAttribute('class', 'nav-item');
        createTabs.innerHTML += tabs;
        tabed.appendChild(createTabs);

          var tables =
            `<table class="table table-bordered table-striped ${result[i].SWITCHING}" id="${result[i].SWITCHING}">
                <thead align="center">
                  <tr>
                    <th class="" colspan="19">DATA ${result[i].SWITCHING} BULAN <label class="${result[i].SWITCHING}">-</label> TAHUN <label class="${result[i].SWITCHING}">-</label></th>
                  </tr>
                </thead>
                <tbody >
                <tr id="${result[i].SWITCHING} head"></tr>
                <tr id="${result[i].SWITCHING} tanggal"></tr>
                </tbody>
              </table>`;
          createtables = document.createElement('div');
          createtables.setAttribute('class', 'tab-pane fade');
          createtables.setAttribute('id', 'custom-tabs-one-' + result[i].SWITCHING);
          createtables.setAttribute('role', 'tabpanel');
          createtables.setAttribute('aria-labelledby', 'custom-tabs-one-' + result[i].SWITCHING + '-tab');
          createtables.innerHTML += tables;
          divtable.appendChild(createtables);
        var tableProduk = document.getElementById(result[i].SWITCHING + " head");
        var tabelIsi = document.getElementById(result[i].SWITCHING + " tanggal");

      }
    }
  };
  var data = JSON.stringify({
    "request": "tab"
  });
  xhr.send(data);
}

function getSaldoBiller() {
  var dji = document.getElementById('rpDJI');
  var cpn = document.getElementById('rpCPN');
  var danucell = document.getElementById('rpDanucell');
  var mitracomm2 = document.getElementById('rpMITRACOMM2');
  var pratama = document.getElementById('rpPRATAMA');
  var bimasakti = document.getElementById('rpBIMASAKTI');
  var bakoel = document.getElementById('rpBAKOEL');
  var dummy = document.getElementById('rpDUMMY');

  var result = '';

  var overlaySaldoCPN = document.getElementById('overlaysaldoCPN');
  var overlaySaldoDJI = document.getElementById('overlaysaldoDJI');
  var overlaySaldoMITRACOMM2 = document.getElementById('overlaysaldoMITRACOMM2');
  var overlaySaldoDANUCELL = document.getElementById('overlaysaldoDANUCELL');
  var overlaySaldoPRATAMA = document.getElementById('overlaysaldoPRATAMA');
  var overlaySaldoBIMASAKTI = document.getElementById('overlaysaldoBIMASAKTI');
  var overlaySaldoBAKOEL = document.getElementById('overlaysaldoBAKOEL');
  var overlaySaldoDUMMY = document.getElementById('overlaysaldoDUMMY');

  var loadingSaldoCPN = document.getElementById('loadingSaldoCPN');
  var loadingSaldoDJI = document.getElementById('loadingSaldoDJI');
  var loadingSaldoMITRACOMM2 = document.getElementById('loadingSaldoMITRACOMM2');
  var loadingSaldoDANUCELL = document.getElementById('loadingSaldoDANUCELL');
  var loadingSaldoPRATAMA = document.getElementById('loadingSaldoPRATAMA');
  var loadingSaldoBIMASAKTI = document.getElementById('loadingSaldoBIMASAKTI');
  var loadingSaldoBAKOEL = document.getElementById('loadingSaldoBAKOEL');
  var loadingSaldoDUMMY = document.getElementById('loadingSaldoDUMMY');

  var inialertCPN = document.getElementById('inialertCPN');
  var inialertDJI = document.getElementById('inialertDJI');
  var inialertBIMASAKTI = document.getElementById('inialertBIMASAKTI');
  var inialertBAKOEL = document.getElementById('inialertBAKOEL');
  var inialertMITRACOMM2 = document.getElementById('inialertMITRACOMM2');
  var inialertPRATAMA = document.getElementById('inialertPRATAMA');
  var inialertDANUCELL = document.getElementById('inialertDANUCELL');
  var inialertDUMMY = document.getElementById('inialertDUMMY');

  var nilaiCPN = document.getElementById("nilaiCPN");
  var nilaiDJI = document.getElementById("nilaiDJI");
  var nilaiBAKOEL = document.getElementById("nilaiBAKOEL");
  var nilaiMITRACOMM2 = document.getElementById("nilaiMITRACOMM2");
  var nilaiPRATAMA = document.getElementById("nilaiPRATAMA");
  var nilaiDANUCELL = document.getElementById("nilaiDANUCELL");
  var nilaiBIMASAKTI = document.getElementById("nilaiBIMASAKTI");
  var nilaiDUMMY = document.getElementById("nilaiDUMMY");

  overlaySaldoCPN.style.display = "block";
  overlaySaldoDJI.style.display = "block";
  overlaySaldoMITRACOMM2.style.display = "block";
  overlaySaldoDANUCELL.style.display = "block";
  overlaySaldoPRATAMA.style.display = "block";
  overlaySaldoBIMASAKTI.style.display = "block";
  overlaySaldoBAKOEL.style.display = "block";
  overlaySaldoDUMMY.style.display = "block";

  loadingSaldoCPN.style.display = "block";
  loadingSaldoDJI.style.display = "block";
  loadingSaldoMITRACOMM2.style.display = "block";
  loadingSaldoDANUCELL.style.display = "block";
  loadingSaldoPRATAMA.style.display = "block";
  loadingSaldoBIMASAKTI.style.display = "block";
  loadingSaldoBAKOEL.style.display = "block";
  loadingSaldoDUMMY.style.display = "block";


  appendgetsaldoCPN();
  appendgetsaldoDJI();
  appendgetsaldoMITRACOMM2();
  appendgetsaldoDANUCELL();
  appendgetsaldoPRATAMA();
  appendgetsaldoBIMASAKTI();
  appendgetsaldoBAKOEL();
  appendgetsaldoBAKOEL();

  cpn.innerHTML += "-"
  dji.innerHTML += "-"
  mitracomm2.innerHTML += "-"
  danucell.innerHTML += "-"
  pratama.innerHTML += "-"
  bimasakti.innerHTML += "-"
  bakoel.innerHTML += "-"
  dummy.innerHTML += "-"

  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/getsaldo";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      saldo = JSON.parse(this.responseText);
      var saldoCPN = `${saldo.CPN.toLocaleString('en')}`
      var saldoDJI = `${saldo.DJI.toLocaleString('en')}`
      var saldoMITRACOMM2 = `${saldo.MITRACOMM2.toLocaleString('en')}`
      var saldoDANUCELL = `${saldo.DANUCELL.toLocaleString('en')}`
      var saldoPRATAMA = `${saldo.PRATAMA.toLocaleString('en')}`
      var saldoBIMASAKTI = `${saldo.BIMASAKTI.toLocaleString('en')}`
      var saldoBAKOEL = `${saldo.BAKOEL.toLocaleString('en')}`
      var saldoDUMMY = `${saldo.DUMMY.toLocaleString('en')}`

      overlaySaldoCPN.style.display = "none";
      overlaySaldoDJI.style.display = "none";
      overlaySaldoMITRACOMM2.style.display = "none";
      overlaySaldoDANUCELL.style.display = "none";
      overlaySaldoPRATAMA.style.display = "none";
      overlaySaldoBIMASAKTI.style.display = "none";
      overlaySaldoBAKOEL.style.display = "none";
      overlaySaldoDUMMY.style.display = "none";


      loadingSaldoCPN.style.display = "none";
      loadingSaldoDJI.style.display = "none";
      loadingSaldoMITRACOMM2.style.display = "none";
      loadingSaldoDANUCELL.style.display = "none";
      loadingSaldoPRATAMA.style.display = "none";
      loadingSaldoBIMASAKTI.style.display = "none";
      loadingSaldoBAKOEL.style.display = "none";
      loadingSaldoDUMMY.style.display = "none";
      appendgetsaldoCPN();
      appendgetsaldoDJI();
      appendgetsaldoMITRACOMM2();
      appendgetsaldoDANUCELL();
      appendgetsaldoPRATAMA();
      appendgetsaldoBIMASAKTI();
      appendgetsaldoBAKOEL();
      appendgetsaldoDUMMY();

      cpn.innerHTML += saldoCPN
      dji.innerHTML += saldoDJI
      mitracomm2.innerHTML += saldoMITRACOMM2
      danucell.innerHTML += saldoDANUCELL
      pratama.innerHTML += saldoPRATAMA
      bimasakti.innerHTML += saldoBIMASAKTI
      bakoel.innerHTML += saldoBAKOEL
      dummy.innerHTML += saldoDUMMY

      if (saldo.DJI < 20000000) {
        var Parent = document.getElementById('nilaiDJI');
        while (Parent.hasChildNodes()) {
          Parent.removeChild(Parent.firstChild);
        }
        inialertDJI.style.display = "block";
        nilaiDJI.innerHTML += saldoDJI

      } else {
        inialertDJI.style.display = "none";
      }

      if (saldo.CPN < 10000000) {
        var Parent = document.getElementById('nilaiCPN');
        while (Parent.hasChildNodes()) {
          Parent.removeChild(Parent.firstChild);
        }
        inialertCPN.style.display = "block";
        nilaiCPN.innerHTML += saldoCPN
      } else {
        inialertCPN.style.display = "none";
      }

      if (saldo.PRATAMA < 20000000) {
        var Parent = document.getElementById('nilaiPRATAMA');
        while (Parent.hasChildNodes()) {
          Parent.removeChild(Parent.firstChild);
        }
        inialertPRATAMA.style.display = "block";
        nilaiPRATAMA.innerHTML += saldoPRATAMA
      } else {
        inialertPRATAMA.style.display = "none";
      }

      if (saldo.DANUCELL < 5000000) {
        var Parent = document.getElementById('nilaiDANUCELL');
        while (Parent.hasChildNodes()) {
          Parent.removeChild(Parent.firstChild);
        }
        inialertDANUCELL.style.display = "block";
        nilaiDANUCELL.innerHTML += saldoDANUCELL
      } else {
        inialertDANUCELL.style.display = "none";
      }

      if (saldo.MITRACOMM2 < 20000000) {
        var Parent = document.getElementById('nilaiMITRACOMM2');
        while (Parent.hasChildNodes()) {
          Parent.removeChild(Parent.firstChild);
        }
        inialertMITRACOMM2.style.display = "block";
        nilaiMITRACOMM2.innerHTML += saldoMITRACOMM2
      } else {
        inialertMITRACOMM2.style.display = "none";
      }

      if (saldo.BAKOEL < 20000000) {
        var Parent = document.getElementById('nilaiBAKOEL');
        while (Parent.hasChildNodes()) {
          Parent.removeChild(Parent.firstChild);
        }
        inialertBAKOEL.style.display = "block";
        nilaiBAKOEL.innerHTML += saldoBAKOEL
      } else {
        inialertBAKOEL.style.display = "none";
      }

      if (saldo.BIMASAKTI < 20000000) {
        var Parent = document.getElementById('nilaiBIMASAKTI');
        while (Parent.hasChildNodes()) {
          Parent.removeChild(Parent.firstChild);
        }
        inialertBIMASAKTI.style.display = "block";
        nilaiBIMASAKTI.innerHTML += saldoBIMASAKTI
      } else {
        inialertBIMASAKTI.style.display = "none";
      }

      if (saldo.DUMMY < 1) {
        var Parent = document.getElementById('nilaiDUMMY');
        while (Parent.hasChildNodes()) {
          Parent.removeChild(Parent.firstChild);
        }
        inialertDUMMY.style.display = "block";
        nilaiDUMMY.innerHTML += saldoDUMMY
      } else {
        inialertDUMMY.style.display = "none";
      }


      // for (var i = 0; i < saldo.length; i++) {
      //   if (saldo[i].Switching == "DJI"){
      //     result = `${saldo[i].Saldo.toLocaleString('en')}`;
      //     console.log(result);
      //     appendgetsaldoDJI();
      //     dji.innerHTML += result
      //   }else if (saldo[i].Switching == "CPN"){
      //     result = `${saldo[i].Saldo.toLocaleString('en')}`;
      //     console.log(result);
      //     appendgetsaldoCPN();
      //     cpn.innerHTML += result
      //   }else if (saldo[i].Switching == "DANUCELL"){
      //     result = `${saldo[i].Saldo.toLocaleString('en')}`;
      //     console.log(result);
      //     appendgetsaldoDANUCELL();
      //     danucell.innerHTML += result
      //   }else if (saldo[i].Switching == "MITRACOMM2"){
      //     result = `${saldo[i].Saldo.toLocaleString('en')}`;
      //     console.log(result);
      //     appendgetsaldoMITRACOMM2();
      //     mitracomm2.innerHTML += result
      //   }
      // }
    }
  };
  var data = JSON.stringify({});
  xhr.send();
}

function appendgetsaldoCPN() {
  var cpn = document.getElementById('rpCPN');
  var Parent = document.getElementById('rpCPN');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function appendgetsaldoDANUCELL() {
  var danucell = document.getElementById('rpDanucell');
  var Parent = document.getElementById('rpDanucell');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function appendgetsaldoDJI() {
  var dji = document.getElementById('rpDJI');
  var Parent = document.getElementById('rpDJI');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function appendgetsaldoMITRACOMM2() {
  var mitracomm2 = document.getElementById('rpMITRACOMM2');
  var Parent = document.getElementById('rpMITRACOMM2');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function appendgetsaldoPRATAMA() {
  var pratama = document.getElementById('rpPRATAMA');
  var Parent = document.getElementById('rpPRATAMA');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function appendgetsaldoBIMASAKTI() {
  var bimasakti = document.getElementById('rpBIMASAKTI');
  var Parent = document.getElementById('rpBIMASAKTI');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function appendgetsaldoBAKOEL() {
  var bakoel = document.getElementById('rpBAKOEL');
  var Parent = document.getElementById('rpBAKOEL');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function appendgetsaldoDUMMY() {
  var bakoel = document.getElementById('rpDUMMY');
  var Parent = document.getElementById('rpDUMMY');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function refreshSaldo() {
  var myVar;
  myVar = setInterval(getSaldoBiller, 10000);
}

function getPending() {
  var divpending = document.getElementById('divMonitoringPending');
  var tanggal = document.getElementById('tanggal');
  var totalpending = document.getElementById('totalpending');
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/getpending";
  var div;
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");

appenddivMonitoringPending();
appendTanggalPending();
appendTotalPending();

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var dataPending = JSON.parse(this.responseText);
      var x = 0 ;
      for (var i = 0; i < dataPending.length; i++) {
        var total;
        var bar = dataPending[i].LEMBAR/total*100
        var colors;
        console.log(dataPending[i].PRODUK+"----"+bar);

        if (bar < 50) {
          colors = 'progress-bar bg-warning'
        } else {
            colors = 'progress-bar bg-danger'
        }
         div = `<div class="progress-group">
                                    ${x++}. Produk ${dataPending[i].PRODUK} - Switching ${dataPending[i].SWITCHING}
                                    <span class="float-right"><b>${dataPending[i].LEMBAR}</b>/${total}</span>
                                    <div class="progress progress-sm">
                                      <div class="${colors}" style="width:${bar}%"></div>
                                    </div>
                                  </div>`

        if (dataPending[i].PRODUK != "TOTAL"){
          divpending.innerHTML += div
        }else{
          total = dataPending[i].LEMBAR;
          tanggal.innerHTML += `<h3><center>Transaksi Pending Hari Ini Tanggal <br>` + dataPending[i].SWITCHING +`</center></h3> `
          totalpending.innerHTML += " *Total Pending Hari ini sebanyak <b>"+ total + "</b> Transaksi";
        }


      }
    }
  };
  xhr.send("");
}

function getHardisk() {
  var divpending = document.getElementById('divMonitoringPending');
  var tanggal = document.getElementById('tanggal');
  var totalpending = document.getElementById('totalpending');
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/getpending";
  var div;
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/plain");

appenddivMonitoringPending();
appendTanggalPending();
appendTotalPending();

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var dataPending = JSON.parse(this.responseText);
      var x = 0 ;
      for (var i = 0; i < dataPending.length; i++) {
        var total;
        var bar = dataPending[i].LEMBAR/total*100
        var colors;
        console.log(dataPending[i].PRODUK+"----"+bar);

        if (bar < 50) {
          colors = 'progress-bar bg-warning'
        } else {
            colors = 'progress-bar bg-danger'
        }
         div = `<div class="progress-group">
                                    ${x++}. Produk ${dataPending[i].PRODUK} - Switching ${dataPending[i].SWITCHING}
                                    <span class="float-right"><b>${dataPending[i].LEMBAR}</b>/${total}</span>
                                    <div class="progress progress-sm">
                                      <div class="${colors}" style="width:${bar}%"></div>
                                    </div>
                                  </div>`

        if (dataPending[i].PRODUK != "TOTAL"){
          divpending.innerHTML += div
        }else{
          total = dataPending[i].LEMBAR;
          tanggal.innerHTML += `<h3><center>Transaksi Pending Hari Ini Tanggal <br>` + dataPending[i].SWITCHING +`</center></h3> `
          totalpending.innerHTML += " *Total Pending Hari ini sebanyak <b>"+ total + "</b> Transaksi";
        }


      }
    }
  };
  xhr.send("");
}



function refreshPending() {
  var myVar;
  myVar = setInterval(getPending, 60000);
}

function appenddivMonitoringPending() {
  var Parent = document.getElementById('divMonitoringPending');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function appendTanggalPending() {
  var Parent = document.getElementById('tanggal');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}
function appendTotalPending() {
  var Parent = document.getElementById('totalpending');
  while (Parent.hasChildNodes()) {
    Parent.removeChild(Parent.firstChild);
  }
}

function tambahComplain() {
  let tgl_laporan = document.getElementById('tanggalLap')
  let jam_laporan = document.getElementById('jamLap');
  let kode_mitra = document.getElementById('selectDb');
  let keluhan = document.querySelector('#txt_keluhan');
  let status = document.getElementById('cmb_status')
  let xhr = new XMLHttpRequest();
  let url = "http://" + server + "/complain";

  // let userid = localStorage.getItem("userstr2");

  // alert(userid.value);
  xhr.open("POST", url, true);

  xhr.setRequestHeader("Content-Type", "text/plain");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // 
      alert('BERHASIL');
      console.log('BERHASIL');
    };


  //Converting JSON data to string
  var data = JSON.stringify({
    "action": "insert",
    "tgl_laporan": tgl_laporan.value,
    "jam_laporan": jam_laporan.value,
    "kode_mitra": kode_mitra.value,
    "keluhan": keluhan.value,
    "status": status.value,
    "userid": localStorage.getItem("userstr2")
    
  });
  // Sending data with the request
  xhr.send(data);
}
}

function listComplain(){
  //khusus untuk POST pake PHP
var xhr = new XMLHttpRequest();
xhr.open("POST", "http://127.0.0.1/itoptool/tambahComplain.php", true);
xhr.send();
}

function khususGET(){
  var xhr = new XMLHttpRequest();
// we defined the xhr

xhr.onreadystatechange = function () {
    if (this.readyState != 4) return;

    if (this.status == 200) {
        var data = JSON.parse(this.responseText);

        // we get the returned data
    }

    // end of state change: it can be after some time (async)
};

xhr.open('GET', yourUrl, true);
xhr.send();
}

function viewComplain(){
  var xhr = new XMLHttpRequest();
xhr.open("POST", url, true);
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.send(JSON.stringify({
    value: value
}));
}
