let credentials = {
    username: "",
    password: ""
};

const auth = {
    changeCredential(credential, value) {
        credentials[credential] = value
    },
    login() {
        fetch("/TaskManager/public/Auth/login", {
            method: "POST",
            body: JSON.stringify(credentials)
        });
    }
};

export default auth;