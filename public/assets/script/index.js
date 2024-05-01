// Onclick show user password...
const showPwds = document.querySelectorAll('.showPwdBtn');
showPwds.forEach(showPwd => {
    showPwd.addEventListener('click', ()=>{
        const input = showPwd.parentElement.querySelector('.form-input-pwd');
        if (input.type === "password") {
            input.type = "text";
            input.nextElementSibling.innerHTML = '<i class="bi bi-eye"></i>';
        } else {
            input.type = "password";
            input.nextElementSibling.innerHTML = '<i class="bi bi-eye-slash"></i>';
        }
    });
});

// Onkeyup check if password macth...
const pwdCnfr = document.querySelector('.pwd_cnfr');
if (pwdCnfr === null) {
}else {
    pwdCnfr.addEventListener('keyup', ()=>{
        const pwd = document.querySelector('.pwd');
        if (pwd.value === pwdCnfr.value) {
            document.querySelector('.form-submit-btn').removeAttribute('disabled');
            document.querySelector('.form-submit-btn').style.cursor = 'pointer';
            //alert_user_pwd_match();
        } else {
            //document.querySelector('.form-submit-btn').setAttribute('disabled','disabled');
            //document.querySelector('.form-submit-btn').style.cursor = 'not-allowed';
            //alert_user_pwd_no_match();
        }
    });
}

function alert_user_pwd_no_match() {
    const pwdInputs = document.querySelectorAll('.form-input-pwd');
    pwdInputs.forEach(pwdInput => {
        pwdInput.classList.add('pwd_no_match-js');
    });
}

function alert_user_pwd_match() {
    const pwdInputs = document.querySelectorAll('.form-input-pwd');
    pwdInputs.forEach(pwdInput => {
        pwdInput.classList.remove('pwd_no_match-js');
    });
}


// Remove error message.
const msgs = document.querySelectorAll('.msg-dng');
msgs.forEach((msg, index) => {
    setTimeout(() => {
        msg.style.display = 'none';
    }, (index + 1) * 3000); // Ajusta el tiempo de espera según sea necesario
});

// Remove header message.
const headerMsgs = document.querySelectorAll('.h-span-msg');
headerMsgs.forEach((headerMsg, index) => {
    console.log(headerMsg);
    setTimeout(() => {
        headerMsg.style.display = 'none';
    }, (index + 1) * 10000); // Ajusta el tiempo de espera según sea necesario
});