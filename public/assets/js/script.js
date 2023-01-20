
let eye       = document.querySelectorAll(".eye");
let inputPwd  = document.querySelector("#input-pwd");
let inputPwd1  = document.querySelector("#input-pwd1");
let inputs    = document.querySelectorAll(".form-control")
let switchLog = document.querySelectorAll(".click-ici")
let container = document.querySelector(".container");

let fName      = document.querySelector("#input-fname")
let lName      = document.querySelector("#input-lname")
let emailSign  = document.querySelector("#input-email")
let pwdSign    = document.querySelector("#input-pwd")
let emailSign1 = document.querySelector("#input-email1")
let pwdSign1   = document.querySelector("#input-pwd1")

let errorfname = document.querySelector("#fname-error")
let errorlname = document.querySelector("#lname-error")
let erroremail = document.querySelector("#email-error")
let errorpwd   = document.querySelector("#pwd-error")
let erroremail1= document.querySelector("#email1-error")
let errorpwd1  = document.querySelector("#pwd1-error")
let verified   = false;


// afficher/cacher le mot de passe
eye.forEach(eye => {
    eye.addEventListener("click",()=>{
        if(eye.classList.contains("eye-on")){
            document.querySelectorAll(".eye-on").forEach(eyon => {
                eyon.classList.add("hide");
                document.querySelectorAll(".eye-off").forEach(eyoff => {
                    eyoff.classList.remove("hide")
                })
            });
            inputPwd.setAttribute("type","text");
            inputPwd1.setAttribute("type","text");
        }
        else{
            document.querySelectorAll(".eye-on").forEach(eyon => {
                eyon.classList.remove("hide");
                document.querySelectorAll(".eye-off").forEach(eyoff => {
                    eyoff.classList.add("hide")
                })
            });
            inputPwd.setAttribute("type","password");
            inputPwd1.setAttribute("type","password");
        }
    })
});

// chnger le form Login/Sign up
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

// form validation

// Form Blur Event Listeners
fName.addEventListener('blur', validateName);
lName.addEventListener('blur', validatelName);
emailSign.addEventListener('blur', validateEmail);
pwdSign.addEventListener('blur', validatepassword);
emailSign1.addEventListener('blur', validateEmail1);
pwdSign1.addEventListener('blur', validatepassword1);

// sigup form
function validateName() {
    const re = /^[a-zA-Z]{2,12}$/;
    if(!re.test(fName.value)) {
        errorfname.classList.remove("hiden")
        verified=false;
    } else {
        errorfname.classList.add("hiden")
        verified=true;
    }
}
function validatelName(){
    const re = /^[a-zA-Z]{2,12}$/;
    if(!re.test(lName.value)) {
        errorlname.classList.remove("hiden")
        verified=false;
    } else {
        errorlname.classList.add("hiden")
        verified=true;
    }
}
function validateEmail() {
    const re = /^([a-zA-Z0-9_\.\-]+)@([a-zA-Z0-9_\.\-]+)\.([a-zA-Z]{2,5})$/;

    if(!re.test(emailSign.value)) {
        erroremail.classList.remove('hiden');
        verified=false;
    } else {
        erroremail.classList.add('hiden');
        verified=true;
    }
}
function validatepassword() {
    // au moins une lettre minuscule, une lettre Majuscule, un nombre, une charactere speciale, longueur de mdp est 8 char
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if(!re.test(pwdSign.value)) {
        errorpwd.classList.remove('hiden');
        verified=false;
    } else {
        errorpwd.classList.add('hiden');
        verified=true;
    }
}
// login form
function validateEmail1() {
    const re = /^([a-zA-Z0-9_\.\-]+)@([a-zA-Z0-9_\.\-]+)\.([a-zA-Z]{2,5})$/;

    if(!re.test(emailSign1.value)) {
        erroremail1.classList.remove('hiden');
        verified=false;
    } else {
        erroremail1.classList.add('hiden');
        verified=true;
    }
}
function validatepassword1() {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if(!re.test(pwdSign1.value)) {
        errorpwd1.classList.remove('hiden');
        verified=false;
    } else {
        errorpwd1.classList.add('hiden');
        verified=true;
    }
}

document.querySelector("#sinscrire").addEventListener("click", (e) =>{
    if(!verified)
        e.preventDefault();
})
