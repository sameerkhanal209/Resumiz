/*

Nav Menu 

*/

function $(query){
    return document.querySelector(query)
}

function $$(query){
    return document.querySelectorAll(query)
}

function OpenMenu(toggleClass, menuClass){
    $(toggleClass).addEventListener('click',(e)=>{
        
        let menu = $(menuClass)
        menu.style.setProperty('--openHeight', menu.scrollHeight + 'px');

        $(menuClass).classList.toggle('show')
   }) 
}

if($('.menu-btn')){
   OpenMenu('.menu-btn', '.menu-area')
}

if($('.header-menu-btn')){
    OpenMenu('.header-menu-btn', '.menu-list')
 }

/* 

Modal

*/

if($('.modal-btn')){

    function hideModal(id){

        let modal = $('#'+String(id))
        let modalInner = $('#'+String(id) + ' .modal-content')

        if(modalInner.classList.contains('slidein')){
            modalInner.classList.remove('slidein')
        }
        modalInner.classList.add('slideout')
        modal.style.opacity = '0'

        setTimeout(()=>{
            modal.style.display = "none";
            modal.style.opacity = 1;
            $('body').classList.remove('overlay')
        }, 300)

    }

    $$('.modal-btn').forEach(e=>{

        let id = e.dataset.modal

        let modal = $('#'+String(id))
        let modalInner = $('#'+String(id) + ' .modal-content')

        e.onclick = (e) => {

            $('body').classList.add('overlay')
    
            if(modalInner.classList.contains('slideout')){
                modalInner.classList.remove('slideout')
            }
            modalInner.classList.add('slidein')
            modal.style.display = "block";

            window.onclick = (ei) => {
                if (ei.target.classList.contains('modal')) {
                    hideModal(id)
                }
            }
        }
    
        $$('.modal-close').forEach(el => {
            el.addEventListener('click',()=>{
                hideModal(id)
            })
        });
    
    })
}

/*

Alert Close

*/

if($('.alert.alert-closeable')){
    $$('.alert.alert-closeable').forEach(e=>{
        e.querySelector('.btn-close').addEventListener('click',()=>{
            e.remove()
        })
    })
}

/*

Tabs

*/

if($('.tab')){

    $$('.tab').forEach(tab=>{

        tab.querySelectorAll('.tablinks').forEach(btn=>{

            btn.addEventListener('click', ()=>{
                
                $$('.'+tab.dataset.tab + '.tablinks').forEach(rbtn=>{
                    rbtn.classList.remove('active')
                    $('#'+String(rbtn.dataset.open)).classList.remove('display');
                })

                btn.classList.add('active')
                $('#'+String(btn.dataset.open)).classList.add('display');
            })

        })

    })

}

/*

Validations

*/

let errors = {
    "input-is-short": "::input:: must be greater than ::char:: characters.",
    "input-is-greater": "::input:: must be smaller than ::char:: characters.",
    "input-invalid": "Please enter a valid ::input::.",
    "password-special": "Your password should not contain any special characters.",
}

class InputCheck{

    input(input, text){
        return text.replace("::input::", input)
    }
    char(input, text){
        return text.replace("::char::", input)
    }

    CheckEmail(email){
        if(email.includes('@')){
            return [true, 'success']
        }

        let error = this.input('email address', errors['input-invalid'])
        return [false, error]
    }

    Check(input, text, min, max){

        if(input.length < 1){
            let error = this.input(text, errors['input-invalid'])
            //error = this.char(min, error)

            return [false, error]
        }

        if(input.length <= min){

            let error = this.input(text, errors['input-is-short'])
            error = this.char(min, error)

            return [false, error]
        }

        if(input.length >= max){
            let error = this.input(text, errors['input-is-greater'])
            error = this.char(max, error)

            return [false, error]
        }

        return [true, 'success']
    }
}

let validate = new InputCheck;

let validations = {
    "fname": "first name",
    "lname": "last name",
    "email": "email address",
    "password": "password",
    "confirm_password": "confirm password"
}

if($('.auto-validate')){
    let btn = $('.auto-validate button[type="submit"]')
    btn.type = "button";

    let inputs = document.querySelector('.auto-validate').querySelectorAll('input')
    let pass = [];

    btn.parentElement.insertAdjacentHTML('beforeend', "<span class='msg cool text-danger'></span>")
    btn.addEventListener('click', ()=>{
        if(btn.type == 'button'){
            btn.parentElement.querySelector('.msg').innerText = "All the fields are required."
        }
    })

    inputs.forEach((inp,i)=>{
        inp.parentElement.insertAdjacentHTML('beforeend', "<span class='msg cool text-danger'></span>")
        pass.push(0)

        inp.addEventListener('keyup',()=>{
            let name = validations[inp.name]

            let message = ""
            if(inp.name != password){
                message = validate.Check(inp.value, name, inp.min, inp.max)
            } else {
                message = validate.Check(inp.value, name, inp.min, inp.max)
            }

            if(!message[0]){
                inp.parentElement.querySelector('.msg').innerText = message[1]
                inp.classList.add('form-error')

                pass[i] = 0;

            } else {
                inp.parentElement.querySelector('.msg').innerText = ""
                if(inp.classList.contains('form-error')){
                    inp.classList.remove('form-error')
                }

                pass[i] = 1;

            }
            
            let total = 0;
            pass.forEach(e=>{
                total= total+e;
            })
            if(total == inputs.length){
                btn.type = "submit"
                if(btn.parentElement.querySelector('.msg')){
                    btn.parentElement.querySelector('.msg').innerText = ""
                }
            }

            


        })
    })

    

    
}

/* Form validate */
class FormValidate{

    pass = []

    input(input, text){
        return text.replace("::input::", input)
    }
    char(input, text){
        return text.replace("::char::", input)
    }

    CheckEmail(email){
        if(email.includes('@')){
            return [true, 'success']
        }

        let error = this.input('email address', errors['input-invalid'])
        return [false, error]
    }

    ConfirmPassword(){
        let password = $('#password')
        let confirm_password = $("#confirm_password")

        if(password.value === confirm_password.value){
            return [true, "Passwords match"]
        }

        return [false, "Password does not match"]
    }

    Check(input, text, min, max){

        if(input.length < 1){
            let error = this.input(text, errors['input-invalid'])
            error = this.char(min, error)

            return [false, error]
        }

        if(input.length <= min){

            let error = this.input(text, errors['input-is-short'])
            error = this.char(min, error)

            return [false, error]
        }

        if(input.length >= max){
            let error = this.input(text, errors['input-is-greater'])
            error = this.char(max, error)

            return [false, error]
        }

        return [true, 'success']
    }

    CheckField(input, text){

        if(input.length < 1){
            let error = this.input(text, errors['input-invalid'])

            return [false, error]
        }

        return [true, 'success']
    }

    ValidateFields(fields){
        fields.forEach((e,i)=>{
                    
            let message
            let inp = $("#"+e[0])

            if(e[0] != 'confirm_password'){

                if(e[0].length > 2){
                    let id = e[0]
                    let name = e[1]
                    let min = e[2]
                    let max = e[3]

                    let value = $("#"+id).value

                    message = this.Check(value, name, min, max)
                } else {
                    let id = e[0]
                    let name = e[1]

                    let value = $("#"+id).value

                    message = this.CheckField(value, name)
                }
            } else {
                message = this.ConfirmPassword()
            }

            if(!message[0]){
                inp.parentElement.querySelector('.msg').innerText = message[1]
                inp.classList.add('form-error')
                this.pass[i] = 0;

            } else {
                inp.parentElement.querySelector('.msg').innerText = ""
                if(inp.classList.contains('form-error')){
                    inp.classList.remove('form-error')
                }
                this.pass[i] = 1;

            }
            
        })

        let total = 0
        this.pass.forEach(e=>{
            total = total + e;
        })
       
        if(total == this.pass.length){

            $('.form-validate button').disabled = 'true'
            $('.form-validate').submit()
            
        }
    }

    constructor(fields){
        if($('.form-validate')){
            

            let btn = $('.form-validate button[type="submit"]')
            btn.type = "button";

            fields.forEach(e=>{
                this.pass.push(0)
                $("#"+e[0]).parentElement.insertAdjacentHTML('beforeend', "<span class='msg cool text-danger'></span>")
             })

             $('#'+fields[fields.length-1][0]).addEventListener("keypress", (event)=> {
                if (event.key === "Enter") {
                    event.preventDefault()
                    this.ValidateFields(fields)
                }
             })
        
            btn.addEventListener('click',(e)=>{

                e.preventDefault();
                this.ValidateFields(fields)
                
            })
        }
    }
}

if($('.signup-form')){
    let validateFields = [
        ["fname", "first name", 3, 155],
        ["lname", "last name", 3, 155],
        ["email", "email address", 3, 255],
        ["password", "password", 8, 255],
        ["confirm_password"]
    ]
    
    new FormValidate(validateFields);
}

if($('.login-form')){
    let validateFields = [
        ["email", "email address"],
        ["password", "password"]
    ]
    
    new FormValidate(validateFields);
}

let forms = document.querySelectorAll("form:not(.no-block)");
    forms.forEach(function(form) {
        form.addEventListener('submit', formSubmitted);
    });

function formSubmitted(e) {
    var submitButtons = e.target.querySelectorAll(".form-btn,button[type=submit],input[type=submit]");
    submitButtons.forEach(function(submitButton) {
        if(!submitButton.classList.contains('no-dis')){
            if (submitButton.tagName === "INPUT") {
                submitButton.value = "Submitting...";
            } else {
                submitButton.innerHTML = '<i class="fas fa-circle-notch fa-spin anim"></i> <span>Submitting ...</span>';
            }
            submitButton.disabled = true;

        }
    });

    let overlay = document.createElement("div");
    overlay.className = "submit-overlay";
    document.body.appendChild(overlay);
}


function detectThemeMode(){
    let theme = 'light'
    if(localStorage.getItem("theme")){
        if(localStorage.getItem("theme") == "dark"){
            theme = "dark";
        }
    } else if(!window.matchMedia) {
        return false;
    } else if(window.matchMedia("(prefers-color-scheme: dark)").matches) {
        theme = "dark";
    }

    if (theme == "dark") {
         document.documentElement.setAttribute("data-theme", "dark");
    }
}

detectThemeMode()

if($('#theme-switch')){
    console.log('sw')
    const toggleSwitch = document.querySelector('#theme-switch input[type="checkbox"]');

    //function that changes the theme, and sets a localStorage variable to track the theme between page loads
    function switchTheme(e) {
        if (e.target.checked) {
            localStorage.setItem('theme', 'dark');
            document.documentElement.setAttribute('data-theme', 'dark');
            toggleSwitch.checked = true;
        } else {
            localStorage.setItem('theme', 'light');
            document.documentElement.setAttribute('data-theme', 'light');
            toggleSwitch.checked = false;
        }    
    }

    //listener for changing themes
    toggleSwitch.addEventListener('change', switchTheme, false);

    //pre-check the dark-theme checkbox if dark-theme is set
    if (document.documentElement.getAttribute("data-theme") == "dark"){
        toggleSwitch.checked = true;
    }
}


if(document.querySelector('.auto-fill')){
    let inputs = document.querySelectorAll(".auto-fill input[type=text]")
    inputs.forEach(e=>{

        if(document.querySelector(`#s-${e.id}`)){

            e.addEventListener('keyup',()=>{
                document.querySelector(`#s-${e.id}`).innerText = e.value
            })
        }
    })

    let textareas = document.querySelectorAll(".auto-fill textarea")
    textareas.forEach(e=>{

        if(document.querySelector(`#s-${e.id}`)){

            e.addEventListener('keyup',()=>{
                document.querySelector(`#s-${e.id}`).innerText = e.value
            })
        }
    })

}

if(document.querySelector('.add-another')){
    let btn = document.querySelector('.add-another')
    
    let total = parseInt(document.querySelector('.to-add').dataset.total)

    btn.addEventListener('click',()=>{
        let toAdd = document.querySelector('.to-add')
        toAdd = toAdd.cloneNode(true)

        let nm = toAdd.dataset.name

        toAdd.querySelectorAll('input').forEach(e=>{
            e.name = `${nm}[${total}][${e.id}]`;
        })

        total++

        document.querySelector('.to-add').insertAdjacentElement('beforeend', toAdd)
    })
}