
let eye      = document.querySelectorAll(".eye");
let inputPwd = document.querySelector("#input-pwd");

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