let btnDeleteUser = document.querySelector('.btn-danger')
let btnPreventDeleteUser;
let checkedUsers;
let btnsOK = document.querySelectorAll('.btn_ok')
let btnAddUser = document.getElementById('btn_addUser')
let inputFirstName = document.querySelector('.form-control-firstName')
let inputLastName = document.querySelector('.form-control_lastName')
let inputStatus = document.querySelector('.form-check-input')
let selectOPtion = document.querySelector('.form_select-addUser')
let bodyTable = document.querySelector('.bodyTable');
let inputMain = document.querySelector('.input_main')
let btnPreventEditUser = document.querySelectorAll(".btn_edit")
let btnEditUser = document.querySelector('.btn_editUser')
let updateInputFirstName = document.querySelector('.inputUpdateName')
let updateinputLastName = document.querySelector('.inputUpdateLastName')
let updateinputStatus = document.querySelector('.inputUpdateStatus')
let updateselectOPtion = document.querySelector('.select-updateUser')
let errorBlock = document.querySelector('.errorBlock')
let errorUpdateBlock = document.querySelector('.errorUpdateBlock')
let updateModal = document.getElementById('updateModal')
let deleteModal = document.getElementById('staticBackdrop')
let modalOverlap = document.querySelector('.modal-backdrop') 
let body = document.querySelector('.body') 
const url = "http://localhost/backend/user.php";
const modifiedUrl = url.replace('/frontend/', '/');
startApp()


let valueFirstName = "";
let valueLastName = "";
let valueStatus = true;
let valueRole = "";
let deleteid;
let users = [];
let chosenUsers = [];
let valueOfActivity = '';
let massActivities = [];
let updateId;
let updateData={
    firstName:'',
    lastName:'',
    status:'',
    role:'admin'
};
let errorMessage='';

async function startApp() {

    let data = await getUsers();
    render(data);

    btnPreventDeleteUser = document.querySelectorAll('.btn_delete');
    btnPreventEditUser = document.querySelectorAll(".btn_edit")
    btnPreventDeleteUser.forEach(item => item.addEventListener('click', (e) => {
        const parentOfButton = e.currentTarget.parentNode;
        
        const mainParent = parentOfButton.parentNode
       
        deleteid = mainParent.id
    }))
    btnPreventEditUser.forEach(item => item.addEventListener('click', (e) => {
        const parentOfButton = e.currentTarget.parentNode;
        const mainParent = parentOfButton.parentNode
        updateInputFirstName.value=mainParent.querySelector('.name').textContent.split(' ')[0]
        updateinputLastName.value=mainParent.querySelector('.name').textContent.split(' ')[1]
        let btn = mainParent.querySelector('.status_col button')
        btn.classList.value=='status'?updateinputStatus.checked=false:updateinputStatus.checked=true;
        updateselectOPtion.value = mainParent.querySelector('.role').textContent
        updateId = mainParent.id
       
        updateData.firstName=updateInputFirstName.value
        updateData.lastName=updateinputLastName.value
        modalOverlap = document.querySelector('.modal-backdrop') 
       
    }))
    
    checkedUsers.forEach(item =>
        item.addEventListener('change', (e) => {
            if (e.currentTarget.checked == true) {
                chosenUsers.push(item.parentNode.parentNode.id)
            }
            else{
                chosenUsers = chosenUsers.filter(item=>item!=e.currentTarget.parentNode.parentNode.id)
                console.log(e.currentTarget.parentNode.parentNode.id)
                inputMain.checked=false
            }
        })

    )
    massActivities = [{ title: "delete", action: deleteUsers },{ title: "setActive", action: setActive },{ title: "setNotActive", action: setNotActive }]


    errorBlock.innerHTML = errorMessage;
    errorUpdateBlock.innerHTML = errorMessage;
}


function render(data) {

    data.forEach(item => {
        console.log(item[0])
        const elementTable = document.createElement("tr");
        elementTable.id = item[0];
        elementTable.innerHTML = `
        <th scope="row" class="col1">
            <input type="checkbox" class="input">
        </th>
        <td class="name">${item[1]} ${item[2]}</td>
        <td class="role">${item[3]}</td>
        <td class="status_col">
            <button class=${item[4] == 1 ? "status-active" : "status"}></button>
        </td>
        
        <td class="col_actions">
            <button type="button" class="btn btn-outline-secondary btn_edit" data-bs-toggle="modal" data-bs-target="#updateModal"> <img src="edit.png" alt=""></button>
            <button class="btn btn-outline-secondary btn_delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <img src="delete.png" alt="">
            </button>
        </td>
    `;
        bodyTable.appendChild(elementTable)

    })

    btnDeleteUser = document.querySelector('.btn-danger')
    btnAddUser = document.getElementById('btn_addUser')
    inputFirstName = document.querySelector('.form-control-firstName')
    inputLastName = document.querySelector('.form-control_lastName')
    inputStatus = document.querySelector('.form-check-input')
    selectOPtion = document.querySelector('.form_select-addUser')
    bodyTable = document.querySelector(".bodyTable")
    checkedUsers = document.querySelectorAll(".input")


}




inputMain.addEventListener('change',(e)=>{
    if(e.target.checked){
        checkedUsers.forEach(item=>{
            chosenUsers.push(item.parentNode.parentNode.id)
            
            item.checked=true})
        
    }
    else{
        
        checkedUsers.forEach(item=>item.checked=false)
    }
   
})

function cleanError(error){
    error.innerHTML=''
}

btnAddUser.addEventListener('click', (e) => {
    e.preventDefault()
    saveUser();
    inputFirstName.value='';
    inputLastName.value='';
    inputStatus.checked=true;
    selectOPtion.value = selectOPtion[0].value;
    valueFirstName = "";
    valueLastName = "";
    valueStatus = true;
    valueRole = "";
    errorMessage=''
})

btnEditUser.addEventListener('click',async  (e)=>{
    e.preventDefault()
    await updateUser(updateData,updateId)
    if(!errorMessage){
       let modal  =   bootstrap.Modal.getOrCreateInstance(updateModal);
        modal.hide(); 
    }
})



btnDeleteUser.addEventListener('click', () => {
    deleteUser(deleteid)
    let modal  =   bootstrap.Modal.getOrCreateInstance(deleteModal);
    modal.hide(); 
})

inputFirstName.addEventListener("input", (e) => {
    cleanError(errorBlock);
    valueFirstName = e.target.value;
   
})

inputLastName.addEventListener("input", (e) => {
    valueLastName = e.target.value
    cleanError(errorBlock);
})
inputStatus.addEventListener("change", (e) => {
    valueStatus = e.target.checked
})
selectOPtion.addEventListener("change", (e) => {
    valueRole = e.target.value
})

updateInputFirstName.addEventListener('input', (e) => {
    
    updateData.firstName = e.currentTarget.value
    cleanError(errorUpdateBlock);
});

updateinputLastName.addEventListener('input', (e) => {
  
    updateData.lastName = e.target.value
    cleanError(errorUpdateBlock);
});

updateinputStatus.addEventListener('change', (e) => {
    
    updateData.status = e.target.checked;
});

updateselectOPtion.addEventListener('change', (e) => {
    updateData.role = e.target.value
});

console.log(btnsOK)

btnsOK.forEach(btnOk => btnOk.addEventListener('click', () => {
    if(chosenUsers.length==0){
        alert('Choose users')
        return;
    }
    console.log(chosenUsers)
    valueOfActivity = btnOk.previousElementSibling.selectedOptions[0].value
    massActivities.forEach(item => {
        if (item.title == valueOfActivity) {
            item.action(chosenUsers)
        }
    })
    inputMain.checked=false
}))



async function deleteUsers(arr) {
    let isAnswer = false;
    let res = await fetch('backend/user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: "deleteUsers", users:arr})
    })
    
    const data = await res.json();
    checkData(data)
    bodyTable.innerHTML = '';
    chosenUsers=[];
    startApp();
    
    
}

function checkData  (data){
    if(data.status=='false')
    {
        errorMessage = data.error.message
    }
    else{
        alert(data.message)
        errorMessage=''
    }
}


const saveUser = async () => {
    let res = await fetch(modifiedUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: "saveUser", valueFirstName, valueLastName, valueRole, valueStatus })
    })
    const data = await res.json();
    
   
    bodyTable.innerHTML = '';
    startApp();
    checkData(data)
}

async function getUsers() {
    let res = await fetch(modifiedUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: "getUsers" })
    })
    const data = await res.json();
    if(data.status==true){
        return data.users
    }
    else{
        console.log(data.message)
        return [];
    }
    
}
async function updateUser(updateData,id) {
    let res = await fetch(modifiedUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: "updateUser", updateData,id })
    })
    const data = await res.json()
    checkData(data);
    bodyTable.innerHTML = '';
    startApp();
}

async function deleteUser(id) {

    let res = await fetch(modifiedUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: "deleteUser", deleteId: Number(id) })
    })
    const data = await res.json();  
    bodyTable.innerHTML = '';
    checkData(data);
    startApp();
   
}

async function setActive(arr){
    let res = await fetch(modifiedUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: "setActive", users:arr})
    })
    const data = await  res.json()
    checkData(data);
    bodyTable.innerHTML = '';
    chosenUsers=[];
    startApp();
}
async function setNotActive(arr){
    let isAnswer = false;
    let res = await fetch(modifiedUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: "setNotActive", users:arr})
    })
    const data = await  res.json()
    bodyTable.innerHTML = '';
    chosenUsers=[];
    startApp();
    checkData(data);
}


