let pageNumber = 0;

const pagination = {
    getPage(page) {
        return fetch("/TaskManager/public/Task/get", {
            method: "POST",
            body: JSON.stringify({page})
        }).then(res => res.json());
    },
    get pageNumber() {
        return pageNumber;
    },
    pageNext() {
        pageNumber++;
    },
    pagePrev() {
        pageNumber--;
    }
};

export default pagination;
