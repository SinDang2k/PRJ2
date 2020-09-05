<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Admin

Route::group(['prefix' => 'admin'], function () {
    //check xem nếu không có session thì mới vào login còn nếu có session thì không vào login nữa
    Route::group(['middleware' => ['CheckSession']], function () {
        Route::get('login', 'AdminController@getLogin')->name('admin.getLogin');
        Route::post('login', 'AdminController@postLogin')->name('admin.postLogin');
        Route::view('forgot-password', 'admin.forgot_password')->name('forgot_password');

        route::post('check-exist-email-admin','ForgotPassword@check_exist_email_admin')
        ->name('check_exist_email_admin');

        route::post('send-email-forgot-password','ForgotPassword@send_email_forgot_password')
        ->name('send_email_forgot_password');

        route::get('view-change-password/{token}','ForgotPassword@change_password')->name('change_password');

        route::view('send-mail-success','mail.success')->name('mail.success');

        route::post('change-password/{token}','ForgotPassword@process_change_password')
        ->name('process_change_password');
    });
    Route::get('logout', 'AdminController@getLogout')->name('admin.getLogout');
});


Route::group(['middleware' => 'CheckLogin'], function () {

    Route::get('/', 'Controller@index')->name('dashboard');

    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'department'], function () {
            Route::get('/', 'DepartmentController@view_all')->name('department.view_all');
            Route::get('view-insert', 'DepartmentController@view_insert')->name('department.view_insert');
            Route::match(['get', 'post'], 'process-insert', 'DepartmentController@process_insert')->name('department.process_insert');

            Route::get('view-update/{id}', 'DepartmentController@view_update')->name('department.view_update');
            Route::post('process-update/{id}', 'DepartmentController@process_update')->name('department.process_update');
            Route::get('delete/{id}', 'DepartmentController@delete')->name('department.delete');

            Route::match(['get', 'post'], 'del', 'DepartmentController@del')->name('department.del');
        });

        Route::group(['prefix' => 'course'], function () {
            Route::get('/', 'CourseController@view_all')->name('course.view_all');
            Route::get('view-insert', 'CourseController@view_insert')->name('course.view_insert');
            Route::match(['get', 'post'], 'process-insert', 'CourseController@process_insert')->name('course.process_insert');

            Route::get('view-update/{id}', 'CourseController@view_update')->name('course.view_update');
            Route::post('process-update/{id}', 'CourseController@process_update')->name('course.process_update');
            Route::get('delete/{id}', 'CourseController@delete')->name('course.delete');
            Route::match(['get', 'post'], 'del', 'CourseController@del')->name('course.del');
        });

        Route::group(['prefix' => 'classes'], function () {
            Route::get('/', 'ClassesController@view_all')->name('classes.view_all');
            Route::get('view-insert', 'ClassesController@view_insert')->name('classes.view_insert');
            Route::match(['get', 'post'], 'process-insert', 'ClassesController@process_insert')->name('classes.process_insert');

            Route::get('view-update/{id}', 'ClassesController@view_update')->name('classes.view_update');
            Route::post('process-update/{id}', 'ClassesController@process_update')->name('classes.process_update');
            Route::get('delete/{id}', 'ClassesController@delete')->name('classes.delete');
            Route::match(['get', 'post'], 'del', 'ClassesController@del')->name('classes.del');
        });

        Route::group(['prefix' => 'subject'], function () {
            Route::get('/', 'SubjectController@view_all')->name('subject.view_all');
            Route::get('view-insert', 'SubjectController@view_insert')->name('subject.view_insert');
            Route::match(['get', 'post'], 'process-insert', 'SubjectController@process_insert')->name('subject.process_insert');

            Route::get('view-update/{id}', 'SubjectController@view_update')->name('subject.view_update');
            Route::post('process-update/{id}', 'SubjectController@process_update')->name('subject.process_update');
            Route::get('delete/{id}', 'SubjectController@delete')->name('subject.delete');
            Route::match(['get', 'post'], 'del', 'SubjectController@del')->name('subject.del');
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'profileController@index')->name('profile.my_profile');
            Route::post('changeProfile', 'profileController@changeProfile');
            Route::post('changePassword', 'profileController@changePassword');
        });

        Route::group(['prefix' => 'student'], function () {
            Route::get('/', 'StudentController@view_all')->name('student.view_all');
            Route::get('view-insert', 'StudentController@view_insert')->name('student.view_insert');
            Route::match(['get', 'post'], 'process-insert', 'StudentController@process_insert')->name('student.process_insert');

            Route::get('view-update/{id}', 'StudentController@view_update')->name('student.view_update');
            Route::post('process_update/{id}', 'StudentController@process_update')->name('student.process_update');
            Route::get('delete/{id}', 'StudentController@delete')->name('student.delete');

            Route::get('show', 'StudentController@show')->name('student.show');

            Route::get('add-students', 'StudentController@view_add_students');
            Route::match(['get', 'post'], 'process-add-students', 'StudentController@process_add_students')
                ->name('student.process-add-students');

            Route::get('view_import_excel', 'StudentController@view_import_excel')->name('student.view_import_excel');
            Route::post('process_import_excel', 'StudentController@process_import_excel')->name('student.process_import_excel');
            route::get('excel-student-by-class','StudentController@get_excel_student_by_class')->name('student.get_excel_student_by_class');
            route::get('excel-student-by-department','StudentController@get_excel_student_by_department')->name('student.get_excel_student_by_department');
            Route::get('view_import_excel_year_begin', 'StudentController@view_import_excel_year_begin')->name('student.view_import_excel_year_begin');
            Route::post('process_import_excel_year_begin', 'StudentController@process_import_excel_year_begin')->name('student.process_import_excel_year_begin');

            Route::match(['get', 'post'], 'del', 'StudentController@del')->name('student.del');
        });

        Route::group(['prefix' => 'teacher'], function () {
            Route::view('dashboard', 'teacher.index')->name('teacher.dashboard');

            Route::get('/', 'TeacherController@view_all')->name('teacher.view_all');
            Route::get('view-insert', 'TeacherController@view_insert')->name('teacher.view_insert');
            Route::match(['get', 'post'], 'process_insert', 'TeacherController@process_insert')->name('teacher.process_insert');

            Route::get('view-update/{id}', 'TeacherController@view_update')->name('teacher.view_update');
            Route::post('process-update/{id}', 'TeacherController@process_update')->name('teacher.process_update');
            Route::get('delete/{id}', 'TeacherController@delete')->name('teacher.delete');

            Route::get('show', 'TeacherController@show')->name('teacher.show');

            Route::match(['get', 'post'], 'del', 'TeacherController@del')->name('teacher.del');

            route::get('lock-teacher-account/{id}','TeacherController@lock_teacher_account')->name('teacher.lock_teacher_account');
            route::get('open-teacher-account/{id}','TeacherController@open_teacher_account')->name('teacher.open_teacher_account');
        });


        Route::group(['prefix' => 'assignment'], function () {
            Route::get('view-insert', 'AssignmentController@view_insert')->name('assignment.view_insert');
            Route::match(['get', 'post'], 'process-insert', 'AssignmentController@process_insert')->name('assignment.process_insert');
            Route::get('get-subject', 'AssignmentController@get_subject')->name('assignment.get_subject');
            Route::get('get-class', 'AssignmentController@get_class')->name('assignment.get_classes');
            Route::get('', 'AssignmentController@view_all')->name('assignment.view_all');

            Route::get('view-update/{id}', 'AssignmentController@view_update')->name('assignment.view_update');
            Route::match(['get', 'post'], 'process-update/{id}', 'AssignmentController@process_update')->name('assignment.process_update');
        });

        Route::group(['prefix' => 'point'], function () {
            Route::get('view-insert', 'PointController@view_insert')->name('point.view_insert');
            Route::post('process-insert', 'PointController@process_insert')->name('point.process_insert');
            Route::get('get-student', 'PointController@get_student')->name('point.get_student');
            Route::get('get-class', 'PointController@get_class')->name('point.get_classes');

            Route::get('get-classs', 'PointController@get_classs')->name('point.get_classess');

            Route::post('update', 'PointController@update')->name('point.update');

            Route::get('view-update', 'PointController@view_update')->name('point.view_update');
        });

        Route::group(['prefix' => 'rollcall'], function () {
            route::get('/','RollcallController@view_history')->name('rollcall.view_history');

            route::get('get-subject-by-class','RollcallController@get_subject_by_class')
            ->name('rollcall.get_subject_by_class');

            route::get('get-student-attendance-history','RollcallController@get_student_attendance_history')
            ->name('rollcall.get_student_attendance_history');
        });

    });
});


// Teacher
Route::group(['prefix' => 'teacher'], function () {
    Route::group(['middleware' => ['CheckTeacherSession']], function () {
        Route::get('login', 'TeacherController@getLogin')->name('teacher.getLogin');
        Route::post('login', 'TeacherController@postLogin')->name('teacher.postLogin');

        route::view('forgot-password','teacher.forgot_password')->name('teacher.forgot_password');

        route::post('send-email-forgot-password','ForgotPassword@send_email_forgot_password_teacher')
        ->name('teacher.send_email_forgot_password_teacher');

        route::post('check-exist-email-teacher','ForgotPassword@check_exist_email_teacher')
        ->name('teacher.check_exist_email_teacher');

        route::get('change_password/{token}','ForgotPassword@change_password_teacher')
        ->name('teacher.change_password');

        route::post('process-change-password/{token}','ForgotPassword@process_change_password_teacher')
        ->name('teacher.process_change_password');
    });
    Route::get('logout', 'TeacherController@getLogout')->name('teacher.getLogout');

    Route::group(['middleware' => 'CheckTeacherLogin'], function () {
        Route::view('dashboard', 'teacher.index')->name('teacher.dashboard');

        Route::group(['prefix' => 'student'], function () {
            // teacher sẽ chỉ được phép xem sinh viên của lớp mình đã dạy
            Route::get('/', 'StudentController@view_all')->name('teacher.student.view_all');
        });

        Route::group(['prefix' => 'roll-call'], function () {
            Route::get('', 'RollcallController@view_insert')->name('teacher.rollcall.view_insert');

            Route::get('get-student', 'RollcallController@get_student')->name('teacher.rollcall.get_student');

            Route::get('get-subject', 'RollcallController@get_subject')->name('teacher.rollcall.get_subject');

            Route::post('process_insert', 'RollcallController@process_insert')->name('teacher.rollcall.process_insert');

            route::get('view-history-for-teacher','RollcallController@view_history_for_teacher')->name('teacher.rollcall.view_history_for_teacher');

            route::get('get-subject-by-class','RollcallController@get_subject_by_class')
            ->name('rollcall.get_subject_by_class_for_teacher');

            route::get('get-student-attendance-history','RollcallController@get_student_attendance_history')
            ->name('rollcall.get_student_attendance_history_for_teacher');
        });
    });
});

//STUDENT
Route::group(['prefix' => 'student'], function () {
    Route::group(['middleware' => ['CheckStudentSession']], function () {
        Route::view('login', 'student.view_login')->name('student.view_login');
        Route::post('login', 'StudentController@process_login')->name('student.process_login');
    });
    Route::get('logout', 'StudentController@getLogout')->name('student.getLogout');


    Route::group(['middleware' => 'CheckStudentLogin'], function () {
        Route::view('dashboard', 'student.index')->name('student.dashboard');
        Route::get('info-student/{id}', 'StudentController@info_student')->name('student.info_student');
        Route::get('info-point-student/{id}', 'StudentController@info_point_student')->name('student.info_point_student');

        Route::match(['get', 'post'], 'update_info_student/{id}', 'StudentController@update_info_student')->name('student.update_info_student');
    });
});

route::get('thuan',function(){
    DB::table('admin')->insert([
        'full_name' => 'Nguyễn Hoàng Thắng Thuận',
        'email' => 'thuanvp012van@gmail.com',
        'password' => bcrypt('thuanvp012'),
        'avatar' => '',
        'phone' => '0988129104',
        'address' => 'Hà Nội',
        'gender' => 1,
    ]);
});
Route::get('anh', function () {
    DB::table('admin')->insert([
        'full_name' => 'Nguyễn Đức Anh',
        'email' => 'kelvinanh69@gmail.com',
        'password' => bcrypt('Leeminhoo123'),
        'avatar' => '',
        'phone' => '0904842648',
        'address' => 'Hà Nội',
        'gender' => 1,
    ]);
});


Route::group(['prefix' => 'ui-elements'], function () {
    Route::view('buttons', 'ui-elements.buttons')->name('ui-elements.buttons');
    Route::view('grids', 'ui-elements.grids')->name('ui-elements.grids');
    Route::view('tabs', 'ui-elements.tabs')->name('ui-elements.tabs');
    Route::view('maps', 'ui-elements.maps')->name('ui-elements.maps');
});
