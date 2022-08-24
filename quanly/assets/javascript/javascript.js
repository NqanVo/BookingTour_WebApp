// // main
// const modals = document.querySelectorAll(".modal");

// // Phong Ban
// const open_confirm_phongbans = document.querySelectorAll(".js-comfirm-phongban");
// const form_comfirm_phongbans = document.querySelectorAll(".js-modal__form-phongban");

// for(var i =0;i<open_confirm_phongbans.length;i++){
//     var open_confirm_phongban = open_confirm_phongbans[i];
//     for(var j=0;j<modals.length;j++){
//         var modal = modals[j];
//         for(var z = 0;z <form_comfirm_phongbans.length;z++){
//             var form_comfirm_phongban = form_comfirm_phongbans[z];

//             open_confirm_phongban.onclick = function(){
//                 modal.style.display = "block";
//                 form_comfirm_phongban.style.display = "block";
//             }
//         }
//     }
// }

const container = document.querySelector(".container"),
  pwShowHide = document.querySelectorAll(".showHidePw"),
  pwFields = document.querySelectorAll(".password"),
  login = document.querySelector(".login-link");

//   show password
pwShowHide.forEach((eyeIcon) => {
  eyeIcon.addEventListener("click", () => {
    pwFields.forEach((pwField) => {
      if (pwField.type === "password") {
        pwField.type = "text";

        pwShowHide.forEach((icon) => {
          icon.classList.replace("uil-eye-slash", "uil-eye");
        });
      } else {
        pwField.type = "password";

        pwShowHide.forEach((icon) => {
          icon.classList.replace("uil-eye", "uil-eye-slash");
        });
      }
    });
  });
});

//check value input
var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;

const btn_submit = document.querySelector("#btnsubmit");

const input_sdt = document.querySelector("#sdt_nv");
const error_sdt = document.querySelector("#error-sdt");

const input_cccd = document.querySelector("#cccd_nv");
const error_cccd = document.querySelector("#error-cccd");

input_sdt.addEventListener("change", function () {
  var sdt_value = input_sdt.value;
  if ((sdt_value.match(phoneno)) && (sdt_value.length >= 10)) {
    input_sdt.style.borderColor = "var(--color-gray)";
    error_sdt.classList.add("none");
    btn_submit.classList.remove("disabled-btn");
  } else {
    input_sdt.style.borderColor = "var(--color-error)";
    error_sdt.classList.remove("none");
    btn_submit.classList.add("disabled-btn");
  }
});

input_cccd.addEventListener("change", function () {
    var cccd_value = input_cccd.value;
    if ((cccd_value.length >= 9) && (cccd_value.length <= 12)) {
      input_cccd.style.borderColor = "var(--color-gray)";
      error_cccd.classList.add("none");
      btn_submit.classList.remove("disabled-btn");
    } else {
      input_cccd.style.borderColor = "var(--color-error)";
      error_cccd.classList.remove("none");
      btn_submit.classList.add("disabled-btn");
    }
  });
  
