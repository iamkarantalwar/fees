<?php



Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/', 'admin@index')->name('admin.dashboard');
Route::resource('admin/context', 'Cotext',
[
   'names'=>[
        'index'     =>'admin.context.index',
        'create'    =>'admin.context.create',
        'store'     =>'admin.context.store',
        'edit'      =>'admin.context.edit',
        'destroy'   =>'admin.context.destroy',
        'update'    =>'admin.context.update',
    ]
]);
Route::resource('admin/course', 'CourseController',
[
   'names'=>[
        'index'     =>'admin.course.index',
        'create'    =>'admin.course.create',
        'store'     =>'admin.course.store',
        'edit'      =>'admin.course.edit',
        'destroy'   =>'admin.course.destroy',
        'update'    =>'admin.course.update'
        
    ]
]);
Route::resource('admin/enquiry', 'EnquiryController',
[
   'names'=>[
        'index'     =>'admin.enquiry.index',
        'create'    =>'admin.enquiry.create',
        'store'     =>'admin.enquiry.store',
        'edit'      =>'admin.enquiry.edit',
        'destroy'   =>'admin.enquiry.destroy',
        'update'    =>'admin.enquiry.update',
        'show'      =>'admin.enquiry.show',
       
    ]
]);
Route::resource('admin/registration', 'RegistrationController',
[
   'names'=>[
        'index'     =>'admin.registration.index',
        'create'    =>'admin.registration.create',
        'store'     =>'admin.registration.store',
        'edit'      =>'admin.registration.edit',
        'destroy'   =>'admin.registration.destroy',
        'update'    =>'admin.registration.update',
        'show'      =>'admin.registration.show',
       
    ]
]);
Route::resource('admin/calling', 'CallingController',
[
   'names'=>[
        'index'     =>'admin.calling.index',
        'create'    =>'admin.calling.create',
        'store'     =>'admin.calling.store',
        'edit'      =>'admin.calling.edit',
        'destroy'   =>'admin.calling.destroy',
        'update'    =>'admin.calling.update',
        'show'      =>'admin.calling.show',
       
    ]
]);
Route::resource('admin/fee', 'FeeController',
[
   'names'=>[
        'index'     =>'admin.fee.index',
        'create'    =>'admin.fee.create',
        'store'     =>'admin.fee.store',
        'edit'      =>'admin.fee.edit',
        'destroy'   =>'admin.fee.destroy',
        'update'    =>'admin.fee.update',
        'show'      =>'admin.fee.show',
       
    ]
]);

Route::resource('admin/college', 'CollegeController',
[
   'names'=>[
        'index'     =>'admin.college.index',
        'create'    =>'admin.college.create',
        'store'     =>'admin.college.store',
        'edit'      =>'admin.college.edit',
        'destroy'   =>'admin.college.destroy',
        'update'    =>'admin.college.update',
        'show'      =>'admin.college.show',
       
    ]
]);

Route::resource('admin/passwordverification','PasswordVerificationController',[

    'names'=>[
        'index'     =>'admin.password.check',
        'store'     =>'admin.password.checkauth',
    ]
]);
Route::get('excel/','ExcelController@enquiryListWithCalls')->name('excel.enquiryListWithCalls');







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



