@extends('layouts.master')
@section('master')
<link rel="stylesheet" href="{{asset('public/css/insert_students.css')}}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
            <div class="table-responsive">
                <form method="POST" action="{{ route('student.process-add-students') }}" enctype="multipart/form-data">
                    <table id="table" class="table display data-table text-nowrap">
                        @csrf
                        <input type="hidden" value="" v-model="student_number" name="student_number">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">Lớp</label>
                                    </div>
                                </th>
                                <th>Họ và tên</th>
                                <th>Ảnh</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index ) in items" :key="index">
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label"><select name="classes_id[]">
                                                @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">
                                                    {{ $class->full_name_class }}
                                                </option>
                                                @endforeach
                                            </select></label>
                                    </div>
                                </td>
                                <td><input type="text" name="student_name[]"></td>
                                <td><input :id="index" name="images[]" type="file" @change="onFileChange(index,$event)">
                                    <label :for="index"><img style="width: 31px;height: 31px;" :src='item.src'
                                            alt=""></label>
                                </td>
                                <td><input type="email" name="email[]"></td>
                                <td><input type="text" name="phone[]"></td>
                                <td><select name="gender[]">
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select></td>
                                <td><input type="date" name="birthday[]"></td>
                                <td><input type="text" name="address[]"></td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <button type="submit" class="btn btn-primary  btn-lg">submit</button>
                    </table>
                </form>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    <!-- Page Area End Here -->
</div>
<script>
    const vm = new Vue({
    el: '#table',
    data: {
        url: null,
        items:[
            {
                ten:'',
                src:''
            },
        ],
        student_number:''
    },
    methods: {
        //index là lấy index của thằng input file nhưng vì chỉ số  index của input file trùng với index của img lên dùng luôn
        onFileChange(index,files) {
            const file = files.target.files[0];
            this.items[index].src = URL.createObjectURL(file);
            files.currentTarget.style.display="none";
        },
        add_students(number){
            this.items=[{ten:'',src:''}];
            for(var i=0;i<number-1;i++)
            {
                let obj={ten:'',src:''};
                this.items.push(obj);
            }
        }
    }
});

    (async () => {
        const { value: sv } = await Swal.fire({
        title: 'Nhập số sinh viên muốn thêm',
        input: 'number',
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
            return 'Bạn cần phải nhập số sinh viên'
            }
            else
            {
                vm.add_students(value);
                vm.student_number=value;
            }
        }
    })
    })()
</script>
@endsection
