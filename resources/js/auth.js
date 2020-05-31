import {ERROR_VALIDATION_LOGIN, MAX_INPUT_LENGTH} from "./const";

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
            return fetch("/TaskManager/public/Login/login", {
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
        return fetch("/TaskManager/public/Login/logout", {
            method: "POST"
        }).then(() => {
            isAdmin = false;
        })
    },
    checkAdmin() {
        return fetch("/TaskManager/public/Login/isAdmin", {
            method: "POST"
        }).then(res => res.json()).then(response => {isAdmin = response.isAdmin;})
    },
    get isAdmin() {
        return isAdmin;
    }
};

function inputValidated() {
    return (credentials.username !== ""
        && credentials.password !== ""
        && credentials.username.length < MAX_INPUT_LENGTH
        && credentials.password.length < MAX_INPUT_LENGTH
    );
}

export default auth;