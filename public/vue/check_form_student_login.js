const checkForm = new Vue({
    el: "#formLogin",
    data: {
        account: null,
        password: null,
        errors: {
            account: null,
            password: null
        }
    },
    methods: {
        checkForm: function (e) {
            let dem = 0;
            if (!this.account) {
                this.errors.account = "*Vui lòng nhập account";
                dem++;
            }
            else {
                this.errors.account = '';
            }

            if (!this.password) {
                this.errors.password = "*Vui lòng nhập password";
                dem++;
            }
            else if (!this.valiPassword(this.password)) {
                this.errors.password = "*Password mặc định là từ 1->6";
                dem++;
            }
            else {
                this.errors.password = "";
            }

            if (dem > 0) {
                e.preventDefault();
            }
        },
        valiPassword: function (password) {
            let re = /^[1-6]{6}$/;
            return re.test(password);
        }
    }
})
