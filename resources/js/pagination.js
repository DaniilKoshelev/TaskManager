let pageNumber = 0;
let isProcessing = false;

const pagination = {
    getPage(page, sort) {
        if (isProcessing) return;
        isProcessing = true;
        return fetch("/TaskManager/public/Task/get", {
            method: "POST",
            body: JSON.stringify({page, sort})
        }).then(res => {isProcessing = false; return res.json();});
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
