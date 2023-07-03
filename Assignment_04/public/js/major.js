// create
function createBtn() {
    document.getElementById("successUpdate").classList.add("d-none");
    document.getElementById("deleteSuccess").classList.add("d-none");
    var name = document.getElementById("name").value;
    var errMsg = document.getElementById("errMsg");

    let createData = {
        "name": name,
    };

    axios({
        method: 'post',
        url: '/major',
        data: {
            name: createData.name,
        }
    }).then(response => {
        errMsg.innerHTML = "";
        document.getElementById("name").value = "";
        var data = response.data;
        let myData = `
                    <tr>
                        <td>${data["id"]}</td>
                        <td id="updateId-${data["id"]}">${data["name"]}</td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="editMajor(${data["id"]})" data-bs-toggle="modal" data-bs-target="#editModal">
                                Edit
                            </button>
                            <button type="button" id="deleting-${data['id']}" onclick="confirmDelete(${data["id"]})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                `;
        document.getElementById("tableData").innerHTML += myData;

        document.getElementById("success").classList.remove("d-none");

        const modalElement = document.getElementById('createModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();
    })
        .catch(error => {
            if (error.response) {
                errMsg.innerHTML = error.response.data.message;
            }
        });
}

document.addEventListener("DOMContentLoaded", function () {
    const modalElement = document.getElementById("createModal");

    modalElement.addEventListener("hidden.bs.modal", function () {
        const inputElements = modalElement.querySelectorAll("input");
        inputElements.forEach(function (inputElement) {
            inputElement.value = "";
        });

        const errorMessageElement = modalElement.querySelector("p");
        if (errorMessageElement) {
            errorMessageElement.innerHTML = "";
        }
    });
});

// edit close btn
function closeEditBtn() {
    document.getElementById("errMsgUpdate").innerHTML = "";
}

// edit data
let editData;
function editMajor(id) {
    document.getElementById("editId").value = id;
    let row = document.getElementById("edit-"+id).parentNode.parentNode;
    let cols = row.querySelectorAll("td");
    editName = cols[1].innerHTML;
    document.getElementById("editName").value = editName;
}

// update data
function updateMajorBtn() {

    document.getElementById("success").classList.add("d-none");
    document.getElementById("deleteSuccess").classList.add("d-none");

    let editId = document.getElementById("editId").value;
    let editName = document.getElementById("editName").value;
    let updateData = {
        "name": editName,
    };

    axios.patch('major/' + editId, updateData)
        .then(function (response) {
            document.getElementById("updateId-" + response.data.id).innerHTML = response.data.name;

            document.getElementById("successUpdate").classList.remove("d-none");

            const modalElement = document.getElementById('editModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();

        }).catch(error => {
            document.getElementById("errMsgUpdate").innerHTML = error.response.data.message;
        });
}

// delete data
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this item?")) {

        document.getElementById("success").classList.add("d-none");
        document.getElementById("successUpdate").classList.add("d-none");

        axios({
            method: 'delete',
            url: 'major/' + id,
            responseType: 'json'
        })
            .then(function (response) {
                if (response.data) {
                    document.getElementById("deleteSuccess").classList.remove("d-none");
                }

                const childDelete = document.getElementById(`deleting-${id}`).parentNode;
                const parentDelete = childDelete.parentNode;
                parentDelete.parentNode.removeChild(parentDelete);
            });
    }
}
