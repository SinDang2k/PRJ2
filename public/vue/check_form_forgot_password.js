const a = new Vue({
    el: "#register-form",
    data: {
        email: null,
        error: null,
        res_data: ''
    },
    methods: {
        checkForm: function (e) {
            if (!this.email) {
                this.error = "*Vui lòng nhập email";
                e.preventDefault();
            }
            else if (!this.valiEmail(this.email)) {
                this.error = "*Bạn nhập sai email";
                e.preventDefault();
            }
            else {
                this.error = "";
            }
        },
        valiEmail: function (email) {
            let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1, 3}\.[0-9]{1, 3}\.[0-9]{1, 3}\.[0-9]{1, 3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
    }
})
