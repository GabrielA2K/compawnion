<style>
@font-face {
    font-family: ProductSans;
    src:  url(fonts/ProductSans.ttf);
}
@font-face {
    font-family: ProductSansBlack;
    src:  url(fonts/ProductSansBlack.ttf);
}

* {
    -webkit-tap-highlight-color: transparent;
    margin: 0;
    padding: 0;
    user-select: none;
}
html {
    margin-left: calc(100vw - 100%);
}

:root {
    --accent-color-temp: #7f7bed;
    --sections-color-temp: rgb(92, 84, 112);
}

.modern-text-input:focus {
    outline-width: 0;
}
.modern-textbox {
    height: 3rem;
    width: calc(100% - 10px);
    border-radius: 10px;
    /* background-color: rgba(0,0,0,0.1); */
    margin-bottom: 0.8rem;
    flex-direction: column;
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
    padding: 0.2rem 0 0 0.5rem;
    border: 1px solid rgb(231, 221, 244);
    box-shadow: 0 0 1px -1px var(--accent-color-temp);
    transition: 300ms;
}
.modern-textbox.textarea {
    height: 5rem;
    width: calc(100% - 10px);
    border-radius: 10px;
    /* background-color: rgba(0,0,0,0.1); */
    margin-bottom: 0.8rem;
    flex-direction: column;
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
    padding: 0.2rem 0 0 0.5rem;
    border: 1px solid rgb(231, 221, 244);
    box-shadow: 0 0 1px -1px var(--accent-color-temp);
    transition: 300ms;
}

.modern-textbox.password {
    margin-bottom: 0.3rem;
    flex-direction: row;
    justify-content: flex-start;
    /* background-color: rgba(0,0,0,0.1); */
    
    /* padding: 0.2rem 0 0 0; */
}

.placeholder {
    background-color: transparent;
    /* width: 50%; */
    z-index: 0;
    font-family: "ProductSans";
    color: rgb(181, 169, 199);
    font-size: 0.8rem;
    transform: scale(130%) translate(4px, 11px);
    transform-origin: left;
    order: -1;
    transition: 200ms;
}

.modern-text-input {
    background-color: rgba(0,0,0,0.0);
    width: calc(100% - 0.4rem);
    font-family: "ProductSans", "Arial";
    color: var(--sections-color-temp);
    font-size: 1rem;
    margin-left: 0.3rem;
    height: calc(100% - 0.9rem);
    margin-top: 0.3rem;
    margin-bottom: 0.2rem;
    border: none;
    z-index: 1;
}
.modern-text-input.textarea {
    resize: none;
    background-color: rgba(0,0,0,0.0);
    width: calc(100% - 0.4rem);
    font-family: "ProductSans", "Arial";
    color: var(--sections-color-temp);
    font-size: 1rem;
    margin-left: 0.3rem;
    height: calc(100% - 0.9rem);
    margin-top: 0.3rem;
    margin-bottom: 0.2rem;
    border: none;
    z-index: 1;
}

.modern-textbox:has(.modern-text-input:focus) {
    border: 1px solid var(--accent-color-temp);
    box-shadow: 0 0 3px 0 var(--accent-color-temp);
    transition: 300ms;
}



.modern-text-input:focus + p,
.modern-text-input:not(:placeholder-shown) + p {
    transform: scale(100%) translate(4px, 4px);
    transition: 300ms;
}
.modern-text-input:focus + p {
    color: var(--accent-color-temp);
}

.password-input-container {
    /* background-color: rgba(0,0,0,0.1); */
    height: 100%;
    width: calc(100% - 1.5rem);

    flex-direction: column;
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
}
.password-toggle-icon {
    height: 1.4rem;
    width: 1.4rem;
    align-self: flex-end;
    margin-bottom: 0.4rem;
    margin-right: 0.7rem;
    cursor: pointer;
}




p.textcount {
    font-family: "ProductSans";
    font-size: 0.7rem;
    margin-left: calc(100% - 4.8rem);
    text-align: right;
    margin-top: -0.7rem;
    color: var(--desaturated-accent-color);
    width: 4rem;
    /* background: green; */
}

.modern-textbox.no-content {
    border: 1px solid rgb(238, 59, 104);
    /* box-shadow: 0 0 3px 0 rgb(238, 59, 104); */
    transition: 300ms;
}
.modern-textbox.no-content:has(.modern-text-input:focus) {
    border: 1px solid rgb(238, 59, 104);
    box-shadow: 0 0 3px 0 rgb(238, 59, 104);
    transition: 300ms;
}
.modern-textbox.no-content > p {
    color: rgb(238, 59, 104);
}
.modern-textbox.no-content > div > p {
    color: rgb(238, 59, 104);
}

</style>

<?php

function custom_input($type, $class, $name, $placeholder, $required, $max){
    if($type == "text" || $type == "email" || $type == "number"){?>
    <div class="modern-textbox <?php echo $class; ?>">
        <input class="modern-text-input <?php echo $class; ?>" 
                type="<?php echo $type; ?>" 
                name="<?php echo $name; ?>" 
                id="<?php echo $name; ?>" 
                <?php if($required){echo 'required';} ?>
                maxlength="<?php echo $max ?>"
                placeholder=" ">
        <p class="placeholder <?php echo $name ?>"><?php echo $placeholder; ?></p>
    </div>

    <?php } 
    
    elseif($type == "password"){?>
    
    <div class="modern-textbox password <?php echo $class; ?>">
        <div class="password-input-container">
            <input class="modern-text-input <?php echo $class; ?>"
                    type="password"
                    name="<?php echo $name; ?>" 
                    id="<?php echo $name; ?>" 
                    <?php if($required){echo 'required';} ?>
                    placeholder=" ">
            <p class="placeholder <?php echo $name ?>"><?php echo $placeholder; ?></p>
        </div>
        <img class="password-toggle-icon" src="images/icons-mono/show-pw.png" alt="">
    </div>

<?php } ?>
<?php } 

function custom_textarea($class, $name, $height, $row, $col, $max, $placeholder, $required){
    ?>
    <div class="modern-textbox textarea <?php echo $class; ?>"
         style="height: <?php echo $height ?>;">
         <p class="textcount">0 / <?php echo $max; ?></p>
        <textarea class="modern-text-input textarea <?php echo $class; ?>" 
                name="<?php echo $name; ?>" 
                id="<?php echo $name; ?>" 
                rows="<?php echo $row ?>"
                cols="<?php echo $col ?>"
                maxlength="<?php echo $max ?>"
                <?php if($required){echo 'required';} ?>
                placeholder=" "></textarea>
        <p class="placeholder <?php echo $name ?>"><?php echo $placeholder; ?></p>
    </div>
<?php } 


    function custom_input_script(){?>
        <script>
        const modernTextBoxDiv = document.querySelectorAll(".modern-textbox")
        const modernTextBoxInput = document.querySelectorAll(".modern-text-input")

        for(let i=0; i<modernTextBoxDiv.length; i++){
            modernTextBoxDiv[i].addEventListener('click', ()=> {
            modernTextBoxInput[i].focus()
        })
    }


        const passwordToggleIcon = document.querySelectorAll(".password-input-container + .password-toggle-icon")
        const passwordInput = document.querySelectorAll(".password-input-container > .modern-text-input")

        for(let i=0; i<passwordToggleIcon.length; i++){
            passwordToggleIcon[i].addEventListener('click', e => {
            // e.stopPropagation()
            if(passwordInput[i].type === "password"){
                passwordInput[i].type = "text"
                passwordToggleIcon[i].src = "images/icons-mono/hide-pw.png"
            } else {
                passwordInput[i].type = "password"
                passwordToggleIcon[i].src = "images/icons-mono/show-pw.png"
            }
            })
        }

        

        const textAreaDiv = document.querySelectorAll(".modern-textbox.textarea")
const textAreaInput = document.querySelectorAll(".modern-text-input.textarea")
const textAreaInputCount = document.querySelectorAll(".textcount")


for(let i=0; i<textAreaInput.length; i++){
    let textlim = textAreaInputCount[i].textContent.split(" ")
    // console.log(textlim[textlim.length - 1])
    textAreaInput[i].addEventListener('input', ()=>{
        textAreaInputCount[i].textContent = textAreaInput[i].value.length + " / " + textlim[textlim.length - 1]
    })
}


        
    </script>
    <?php }?>
