import {ERROR_VALIDATION_LOGIN} from "./const";

let credentials = {
    username: "",
    password: ""
};

let isAdmin = false;

const auth = {
    changeCredential(credential, value) {
        credentials[credential] = value
    },
    login() {
        if (inputValidated()) {
            return fetch("/TaskManager/public/Auth/login", {
                method: "POST",
                body: JSON.stringify(credentials)
            }).then(res => res.json()).then(response => {
                isAdmin = true;
                return response;
            });
        }
        return new Promise(res => res({error: ERROR_VALIDATION_LOGIN}));
    },
    logout() {
        return fetch("/TaskManager/public/Auth/logout", {
            method: "POST"
        }).then(() => {
            isAdmin = false;
        })
    },
    checkAdmin() {
        return fetch("/TaskManager/public/Auth/isAdmin", {
            method: "POST"
        }).then(res => res.json()).then(response => {isAdmin = response.isAdmin;})
    },
    get isAdmin() {
        return isAdmin;
    }
};

function inputValidated() {
    return (credentials.username !== "" && credentials.password !== "");
}

export default auth;