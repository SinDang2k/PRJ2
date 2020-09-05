new Vue({
    el: "#account",
    data: {
        password: "",
        confirmPassword: "",
        errors: {
            password: "abc",
            confirmPassword: "abc",
        },
        visibility: "hidden",
    },
    methods: {
        changePassword() {
            let re_password = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            let dem = 0;
            if (!this.password) {
                this.errors.password = "*Mật khẩu không được để trống";
                this.visibility = "initial";
                dem++;
            } else if (re_password.test(this.password) == false) {
                this.errors.password =
                    "*Tối thiểu tám kí tự và có ít nhất 1 số";
                this.visibility = "initial";
                dem++;
            } else {
                this.errors.password = "";
            }

            if (!this.confirmPassword) {
                this.errors.confirmPassword = "*Phải nhập lại mật khẩu";
                this.visibility = "initial";
                dem++;
            } else if (this.password != this.confirmPassword) {
                this.errors.confirmPassword = "*Không trùng khớp mới mật khẩu";
                this.visibility = "initial";
                dem++;
            } else {
                this.errors.confirmPassword = "";
            }

            if (dem == 0) {
                axios
                    .post("profile/changePassword", {
                        password: this.password,
                    })
                    .then((res) => {
                        this.sucess("Đổi mật khẩu thành công !!!");
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            }
        },
        sucess(title) {
            const Toast = Swal.mixin({
                position: "mid",
                timer: 700,
                timerProgressBar: true,
                showConfirmButton: false,
                onOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            });
            Toast.fire({
                icon: "success",
                title: title,
            });
        },
    },
});
