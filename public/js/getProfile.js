var myProfile = new Vue({
    el: "#myProfile",
    methods: {
        getName: function () {
            return this.$refs.myName;
        },
        getAvatar() {
            return this.$refs.myPicture;
        }
    }
});
