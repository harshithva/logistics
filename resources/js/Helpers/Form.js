export default class Form {
    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        // this.errors = new Errors();
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = "";
        }
    }

    data() {
        let data = Object.assign({}, this)
        delete data.originalData;
        delete data.errors;
        return data;
    }
    submit(requestType, url) {
        axios[requestType](url, this.data())
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }

    onSuccess(response) {
        alert("Success")
        this.errors.clear();
    }

    onFail(errors) {
        console.log(errors.response.data.errors);

        this.errors.record(errors.response.data.errors)
    }
}

