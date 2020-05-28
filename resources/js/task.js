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
    },
    update(id, attributeName, attributeValue) {
        fetch("/TaskManager/public/Task/update", {
            method: "POST",
            body: JSON.stringify({id, attributeName, attributeValue: Number(attributeValue)})
        })
    }
};

export default task;