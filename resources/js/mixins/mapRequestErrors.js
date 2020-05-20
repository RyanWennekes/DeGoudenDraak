export default {
    data() {
        return {
            failedRequestResult: null,
            loading: false,
        };
    },
    computed: {
        requestErrors() {
            if (!this.failedRequestResult || !this.failedRequestResult.response)
                return {};

            let errors = this.failedRequestResult.response.data.errors;

            // Return key with first error instead the array with every error
            return Object.keys(errors).reduce((map, key) => ({
                ...map,
                [key]: errors[key][0],
            }), {});
        },
    },
    methods: {
        // If there is a error, then return string, else return boolean
        rules(name) {
            return !this.requestErrors[name] || this.requestErrors[name];
        },
    },
};
