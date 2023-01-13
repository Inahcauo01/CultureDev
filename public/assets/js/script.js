
let eye       = document.querySelectorAll(".eye");
let inputPwd  = document.querySelector("#input-pwd");
let inputs    = document.querySelectorAll(".form-control")
let switchLog = document.querySelectorAll(".click-ici")
let container = document.querySelector(".container");

eye.forEach(eye => {
    eye.addEventListener("click",()=>{
        if(eye.classList.contains("eye-on")){
            document.querySelector(".eye-on").classList.add("hide")
            document.querySelector(".eye-off").classList.remove("hide")
            inputPwd.setAttribute("type","text");
        }
        else{
            document.querySelector(".eye-off").classList.add("hide")
            document.querySelector(".eye-on").classList.remove("hide")
            inputPwd.setAttribute("type","password");
        }
    })
});

switchLog.forEach(switchS => {
    switchS.addEventListener("click",()=>{
    if(switchS.classList.contains("btn-signin")){
        document.querySelector(".sign-up").classList.remove("hide")
        document.querySelector(".sign-in").classList.add("hide")
        document.querySelector(".image-signup").classList.add("hide")
        document.querySelector(".image-login").classList.remove("hide")

    }else{
        document.querySelector(".sign-in").classList.remove("hide")
        document.querySelector(".sign-up").classList.add("hide")
        document.querySelector(".image-signup").classList.remove("hide")
        document.querySelector(".image-login").classList.add("hide")
    }
})
});
