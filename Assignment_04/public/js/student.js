// get data
axios({
    method: 'get',
    url: 'student/show',
    responseType: 'json'
})
    .then(function (response) {
        var datas = response.data;
        datas.forEach(data => {
            let myData = `
                        <tr>
                            <td>${data["id"]}</td>
                            <td id="updateName-${data["id"]}">${data["name"]}</td>
                            <td id="updateMajorName-${data["id"]}">${data.major["name"]}</td>
                            <td id="updatePhone-${data["id"]}">${data["phone"]}</td>
                            <td id="updateEmail-${data["id"]}">${data["email"]}</td>
                            <td id="updateAddress-${data["id"]}">${data["address"]}</td>

                            <td>
                                <button type="button" class="btn btn-primary" onclick="editStudent(${data["id"]})" data-bs-toggle="modal" data-bs-target="#editModal">
                                    Edit
                                </button>
                                <button type="button" id="deleting-${data['id']}" onclick="confirmDelete(${data["id"]})" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    `;
            document.getElementById("tableData").innerHTML += myData;
        });
    });

// get major
axios({
    method: 'get',
    url: 'major/show',
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
            let myData = `
                    <tr>
                        <td>${data["id"]}</td>
                        <td id="updateName-${data["id"]}">${data["name"]}</td>
                        <td id="updateMajorName-${data["id"]}">${data.major["name"]}</td>
                        <td id="updatePhone-${data["id"]}">${data["phone"]}</td>
                        <td id="updateEmail-${data["id"]}">${data["email"]}</td>
                        <td id="updateAddress-${data["id"]}">${data["address"]}</td>

                        <td>
                            <button type="button" class="btn btn-primary" onclick="editStudent(${data["id"]})" data-bs-toggle="modal" data-bs-target="#editModal">
                                Edit
                            </button>
                            <button type="button" id="deleting-${data['id']}" onclick="confirmDelete(${data["id"]})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    `;
            document.getElementById("tableData").innerHTML += myData;

            errAddress.innerHTML = "";
            errEmail.innerHTML = "";
            errPhone.innerHTML = "";
            errName.innerHTML = "";
            errMajorId.innerHTML = "";

            document.getElementById("name").value = "";
            document.getElementById("email").value = "";
            document.getElementById("phone").value = "";
            document.getElementById("address").value = "";
            document.getElementById("majorId").value = "";

            document.getElementById("successStore").classList.remove("d-none");

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

// btn close create
function btnCloseStudentCreate() {
    document.getElementById("name").value = "";
    document.getElementById("phone").value = "";
    document.getElementById("email").value = "";
    document.getElementById("address").value = "";
    document.getElementById("majorId").value = "";

    document.getElementById("errAddress").innerHTML = "";
    document.getElementById("errEmail").innerHTML = "";
    document.getElementById("errPhone").innerHTML = "";
    document.getElementById("errName").innerHTML = "";
    document.getElementById("errMajorId").innerHTML = "";

    document.getElementById("successStore").classList.add("d-none");
}

// delete data
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        const childDelete = document.getElementById(`deleting-${id}`).parentNode;
        const parentDelete = childDelete.parentNode;
        parentDelete.parentNode.removeChild(parentDelete);

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

// edit student
function editStudent(id) {
    axios({
        method: 'get',
        url: 'student/' + id + '/edit',
        responseType: 'json'
    })
        .then(function (response) {
            let student = response.data.student;
            let majors = response.data.majors;

            document.getElementById("editName").value = student["name"];
            document.getElementById("editPhone").value = student["phone"];
            document.getElementById("editEmail").value = student["email"];
            document.getElementById("editAddress").value = student["address"];
            document.getElementById("editId").value = student["id"];

            majors.forEach(major => {
                let myData = `
                            <option value="${major["id"]}" ${major["id"] == student["major_id"] ? "selected" : ""}>${major["name"]}</option>
                        `;
                document.getElementById("editMajorId").innerHTML += myData;
            });
        });
}

// btn close for update
function btnCloseStudentUpdate() {
    document.getElementById("editMajorId").innerHTML = "";
    document.getElementById("errUpdateAddress").innerHTML = "";
    document.getElementById("errUpdateEmail").innerHTML = "";
    document.getElementById("errUpdatePhone").innerHTML = "";
    document.getElementById("errUpdateName").innerHTML = "";
    document.getElementById("errUpdateMajorId").innerHTML = "";
    document.getElementById("successUpdate").classList.add("d-none");
}

// update
function updateStudentBtn() {
    let editId = document.getElementById("editId").value;
    console.log(editId);
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
            console.log(response.data.id);
            document.getElementById("successUpdate").classList.remove("d-none");
            document.getElementById("editName").value = "";
            document.getElementById("editPhone").value = "";
            document.getElementById("editEmail").value = "";
            document.getElementById("editAddress").value = "";
            document.getElementById("editMajorId").value = "";

            document.getElementById("updateName-" + response.data.id).innerHTML = response.data.name;
            document.getElementById("updateMajorName-" + response.data.id).innerHTML = response.data.major.name;
            document.getElementById("updatePhone-" + response.data.id).innerHTML = response.data.phone;
            document.getElementById("updateEmail-" + response.data.id).innerHTML = response.data.email;
            document.getElementById("updateAddress-" + response.data.id).innerHTML = response.data.address;

            errUpdateAddress.innerHTML = "";
            errUpdateEmail.innerHTML = "";
            errUpdatePhone.innerHTML = "";
            errUpdateName.innerHTML = "";
            errUpdateMajorId.innerHTML = "";
        }).catch(error => {
            console.log(error.response);
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
