import pagination from "./pagination.js";
import auth from "./login.js";
import task from "./task.js"

const pageNext = document.getElementById("page-next");
const pagePrev = document.getElementById("page-prev");
const pageCurr = document.getElementById("page-curr");
const btnLogin = document.getElementById("btn-login");
const inputUsername = document.getElementById("input-username");
const inputPassword = document.getElementById("input-password");
const tbody = document.getElementById("task-table");
const btnSubmit = document.getElementById("btn-submit");
const inputUser =  document.getElementById("input-user");
const inputEmail =  document.getElementById("input-email");
const inputDescription =  document.getElementById("input-description");

pagination.getPage(pagination.pageNumber).then(page => {
    updateTasks(page);
});

pageNext.addEventListener("click", function () {
    pagination.getPage(pagination.pageNumber + 1).then(page => {
        if (!page.length) return;
        console.log("before: ", pagination.pageNumber);
        pagination.pageNext();
        updateTasks(page);
        console.log("aft:", pagination.pageNumber);
        pageCurr.textContent = pagination.pageNumber + 1;
    });
});

pagePrev.addEventListener("click", function () {
    pagination.getPage(pagination.pageNumber - 1).then(page => {
        if (pagination.pageNumber === 0) return;
        pagination.pagePrev();
        updateTasks(page);
        pageCurr.textContent = pagination.pageNumber + 1;
    });
});

function updateTasks(page) {
    console.log(page);
    tbody.textContent = "";
    page.forEach(task => {
        const tr = document.createElement("tr");
        for (let value of Object.values(task)) {
            const td = document.createElement("td");
            td.textContent = value;
            tr.appendChild(td);
        }
        tbody.appendChild(tr);
    })
}

inputUsername.addEventListener("change", function (e) {
    auth.changeCredential(e.target.name, e.target.value);
});

inputPassword.addEventListener("change", function (e) {
    auth.changeCredential(e.target.name, e.target.value);
});

btnLogin.addEventListener("click", function () {
    auth.login();
});

btnSubmit.addEventListener('click', function () {
    task.create();
});

inputUser.addEventListener("change", function (e) {
    task.changeProperty(e.target.name, e.target.value);
});

inputEmail.addEventListener("change", function (e) {
    task.changeProperty(e.target.name, e.target.value);
});

inputDescription.addEventListener("change", function (e) {
    task.changeProperty(e.target.name, e.target.value);
});
