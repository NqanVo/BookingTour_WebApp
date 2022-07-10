//show password
const pwShowHide = document.querySelectorAll(".showHidePw");
const pwFields = document.querySelectorAll(".container-login__box__group-input-passwrod");
// show password
pwShowHide.forEach(eyeIcon =>{
    eyeIcon.addEventListener("click", ()=>{
        pwFields.forEach(pwField =>{
            if(pwField.type ==="password"){
                pwField.type = "text";
                pwShowHide.forEach(icon =>{
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                })
            }else{
                pwField.type = "password";
                pwShowHide.forEach(icon =>{
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                })
            }
        }) 
    })
})


//them thanh vien cho ve
const btn_themtv = document.querySelector("#btn_themthanhvien");
const input_ten = document.querySelector("#ten_ve");
const input_sdt = document.querySelector("#sdt_ve");
const input_cccd = document.querySelector("#cccd_ve");
const input_namsinh = document.querySelector("#namsinh_ve");
const form_ve = document.querySelector("#form-ve");
const backgroud_ve = document.querySelector("#backgroud-ve");

btn_themtv.onclick = function(){
    form_ve.style.display = "block";
    backgroud_ve.classList.add("l-8");
    backgroud_ve.classList.remove("l-12");
    input_ten.value = "";
    input_sdt.value = "";
    input_cccd.value = "";
    input_namsinh.value = "";
}


//slider
window.addEventListener("load", function(){
    const slider = this.document.querySelector(".slider");
    const slider_main = this.document.querySelector(".slider-main");
    const slider_items = this.document.querySelectorAll(".slider-item");
    const btn_next = this.document.querySelector(".btn-next");
    const btn_pre = this.document.querySelector(".btn-pre");
});
