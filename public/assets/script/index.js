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

// Remove error message.
const msgs = document.querySelectorAll('.msg-dng');
msgs.forEach((msg, index) => {
    setTimeout(() => {
        msg.style.display = 'none';
    }, (index + 1) * 3000);
});

// Remove header message.
const headerMsgs = document.querySelectorAll('.h-span-msg');
headerMsgs.forEach((headerMsg, index) => {
    console.log(headerMsg);
    setTimeout(() => {
        headerMsg.style.display = 'none';
    }, (index + 1) * 10000);
});