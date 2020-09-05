@extends('layouts.master')
@section('master')
<link rel="stylesheet" href="{{asset('public/css/profile.css')}}">
<div id="wrapper" class="wrapper bg-ash">
    <!-- Header Menu Area Start Here -->
    @include('layouts.navbar')
    <!-- Header Menu Area End Here -->
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        @include('layouts.sidebar')
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <div id='settings' ontouchstart>
                <input checked class='nav' name='nav' type='radio'>
                <span class='nav'>Thông tin cá nhân</span>
                <input class='nav' name='nav' type='radio'>
                <span class='nav'>Đổi mật khẩu</span>
                <main class='content'>
                    <section id='profile'>
                        <form id="app">
                            <ul>
                                <li class='large padding avatar'>
                                    <img :src="avatar" style="width: 72px;height: 72px;" alt="">
                                    <div>
                                        <fieldset class='material-button'>
                                            <div>
                                                <label id="select_image" for="image">Đổi hình đại diện</label><span>
                                                    @{{ errors.avatar }}</span>
                                                <input @change="processFile" type="file" style="display: none"
                                                    id="image">
                                            </div>
                                        </fieldset>
                                    </div>
                                </li>
                                <li>
                                    <fieldset class='material'>
                                        <div>
                                            <input v-model="full_name" required type='text' value="ádaasd">
                                            <label>Họ và tên <span>@{{ errors.full_name }}</span></label>
                                            <hr>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset class='material'>
                                        <div>
                                            <input v-model="address" required type='text'>
                                            <label>Địa chỉ <span>@{{ errors.address }}</span></label>
                                            <hr>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset class='material'>
                                        <div>
                                            <input v-model="phone" required type='text'>
                                            <label>Số điện thoại <span>@{{ errors.phone }}</span></label>
                                            <hr>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class='large'>
                                    <fieldset class='material'>
                                        <div>
                                            <span style="color: #cd908b">Giới tính</span><br>
                                            <select style="padding: 5px;border: none;background: #cd908b;color:white"
                                                v-model="gender">
                                                <option @if ($admin->gender==1)
                                                    selected
                                                    @endif value="1">Nam</option>
                                                <option @if ($admin->gender==0)
                                                    selected
                                                    @endif value="0">Nữ</option>
                                            </select>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class='large padding'>
                                    <fieldset class='material-button center'>
                                        <div>
                                            <input v-on:click="changeProfile" class='save' type='button' value='Save'>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </form>
                    </section>
                    <section id='account'>
                        <form>
                            <ul>
                                <li>
                                    <fieldset class='material'>
                                        <div>
                                            <input v-model="password" required type='password'>
                                            <label>Password</label>
                                            <hr>
                                        </div>
                                    </fieldset>
                                    <p :style={visibility}>@{{ errors.password }}</p>
                                </li>
                                <li>
                                    <fieldset class='material'>
                                        <div>
                                            <input v-model="confirmPassword" required type='password'>
                                            <label>Confirm Password</label>
                                            <hr>
                                        </div>
                                    </fieldset>
                                    <p :style={visibility}>@{{ errors.confirmPassword }}</p>
                                </li>
                                <li style="margin-top: 50px" class='large padding'>
                                    <fieldset class='material-button center'>
                                        <div>
                                            <input @click="changePassword" class='save' type='button' value='Save'>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </form>
                    </section>
                </main>
            </div>
        </div>
    </div>
    <!-- Page Area End Here -->
</div>
<script>
    const checkProfile= new Vue({
        el:"#app",
        data:{
            full_name:<?php echo "'".$admin->full_name."'"; ?>,
            address:<?php echo "'".$admin->address."'"; ?>,
            phone:<?php echo "'".$admin->phone."'"; ?>,
            gender:<?php echo "'".$admin->gender."'"; ?>,
            avatar:<?php echo "'".$avatar."'"; ?>,
            errors:{
              full_name:'',
              address:'',
              phone:'',
              avatar:'',
            },
            myFile:'',
        },
        methods:{
            changeProfile:function(){
                let re_phone=/((09|03|07|08|05)+([0-9]{8})\b)/g;
                let re_name=/^[A-Za-z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ]{2,50}$/;
                let re_address=/^[A-Za-z0-9\s\-\,\.\_\\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ]{5,200}$/;
                let dem=0;
                //img
                if(this.myFile!='')
                {
                    let typeAllow=['JPG','GIF','PNG','JPEG','TIFF'];
                    let ext=this.myFile.name.split('.').pop().toUpperCase();
                    if(!typeAllow.includes(ext))
                    {
                        this.errors.avatar="*Đây không phải là file ảnh";
                        dem++;
                    }
                    else{
                        this.errors.avatar="";
                    }
                }
                //phone
                if(!this.phone)
                {
                    this.errors.phone="*Số điện thoại không được để trống";
                    dem++;
                }
                else if(re_phone.test(this.phone)==false)
                {
                    this.errors.phone="*Đây không phải là số điện thoại";
                    dem++;
                }
                else{
                    this.errors.phone="";
                }
                //name
                if(!this.full_name)
                {
                    this.errors.full_name="*Tên không được để trống";
                    dem++;
                }
                else if(re_name.test(this.full_name)==false)
                {
                    this.errors.full_name="*Đây không phải là tên người";
                    dem++;
                }
                else{
                    this.errors.full_name='';
                }
                //address
                if(!this.address)
                {
                    this.errors.address="*Không được bỏ trống địa chỉ";
                    dem++;
                }
                else if(re_address.test(this.address)==false){
                    this.errors.address="*Đây không phải là địa chỉ";
                    dem++;
                }
                else{
                    this.errors.address='';
                }

                if(dem==0)
                {
                    var formData = new FormData();
                    var imagefile = this.myFile;
                    formData.append("image", imagefile);
                    formData.append("full_name",this.full_name);
                    formData.append("phone",this.phone);
                    formData.append("address",this.address);
                    formData.append("gender",this.gender);
                    axios.post('profile/changeProfile', formData, {
                        headers: {
                        'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(res => {
                        //check nếu người dùng không chọn ảnh thì không đổi src của ảnh
                        if(res.data!='')
                        {
                            //getAvartar lấy bên getProfile
                            if(res.data.avatar!='')
                            {
                                this.avatar=res.data.avatar;
                                myProfile.getAvatar().src=res.data.avatar;
                                //nếu thay đổi url thì phải vào profileController
                            }
                            myProfile.getName().textContent=res.data.full_name;
                            this.sucess('Đổi thông tin thành công !!!');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                    })
                    }
            },
            processFile:function(event)
            {
                this.myFile=event.target.files[0];
            },
            sucess(title){
                const Toast = Swal.mixin({
                position: 'mid',
                timer: 700,
                timerProgressBar: true,
                showConfirmButton:false,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                Toast.fire({
                icon: 'success',
                title: title
                })
            }
        }
    });
</script>
<script src="{{asset('public/js/changePassword.js')}}"></script>
@endsection
