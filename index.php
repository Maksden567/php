<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css" />
</head>

<body class="body">
    <div class="wrapper">
        <div class="header">
            <button type="button" class="btn btn-primary btn_addUser" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add</button>
            <select class="form-select" aria-label="Default select example">
                <option selected>Please Select</option>
                <option value="setActive">Set Active</option>
                <option value="setNotActive">Set Not Active</option>
                <option value="delete">Delete</option>
            </select>
            <button type="button" class="btn btn-primary btn_ok">OK</button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col1"> <input type="checkbox" class="input_main"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="col_actions">Actions</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                
            </tbody>
        </table>
        <div class="footer">
            <button type="button" class="btn btn-primary btn_addUser" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add</button>
            <select class="form-select" aria-label="Default select example">
                <option selected>Please Select</option>
                <option value="setActive">Set Active</option>
                <option value="setNotActive">Set Not Active</option>
                <option value="delete">Delete</option>
            </select>
            <button type="button" class="btn btn-primary btn_ok">OK</button>
        </div>

    </div>




    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control form-control-firstName" id="first-name">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control form-control_lastName" id="last-name">
                    </div>
                </form>

                <div class="form-check form-switch">
                    <label class="role_title">Status</label>
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>

                </div>
                <div class="role_block">
                    <label class="role_title">Role</label>
                    <select class="form-select form_select-addUser" aria-label="Default select example">
                        <option value="" selected>Pease Select</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>

                    </select>
                </div>
                <div class="errorBlock">
                    
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn_addUser" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade deleteModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete Maks?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="updateModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control inputUpdateName" id="first-name">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control inputUpdateLastName" id="last-name">
                    </div>
                </form>

                <div class="form-check form-switch">
                    <label class="role_title">Status</label>
                    <input class="form-check-input inputUpdateStatus" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>

                </div>
                <div class="role_block">
                    <label class="role_title">Role</label>
                    <select class="form-select select-updateUser form_select-addUser" aria-label="Default select example">
                        <option value="admin" selected>Admin</option>
                        <option value="user">User</option>

                    </select>
                </div>
                <div class="errorUpdateBlock">
                   
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn_editUser">Update</button>
            </div>
        </div>
    </div>
</div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="./js/main.js"></script>
</body>

</html>