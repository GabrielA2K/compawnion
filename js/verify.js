const verCodeMul = document.querySelector("#verification-code-mul")
const verCode = parseInt(verCodeMul.textContent) / 3
const verifyBtn = document.querySelector("#verify-code")
const verifyBtnActual = document.querySelector("#verify-code-actual")
const codeInput = document.querySelector("#verification-code.modern-text-input")
const codeStr = verCode.toString()

console.log(verifyBtnActual)
verifyBtn.addEventListener('click', ()=>{
    if(codeStr == codeInput.value){
        verifyBtnActual.click()
    } else {
        showToast("Incorrect Code!", 2)
    }
})