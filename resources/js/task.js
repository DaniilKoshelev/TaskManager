import {MAX_INPUT_LENGTH} from "./const.js";

let properties = {
    user: "",
    email: "",
    description: ""
};

const task = {
    changeProperty(property, value) {
        properties[property] = value
    },
    create() {
        if (inputValidated()) {
            return fetch("/TaskManager/public/Task/create", {
                method: "POST",
                body: JSON.stringify(properties)
            }).then(() => true);
        }
        return new Promise(res => res(false));
    },
    update(id, attributeName, attributeValue) {
        return fetch("/TaskManager/public/Task/update", {
            method: "POST",
            body: JSON.stringify({id, attributeName, attributeValue: attributeValue})
        });
    },
    setTag(id, tagId) {
        return fetch("/TaskManager/public/Task/setTag", {
            method: "POST",
            body: JSON.stringify({id, tagId})
        })
    }
};

function inputValidated() {
    return (properties.user !== ""
        && properties.description !== ""
        && properties.email !== ""
        && validateEmail(properties.email)
        && properties.description < MAX_INPUT_LENGTH
        && properties.email < MAX_INPUT_LENGTH
        && properties.user < MAX_INPUT_LENGTH
    )
}

function validateEmail(email) {
    let pattern  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(String(email).toLowerCase());
}

export default task;