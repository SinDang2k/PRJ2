const checkForm = new Vue({
    el: "#formLogin",
    data: {
        email: null,
        password: null,
        errors: {
            email: null,
            password: null
        }
    },
    methods: {
        checkForm: function (e) {
            let dem = 0;
            if (!this.email) {
                this.errors.email = "*Vui lòng nhập email";
                dem++;
            }
            else if (!this.valiEmail(this.email)) {
                this.errors.email = "*Bạn nhập sai email";
                dem++;
            } else {
                this.errors.email = '';
            }

            if (!this.password) {
                this.errors.password = "*Vui lòng nhập password";
                dem++;
            }
            else if (!this.valiPassword(this.password)) {
                this.errors.password = "*Tối thiểu tám kí tự và có ít nhất 1 số";
                dem++;
            }
            else {
                this.errors.password = "";
            }

            if (dem > 0) {
                e.preventDefault();
            }
        },
        valiEmail: function (email) {
            let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1, 3}\.[0-9]{1, 3}\.[0-9]{1, 3}\.[0-9]{1, 3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        valiPassword: function (password) {
            let re = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            return re.test(password);
        }
    }
})
