//show password
const pwShowHide = document.querySelectorAll(".showHidePw");
const pwFields = document.querySelectorAll(
  ".container-login__box__group-input-passwrod"
);
// show password
pwShowHide.forEach((eyeIcon) => {
  eyeIcon.addEventListener("click", () => {
    pwFields.forEach((pwField) => {
      if (pwField.type === "password") {
        pwField.type = "text";
        pwShowHide.forEach((icon) => {
          icon.classList.replace("fa-eye-slash", "fa-eye");
        });
      } else {
        pwField.type = "password";
        pwShowHide.forEach((icon) => {
          icon.classList.replace("fa-eye", "fa-eye-slash");
        });
      }
    });
  });
});

//them thanh vien cho ve
const btn_themtv = document.querySelector("#btn_themthanhvien");
const input_ten = document.querySelector("#ten_ve");
const input_sdt = document.querySelector("#sdt_ve");
const input_cccd = document.querySelector("#cccd_ve");
const input_namsinh = document.querySelector("#namsinh_ve");
const form_ve = document.querySelector("#form-ve");
const backgroud_ve = document.querySelector("#backgroud-ve");

btn_themtv.onclick = function () {
  form_ve.style.display = "block";
  backgroud_ve.classList.add("l-8");
  backgroud_ve.classList.remove("l-12");
  input_ten.value = "";
  input_sdt.value = "";
  input_cccd.value = "";
  input_namsinh.value = "";
};

//slider



//check value input
var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;

const btn_submit = document.querySelector("#btnsubmit");

const error_sdt = document.querySelector("#error-sdt");

const error_cccd = document.querySelector("#error-cccd");

input_sdt.addEventListener("change", function () {
  var sdt_value = input_sdt.value;
  if (sdt_value.match(phoneno) && sdt_value.length >= 10) {
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
  if (cccd_value.length >= 9 && cccd_value.length <= 12) {
    input_cccd.style.borderColor = "var(--color-gray)";
    error_cccd.classList.add("none");
    btn_submit.classList.remove("disabled-btn");
  } else {
    input_cccd.style.borderColor = "var(--color-error)";
    error_cccd.classList.remove("none");
    btn_submit.classList.add("disabled-btn");
  }
});

// hiển thị ảnh child trong product detail
function changeImage(id) {
  let imgPath = document.getElementById(id).getAttribute("src");
  document.getElementById("img-main").setAttribute("src", imgPath);
}

function isNumberKey(e) {
  var charCode = (e.which) ? e.which : e.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}
