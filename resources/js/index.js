import pagination from "./pagination.js";
import auth from "./auth.js";
import task from "./task.js";
import sort from "./sort";
import * as constants from "./const";

const pageNext = document.getElementById("page-next");
const pagePrev = document.getElementById("page-prev");
const pageCurr = document.getElementById("page-curr");
const btnLogin = document.getElementById("btn-login");
const btnLogout = document.getElementById("btn-logout");
const formLogin = document.getElementById("form-login");
const inputUsername = document.getElementById("input-username");
const inputPassword = document.getElementById("input-password");
const tbody = document.getElementById("task-table");
const btnSubmit = document.getElementById("btn-submit");
const inputUser =  document.getElementById("input-user");
const inputEmail =  document.getElementById("input-email");
const inputDescription =  document.getElementById("input-description");
const sortFields = document.getElementById("sort-fields");

function updatePage(page) {
    tbody.textContent = "";
    page.forEach(taskItem => {
        Object.defineProperty(taskItem, "id", {enumerable: false});
        Object.defineProperty(taskItem, "status", {enumerable: false});
        Object.defineProperty(taskItem, "description", {enumerable: false});

        const tr = document.createElement("tr");

        let td = document.createElement("td");
        let input = document.createElement("input");
        input.classList.add('input-description');
        //input.id = "input-description" + taskItem.id;
        input.value = taskItem.description;

        input.addEventListener('change', e => {
            task.update(taskItem.id, "description", e.target.value).then(() => {
                task.setTag(taskItem.id, constants.TAG_EDITED).then(() => {
                    refreshPage();
                });
            });
        });

        td.appendChild(input);
        tr.appendChild(td);

        input.addEventListener("focus", e => {
            if (!auth.isAdmin) {
                e.currentTarget.blur();
            }
        });

        for (let value of Object.values(taskItem)) {
            const td = document.createElement("td");
            td.textContent = value;
            tr.appendChild(td);
        }

        td = document.createElement("td");
        input = document.createElement("input");

        input.setAttribute("type", "checkbox");
        input.addEventListener("click", e => {
            if (!auth.isAdmin || !e.target.checked) {
                e.preventDefault();
            }
        });

        input.addEventListener("change", e => {
            task.update(taskItem.id, "status", e.target.checked).then(() => {
                task.setTag(taskItem.id, constants.TAG_COMPLETED).then(() => {
                    refreshPage();
                })
            });
        });

        td.appendChild(input);
        tr.appendChild(td);

        if (+taskItem.status) {
            input.setAttribute("checked", "");
        }

        tbody.appendChild(tr);
    })
}

function authorize() {
    formLogin.style.display = "none";
    btnLogout.style.display = "inline-block";
}

function deauthorize() {
    formLogin.style.display = "flex";
    btnLogout.style.display = "none";
}

function refreshPage() {
    pagination.getPage(pagination.pageNumber, sort.filter).then(page => {
        updatePage(page);
    });
}

function clearInputTask() {
    inputEmail.value = "";
    inputUser.value = "";
    inputDescription.value = "";
}

function clearInputLogin() {
    inputUsername.value = "";
    inputPassword.value = "";
}

function handleChangeCredential(e) { auth.changeCredential(e.target.name, e.target.value); }
inputUsername.addEventListener("change", handleChangeCredential);
inputPassword.addEventListener("change", handleChangeCredential);

function handleChangeProperty(e) { task.changeProperty(e.target.name, e.target.value); }
inputUser.addEventListener("change", handleChangeProperty);
inputEmail.addEventListener("change", handleChangeProperty);
inputDescription.addEventListener("change", handleChangeProperty);

pageNext.addEventListener("click", function () {
    pagination.getPage(pagination.pageNumber + 1, sort.filter).then(page => {
        if (!page.length) return;
        pagination.pageNext();
        updatePage(page);
        pageCurr.textContent = pagination.pageNumber + 1;
    });
});

pagePrev.addEventListener("click", function () {
    pagination.getPage(pagination.pageNumber - 1, sort.filter).then(page => {
        if (pagination.pageNumber === 0) return;
        pagination.pagePrev();
        updatePage(page);
        pageCurr.textContent = pagination.pageNumber + 1;
    });
});

btnLogin.addEventListener("click", function () {
    auth.login().then(res => {
        if (res.authorized) {
            authorize();
            clearInputLogin();
        } else {
            alert(res.error);
        }
    });
});

btnLogout.addEventListener("click", function () {
    auth.logout().then(function () {
        deauthorize();
    });
});

btnSubmit.addEventListener('click', function () {
    task.create().then(res => {
        if (res) {
            refreshPage();
            clearInputTask();
            alert(constants.MESSAGE_TASK_CREATED);
        }
        else alert(constants.ERROR_VALIDATION_CREATE_TASK);
    })
});

sortFields.addEventListener("click", function (e) {
    if (!e.target.dataset.value) return;
    sort.change(e.target.dataset.value);
    refreshPage();
});

auth.checkAdmin().then(() => {
    if (auth.isAdmin) {
        authorize();
    }
});

refreshPage();