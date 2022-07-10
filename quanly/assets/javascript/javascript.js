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
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })