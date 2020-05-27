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
        fetch("/TaskManager/public/Task/create", {
            method: "POST",
            body: JSON.stringify(properties)
        });
    }
};

export default task;