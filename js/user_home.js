const adoptModalBtn = document.querySelectorAll(".adopt-btn")
const adoptModalBtnImg = document.querySelectorAll(".image-adopt-btn")
const closeModalBtn = document.querySelectorAll(".modal-close-btn")
const modal = document.querySelectorAll(".adopt-modal")
const modalCard = document.querySelectorAll(".modal-card")
const modalImage = document.querySelectorAll('.modal-image-holder')

for(let i=0; i<adoptModalBtn.length; i++){
    adoptModalBtn[i].addEventListener('click', () => {
        // console.log(openModalBtn[i].closest('.post'))
        // console.log(modal[i])
        modal[i].classList.add('active')
    })
    adoptModalBtnImg[i].addEventListener('click', () => {
        modal[i].classList.add('active')
    })

    closeModalBtn[i].addEventListener('click', () => {
        modal[i].classList.remove('active')
    })

    modalCard[i].addEventListener('click', e => {
        e.stopPropagation();
    })
}


// for(let j=0; j<closeModalBtn.length; j++){
//     closeModalBtn[j].addEventListener('click', () => {
//         modal[j].classList.remove('active')
//     })
// }

for(let j=0; j<modal.length; j++){
    modal[j].addEventListener('click', () => {
        modal[j].classList.remove('active')
    })
}






const addPostBtn = document.querySelector(".add-post-btn")
const addPostModal = document.querySelector(".addpost-modal")
const closeAddPostModal = document.querySelector(".close-addpostmodal-btn")

// console.log(addPostModal)

addPostBtn.addEventListener('click', ()=>{
    addPostModal.classList.add("active")
})



document.querySelector('.addpost-image').addEventListener('click', e=> {
    e.stopPropagation()
})

const addPostImage = document.querySelector('.change-image-btn')
const addPostImageText = document.querySelector('.change-image-btn-text')
const addPostFileInput = document.querySelector('#post-image-file')
const addPostImageImg = document.querySelector('.addpost-image')

addPostImage.addEventListener('click', function() {
    addPostFileInput.click();
})

addPostFileInput.addEventListener('change', function() {
    const image = this.files[0]
    console.log(image)
    const reader = new FileReader();
    reader.onload = ()=> {
        const imgUrl = reader.result;
        addPostImageImg.src = imgUrl;
        addPostImageImg.classList.add("active")
        addPostImageText.textContent = "Change Image"
    }
    reader.readAsDataURL(image);
})




closeAddPostModal.addEventListener('click', ()=> {
    if(addPostModal.classList.contains("active")){
        addPostModal.classList.remove("active")
        addPostImageImg.classList.remove("active")
        addPostImageText.textContent = "Upload Image"
        addPostFileInput.value = null
        document.querySelector(".modern-text-input.pet-name").value = ""
        document.querySelector(".modern-text-input.pet-class").value = ""
        document.querySelector(".modern-text-input.pet-breed").value = ""
        document.querySelector(".modern-text-input.pet-sex").value = ""
        document.querySelector(".modern-text-input.pet-age").value = ""
        document.querySelector(".modern-text-input.other-desc").value = ""
        document.querySelector(".modern-text-input.reason").value = ""
        for(let i=0; i<textAreaInput.length; i++){
            let textlim = textAreaInputCount[i].textContent.split(" ")
            // console.log(textlim[textlim.length - 1])
            textAreaInputCount[i].textContent = "0 / " + textlim[textlim.length - 1]
        }

    }
})


const deleteModal = document.querySelectorAll(".deletepost-modal")
const deleteBtn = document.querySelectorAll(".button.report-btn.del")
const deleteBtnImg = document.querySelectorAll(".button.image-report-btn.del")
const cancelDeleteBtn = document.querySelectorAll(".deletepost-modal-close-btn.negative.button")

for(let i = 0; i<deleteModal.length; i++){
    console.log(deleteBtn[i])
    deleteBtn[i].addEventListener('click', ()=>{
        deleteModal[i].classList.add("active")
    })

    deleteBtnImg[i].addEventListener('click', ()=>{
        deleteModal[i].classList.add("active")
    })

    cancelDeleteBtn[i].addEventListener('click', ()=>{
        if(deleteModal[i].classList.contains("active")){
            deleteModal[i].classList.remove("active")
        }
    })
}




const copyContactBtn = document.querySelectorAll(".contact.copy-btn")
const copyEmailBtn = document.querySelectorAll(".email.copy-btn")

const contactInfo = document.querySelectorAll(".ro-input.owner-contact")
const emailInfo = document.querySelectorAll(".ro-input.owner-email")

for(let i = 0; i<copyContactBtn.length; i++){
    copyContactBtn[i].addEventListener('click', ()=>{
        contactInfo[i].select();
        contactInfo[i].setSelectionRange(0, 99999);
        document.execCommand("copy");
        contactInfo[i].setSelectionRange(0, 0);
        navigator.clipboard.writeText(contactInfo[i].value)
    })

    copyEmailBtn[i].addEventListener('click', ()=>{
        emailInfo[i].select();
        emailInfo[i].setSelectionRange(0, 99999);
        document.execCommand("copy");
        emailInfo[i].setSelectionRange(0, 0);
        navigator.clipboard.writeText(emailInfo[i].value)
    })
}



const adminPass = document.querySelector(".admin-pass-text").textContent
const accountType = document.querySelector(".account-type-text").textContent
const deletePassword = document.querySelectorAll(".modern-text-input.admin-pass")
const deletePasswordDiv = document.querySelectorAll(".modern-textbox.admin-pass")
const proceedDeleteBtn = document.querySelectorAll("a.deletepost-modal-close-btn.positive.button")
const negativeDeleteBtn = document.querySelectorAll(".deletepost-modal-close-btn.negative.button")


if(accountType == "admin"){
    for(let i=0; i<proceedDeleteBtn.length; i++){
        proceedDeleteBtn[i].style.pointerEvents = "none"
        deletePassword[i].addEventListener('input', ()=>{
            if(deletePassword[i].value == adminPass){
                proceedDeleteBtn[i].style.pointerEvents = "all"
                if(deletePasswordDiv[i].classList.contains("no-content")){
                    deletePasswordDiv[i].classList.remove("no-content")
                }
            }
            else {
                proceedDeleteBtn[i].style.pointerEvents = "none"
                deletePasswordDiv[i].classList.add("no-content")
            }
        })

        negativeDeleteBtn[i].addEventListener('click', ()=>{
            deletePassword[i].value = ""
            proceedDeleteBtn[i].style.pointerEvents = "none"
            deletePasswordDiv[i].classList.remove("no-content")
            
        })
    }
}




const reportBtn = document.querySelectorAll(".button.report-btn.rep")
const reportImageBtn = document.querySelectorAll(".button.image-report-btn.rep")
const reportModal = document.querySelectorAll(".reportpost-modal")
const reportCancelBtn = document.querySelectorAll(".reportpost-modal-close-btn.negative.button")



for(let i = 0; i<reportModal.length; i++){
    
    reportBtn[i].addEventListener('click', ()=>{
        reportModal[i].classList.add("active")
    })
    reportImageBtn[i].addEventListener('click', ()=>{
        reportModal[i].classList.add("active")
    })
    reportCancelBtn[i].addEventListener('click', ()=>{
        if(reportModal[i].classList.contains("active")){
            reportModal[i].classList.remove("active")
        }
    })
}



const viewImageModal = document.querySelectorAll(".view-image-modal")
const viewImage = document.querySelectorAll("view-image")
const imageClick = document.querySelectorAll("img.post__image")

for(let i=0; i<imageClick.length; i++){
    imageClick[i].addEventListener('click', ()=>{
        viewImageModal[i].classList.add("active")
    })
    viewImageModal[i].addEventListener('click', ()=>{
        viewImageModal[i].classList.remove("active")
    })

}