const users = document.querySelectorAll(".username-list")
const txt = document.querySelector("#username")
const signupUserInputDiv = document.querySelector(".modern-textbox.username")
const signupUserPlaceholder = document.querySelector(".placeholder.username")



let usernamelist = []

        for(let i=0; i<users.length; i++){
            usernamelist.push(users[i].textContent)
        }
        // console.log(usernamelist)



        txt.addEventListener("input", () => {
            // console.log("clicked")
            console.log(txt.value)
            
                // console.log(document.querySelectorAll(".usernames")[i].textContent)
                if(usernamelist.includes(txt.value)){
                    signupUserInputDiv.classList.add("no-content")
                    signupUserPlaceholder.textContent = "Username already exists"
                }
                else{
                    if(signupUserInputDiv.classList.contains("no-content")){
                        signupUserInputDiv.classList.remove("no-content")
                        signupUserPlaceholder.textContent = "Username"
                    }
                }
            
        })

        document.querySelector("#updatebtn").addEventListener('click', ()=>{
            if(document.querySelector("#adminpassword").value == document.querySelector(".adminpassvalue").textContent && !usernamelist.includes(txt.value)){
                document.querySelector("#updatebtn-ac").click()
            }
            else{
                showToast("Check All Information!", 2)
            }
        })