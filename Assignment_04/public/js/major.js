document.getElementById("name").value = "";
var success = document.getElementById("success");

// get data
axios({
    method: 'get',
    url: 'major/show',
    responseType: 'json'
})
    .then(function (response) {
        var datas = response.data;
        datas.forEach(data => {
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
        });
    });
document.getElementById("createBtn").addEventListener("click", function () {
    document.getElementById("deleteSuccess").classList.add("d-none");
    var name = document.getElementById("name").value;
    var errMsg = document.getElementById("errMsg");

    if (name == "") {
        errMsg.innerHTML = "Major name is required";
    } else {
        let createData = {
            "name": name,
        };

        axios({
            method: 'post',
            url: '/major',
            data: {
                name: createData["name"],
            }
        }).then(response => {
            errMsg.innerHTML = "";
            document.getElementById("name").value = "";
            document.getElementById("success").classList.remove("d-none");
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

            var modalBackdrop = document.querySelector('.modal-backdrop');
            var createModal = document.getElementById("exampleModal");
        })
            .catch(error => {
                errMsg.innerHTML = error.response.data.message;
            });
    }
});


document.getElementById("createBtn").classList.add('hide');

// close btn
function closeBtn() {
    success.style.display = "none";
    document.getElementById("errMsg").innerHTML = "";
    document.getElementById("name").value = "";
}

// edit close btn
function closeEditBtn() {
    document.getElementById("successUpdate").classList.add("d-none");
    document.getElementById("errMsgUpdate").innerHTML = "";
}

// edit data
function editMajor(id) {
    document.getElementById("editId").value = id;
    axios({
        method: 'get',
        url: 'major/' + id + '/edit',
        responseType: 'json'
    })
        .then(function (response) {
            let name = response.data.name;
            document.getElementById("editName").value = name;
        });
}

// update data
function updateMajorBtn() {
    let editId = document.getElementById("editId").value;
    let editName = document.getElementById("editName").value;
    let updateData = {
        "name": editName,
    };

    axios.patch('major/' + editId, updateData)
        .then(function (response) {
            document.getElementById("updateId-" + response.data.id).innerHTML = response.data.name;
            document.getElementById("successUpdate").classList.remove("d-none");
            document.getElementById("editName").value = "";
            document.getElementById("exampleModal").style.display = "none";
        }).catch(error => {
            document.getElementById("errMsgUpdate").innerHTML = error.response.data.message;
        });
}


// delete data
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this item?")) {

        const childDelete = document.getElementById(`deleting-${id}`).parentNode;
        const parentDelete = childDelete.parentNode;
        parentDelete.parentNode.removeChild(parentDelete);

        axios({
            method: 'delete',
            url: 'major/' + id,
            responseType: 'json'
        })
            .then(function (response) {

                if (response.data) {
                    document.getElementById("deleteSuccess").classList.remove("d-none");
                }
            });
    }
}
