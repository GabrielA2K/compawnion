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




const deleteModal = document.querySelectorAll(".deletepost-modal")
const deleteBtn = document.querySelectorAll(".button.report-btn.del")
const deleteBtnImg = document.querySelectorAll(".button.image-report-btn.del")
const cancelDeleteBtn = document.querySelectorAll(".deletepost-modal-close-btn.negative.button")

for(let i = 0; i<deleteModal.length; i++){
    console.log(deleteBtnImg[i])

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



const changePfpBtn = document.querySelector("#btn-change-picture.btn-change")
const changeNameBtn = document.querySelector("#btn-change-name")
const changePassBtn = document.querySelector("#btn-change-pass")
const setpfpModal = document.querySelector(".setpfp-modal")
const closePfpModal = document.querySelector(".close-btn-setpfp")
const uploadImage = document.querySelector(".change-image-btn.button.txt-btn")
const addPostFileInput = document.querySelector("#post-image-file")


changePfpBtn.addEventListener('click', ()=>{
    setpfpModal.classList.add("active")
})

closePfpModal.addEventListener('click', ()=>{
    setpfpModal.classList.remove("active")
})
uploadImage.addEventListener('click', ()=>{
    addPostFileInput.click()
})

addPostFileInput.addEventListener('change', function() {
    const image = this.files[0]
    console.log(image)
    const reader = new FileReader();
    reader.onload = ()=> {
        const imgUrl = reader.result;
        document.querySelector(".addpost-image").src = imgUrl;
        document.querySelector(".addpost-image").classList.add("active")
        document.querySelector(".change-image-btn-text.txt-btn-text").textContent = "Change Image"
    }
    reader.readAsDataURL(image);
})