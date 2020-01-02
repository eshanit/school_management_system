<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/accountcreated', 'HomeController@loggedin')->name('loggedin');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

///
Route::get('/admin', 'Admin\AdminController@index')->name('admin.home');
   /// students registration
    
   Route::resource('student', 'Students\StudentsController', ['parameters' => [
    'student' => 'id'
]]);

Route::get('/student/delete/{id}', 'Students\StudentsController@delete')->name('student.delete');

Route::get('/student/undelete/{id}', 'Students\StudentsController@undelete')->name('student.undelete');

 // students class allocation
 Route::resource('studentclass', 'Students\StudentsClassController', ['parameters' => [
    'studentclass' => 'id'
]]);

// teacher clerk
Route::resource('clerk/calender', 'Clerk\CalenderController', ['parameters' => [
    'calender' => 'id'
]]);


// teacher clerk
Route::resource('clerk/teachers', 'Clerk\TeacherController', ['parameters' => [
    'clerk_teacher' => 'id'
]]);

// teacher class allocation
Route::resource('clerk/teacher_class', 'Clerk\TeacherClassController', ['parameters' => [
    'clerk_class_teacher' => 'id'
]]);

// Allocate class to teacher who doesnt have a class but is a registered teacher
Route::get('clerk/teacher_class/{teacher_class}', 'Clerk\TeacherClassController@storeteacherclass')->name('teacher_class.storeteacher');

// Reset teacher's class

Route::get('clerk/teacher_class/reset/{teacher_class}', 'Clerk\TeacherClassController@classreset')->name('teacher_class.classreset');

// Delete teacher


Route::get('clerk/teacher/delete/{id}', 'Clerk\TeacherClassController@delete')->name('teacher_class.delete');

///teachers

   
Route::resource('teacher', 'Teachers\TeachersController', ['parameters' => [
    'teacher' => 'id'
]]);

Route::resource('class_teacher', 'Teachers\TeacherClassController', ['parameters' => [
    'class_teacher' => 'id'
]]);


//vew marks form
Route::resource('teachermarksview', 'Marks\ViewMarksController', ['parameters' => [
    'teachermarksview' => 'id'
]]);

//vew entering marks form
Route::resource('teachermarksenter', 'Marks\EnterMarksController', ['parameters' => [
    'teachermarksenter' => 'id'
]]);




Route::post('teacher/viewmarks/{teacher_id}', 'Marks\ViewMarksController@show_view')->name('teachermarksenter.viewmarks');


Route::post('teacher/entermarks', 'Marks\EnterMarksController@show_enter')->name('teachermarksenter.entermarks');

//vew schedule
Route::resource('markschedule', 'Marks\MarkScheduleController', ['parameters' => [
    'markschedule' => 'id'
]]);

Route::post('teacher/markschedule', 'Marks\MarkScheduleController@markschedule')->name('teacher.markschedule');

//vew schedule
Route::resource('student/report_card', 'Students\ReportsController', ['parameters' => [
    'report_card' => 'id'
]]);

//view reportcard
Route::get('student/report_card/{year}/{term_id}/{schoolclass_id}/{student_id}', 'Students\ReportsController@student_report')->name('report.student');

//view Attendance
Route::get('teacher/attendance/{term_id}/{schoolclass_id}/', 'Students\AttendanceController@student_attendance')->name('attendance.index');

//vew Attendace
Route::resource('attendance/student_attendance', 'Students\AttendanceController', ['parameters' => [
    'student_attendance' => 'id'
]]);


//head and deputy

Route::resource('management', 'Management\ManagementController', ['parameters' => [
    'management' => 'id'
]]);

//roles/admin

Route::resource('admin/role', 'Admin\RoleController', ['parameters' => [
    'role' => 'id'
]]);

Route::resource('adminclass', 'Admin\ClassController', ['parameters' => [
    'adminclass' => 'id'
]]);

Route::resource('adminsubject', 'Admin\SubjectController', ['parameters' => [
    'adminsubject' => 'id'
]]);

Route::resource('adminroleuser', 'Admin\UserRoleController', ['parameters' => [
    'adminroleuser' => 'id'
]]);

//allocate subject to class
Route::resource('subjectclass', 'Teachers\SubjectClassController', ['parameters' => [
    'subjectclass' => 'id'
]]);


// Delete class subject


Route::get('class_teacher/teacher/class/subject/delete/{id}', 'Teachers\SubjectClassController@delete')->name('teacher_subjectclass.delete');



///dis

Route::resource('dis/dis_teachers', 'DIS\TeacherController', ['parameters' => [
    'dis_teachers' => 'id'
]]);

Route::resource('dis/dis_students', 'DIS\StudentController', ['parameters' => [
    'dis_students' => 'id'
]]);

// teacher clerk
Route::resource('dis/dis_calendar', 'DIS\CalendarController', ['parameters' => [
    'dis_calendar' => 'id'
]]);

   
Route::resource('dis', 'DIS\InspectorController', ['parameters' => [
    'dis' => 'id'
]]);

Route::resource('schools', 'DIS\SchoolController', ['parameters' => [
    'schools' => 'id'
]]);


///teacher attendance (Clerk)

Route::resource('attendance/teacher_attendance', 'Clerk\TeacherAttendanceController', ['parameters' => [
    'teacher_attendance' => 'id'
]]);


///teacher attendance (DIS)

Route::resource('attendance/dis_teacher_attendance', 'DIS\TeacherAttendanceController', ['parameters' => [
    'dis_teacher_attendance' => 'id'
]]);
