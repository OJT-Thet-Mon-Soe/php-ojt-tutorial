// get major data
axios({
    method: 'get',
    url: 'student/major',
    responseType: 'json'
})
    .then(function (response) {
        var datas = response.data;
        datas.forEach(data => {
            let myData = `
                    <option value="${data["id"]}">${data["name"]}</option>
                `;
            document.getElementById("majorId").innerHTML += myData;
        });
    });

// create student
function createStudentBtn() {

    let name = document.getElementById("name").value;
    let phone = document.getElementById("phone").value;
    let email = document.getElementById("email").value;
    let address = document.getElementById("address").value;
    let majorId = document.getElementById("majorId").value;

    document.getElementById("deleteSuccess").classList.add("d-none");
    document.getElementById("successUpdate").classList.add("d-none");

    let createData = {
        "name": name,
        "phone": phone,
        "email": email,
        "address": address,
        "majorId": majorId,
    };

    let errAddress = document.getElementById("errAddress");
    let errEmail = document.getElementById("errEmail");
    let errPhone = document.getElementById("errPhone");
    let errName = document.getElementById("errName");
    let errMajorId = document.getElementById("errMajorId");

    axios.post('student', createData)
        .then(response => {
            var data = response.data;
            if (data["address"].length > 50) {
                address = data["address"].substring(0, 50) + '...';
            }
            let myData = `
                    <tr>
                        <td>${data["id"]}</td>
                        <td id="updateName-${data["id"]}">${data["name"]}</td>
                        <td id="updateMajorName-${data["id"]}">${data.major["name"]}</td>
                        <td id="updatePhone-${data["id"]}">${data["phone"]}</td>
                        <td id="updateEmail-${data["id"]}">${data["email"]}</td>
                        <td id="updateAddress-${data["id"]}">${address}</td>

                        <td>
                            <button type="button" class="btn btn-primary" onclick="editStudent(${data["id"]})" data-bs-toggle="modal" data-bs-target="#editModal">
                                Edit
                            </button>
                            <button type="button" id="deleting-${data['id']}" onclick="confirmDelete(${data["id"]})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    `;
            document.getElementById("tableData").innerHTML += myData;

            document.getElementById("successStore").classList.remove("d-none");

            document.getElementById("majorId").value = "";

            let createModal = document.getElementById("createModal");
            let modal = bootstrap.Modal.getInstance(createModal);
            modal.hide();

            let errorMessageElement = document.getElementById("createModal").querySelectorAll(".error");
            errorMessageElement.forEach(err => {
                err.innerHTML = "";
            });
        })
        .catch(error => {
            if (error.response) {
                if (error.response.data.errors.address) {
                    errAddress.innerHTML = error.response.data.errors.address;
                } else {
                    errAddress.innerHTML = "";
                }
                if (error.response.data.errors.email) {
                    errEmail.innerHTML = error.response.data.errors.email;
                } else {
                    errEmail.innerHTML = "";
                }
                if (error.response.data.errors.phone) {
                    errPhone.innerHTML = error.response.data.errors.phone;
                } else {
                    errPhone.innerHTML = "";
                }
                if (error.response.data.errors.name) {
                    errName.innerHTML = error.response.data.errors.name;
                } else {
                    errName.innerHTML = "";
                }
                if (error.response.data.errors.majorId) {
                    errMajorId.innerHTML = "Major Field is required.";
                } else {
                    errMajorId.innerHTML = "";
                }
            }
        });
}

function createBtnClose() {
    const errorMessageElement = document.getElementById("createModal").querySelectorAll(".error");
    errorMessageElement.forEach(err => {
        err.innerHTML = "";
    });

    document.getElementById("majorId").value = "";
}

document.addEventListener("DOMContentLoaded", function () {
    const modalElement = document.getElementById("createModal");

    modalElement.addEventListener("hidden.bs.modal", function () {
        const inputElements = modalElement.querySelectorAll("input");
        inputElements.forEach(function (inputElement) {
            inputElement.value = "";
        });
    });
});

// edit student
function editStudent(id) {
    let row = document.getElementById("edit-" + id).parentNode.parentNode;
    let cols = row.querySelectorAll("td");

    document.getElementById("editId").value = cols[0].innerHTML;
    document.getElementById("editName").value = cols[1].innerHTML;
    document.getElementById("editPhone").value = cols[3].innerHTML;
    document.getElementById("editEmail").value = cols[4].innerHTML;
    document.getElementById("editAddress").value = cols[5].innerHTML.trimStart();

    // get major
    axios({
        method: 'get',
        url: 'student/major',
        responseType: 'json'
    })
        .then(function (response) {
            var datas = response.data;
            datas.forEach(data => {
                let myData = `
                        <option value="${data["id"]}" ${data["name"] == cols[2].innerHTML ? "selected" : ""}>${data["name"]}</option>
                    `;
                document.getElementById("editMajorId").innerHTML += myData;
            });
        });
}

// btn close for update
function btnCloseStudentUpdate() {
    document.getElementById("errUpdateAddress").innerHTML = "";
    document.getElementById("errUpdateEmail").innerHTML = "";
    document.getElementById("errUpdatePhone").innerHTML = "";
    document.getElementById("errUpdateName").innerHTML = "";
    document.getElementById("errUpdateMajorId").innerHTML = "";
}

// update
function updateStudentBtn() {
    let editId = document.getElementById("editId").value;
    let name = document.getElementById("editName").value;
    let phone = document.getElementById("editPhone").value;
    let email = document.getElementById("editEmail").value;
    let address = document.getElementById("editAddress").value;
    let majorId = document.getElementById("editMajorId").value;

    let errUpdateAddress = document.getElementById("errUpdateAddress");
    let errUpdateEmail = document.getElementById("errUpdateEmail");
    let errUpdatePhone = document.getElementById("errUpdatePhone");
    let errUpdateName = document.getElementById("errUpdateName");
    let errUpdateMajorId = document.getElementById("errUpdateMajorId");

    let updateData = {
        "name": name,
        "phone": phone,
        "email": email,
        "address": address,
        "majorId": majorId,
    };

    axios.patch('student/' + editId, updateData)
        .then(function (response) {

            document.getElementById("successUpdate").classList.remove("d-none");
            document.getElementById("successStore").classList.add("d-none");
            document.getElementById("deleteSuccess").classList.add("d-none");

            document.getElementById("updateName-" + response.data.id).innerHTML = response.data.name;
            document.getElementById("updateMajorName-" + response.data.id).innerHTML = response.data.major.name;
            document.getElementById("updatePhone-" + response.data.id).innerHTML = response.data.phone;
            document.getElementById("updateEmail-" + response.data.id).innerHTML = response.data.email;
            document.getElementById("updateAddress-" + response.data.id).innerHTML = response.data.address;

            document.getElementById("editMajorId").innerHTML += "";

            let editModal = document.getElementById("editModal");
            let myEditModal = bootstrap.Modal.getInstance(editModal);
            myEditModal.hide();

            let option = document.getElementById("editMajorId").querySelectorAll("option");
            document.getElementById("editMajorId").innerHTML = option[0];

            errUpdateAddress.innerHTML = "";
            errUpdateEmail.innerHTML = "";
            errUpdatePhone.innerHTML = "";
            errUpdateName.innerHTML = "";
            errUpdateMajorId.innerHTML = "";

        }).catch(error => {
            if (error.response) {
                if (error.response.data.errors.address) {
                    errUpdateAddress.innerHTML = error.response.data.errors.address;
                } else {
                    errUpdateAddress.innerHTML = "";
                }
                if (error.response.data.errors.email) {
                    errUpdateEmail.innerHTML = error.response.data.errors.email;
                } else {
                    errUpdateEmail.innerHTML = "";
                }
                if (error.response.data.errors.phone) {
                    errUpdatePhone.innerHTML = error.response.data.errors.phone;
                } else {
                    errUpdatePhone.innerHTML = "";
                }
                if (error.response.data.errors.name) {
                    errUpdateName.innerHTML = error.response.data.errors.name;
                } else {
                    errUpdateName.innerHTML = "";
                }
                if (error.response.data.errors.majorId) {
                    errUpdateMajorId.innerHTML = "Major Field is required.";
                } else {
                    errUpdateMajorId.innerHTML = "";
                }
            }
        });
}

// delete data
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this item?")) {

        const childDelete = document.getElementById(`deleting-${id}`).parentNode;
        const parentDelete = childDelete.parentNode;
        parentDelete.parentNode.removeChild(parentDelete);

        document.getElementById("successStore").classList.add("d-none");
        document.getElementById("successUpdate").classList.add("d-none");

        axios({
            method: 'delete',
            url: 'student/' + id,
            responseType: 'json'
        })
            .then(function (response) {
                if (response.data) {
                    document.getElementById("deleteSuccess").classList.remove("d-none");
                }
            });
    }
}
