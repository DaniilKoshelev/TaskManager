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
        return fetch("/TaskManager/public/Auth/login", {
            method: "POST",
            body: JSON.stringify(credentials)
        }).then(res => res.json()).then(response => {
            if (response.authorized) {
                isAdmin = true;
            }
            return response;
        });
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

export default auth;