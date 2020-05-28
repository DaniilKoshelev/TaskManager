let properties = {
    field: 'ID',
    order: 'ASC'
};

let sort = {
    change(field) {
        if (field === properties.field) {
            properties.order = (properties.order === "ASC") ? "DESC" : "ASC";
        } else {
            properties.field = field;
            properties.order = 'ASC';
        }
    },
    get filter() {
        const { field, order } = properties;
        return `${field} ${order}`;
    }
};

export default sort;