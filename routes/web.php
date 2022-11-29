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

//====================> comman controller and function================
Route::group(['middleware' => 'preventBackHistory'],function(){
   
    
    Route::get('siteIsUnderConstruction',
        static function(){
        return view('underMaintenance');
    })->name('underMaintenance');
     Route::group(
        [
        'middleware'    => ['UnderMaintenance']
    ],static function(){

//====================> Front Panel =========================
    Route::get('/', 'HomeController@index')->name('front.index');
   

    Route::get('about_us', 'HomeController@about')->name('front.about');
    Route::get('contact_us', 'HomeController@contact')->name('front.contact');
    Route::get('privacy_policy', 'HomeController@privacypolicy')->name('front.privacypolicy');
    Route::get('payment_terms', 'HomeController@paymentterms')->name('front.paymentterms');
    Route::get('terms_condition', 'HomeController@termscondition')->name('front.termscondition');
    Route::get('faq', 'HomeController@faq')->name('front.faq');
    Route::get('/faq/country/{id}','HomeController@faq_country')->name('front.faq_country');
    Route::get('/faq/visatype/{id}','HomeController@faq_visatype')->name('front.faq_visatype');
    Route::get('popular_destinations', 'HomeController@populardestinations')->name('front.populardestinations');
    Route::post('ContactForm','HomeController@ContactForm')->name('front.ContactForm');


    Route::post('/checkvisa','HomeController@checkvisa')->name('front.checkvisa');
    Route::get('apply_now','HomeController@apply_now')->name('front.apply_now');
    Route::get('track_your_order','HomeController@track_your_order')->name('front.track_your_order');
    Route::get('track_order','HomeController@track_order')->name('front.track_order');
    Route::get('add_on','HomeController@add_on')->name('front.add_on');

    Route::get('checkvisarequirement','HomeController@checkvisarequirement')->name('front.checkvisarequirement');
    Route::get('apply_now_form','HomeController@apply_now_form')->name('front.apply_now_form');

    // Route::get('/',function (){
    //     return view('front.welcome');
    // })->name('front.home');
    Route::get('login','Auth\LoginController@showLoginForm')->name('front.showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('front.login');
    Route::get('resetPassword','Auth\PasswordResetController@showPasswordRest')->name('front.resetPassword');
    Route::post('sendResetLinkEmail', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('front.sendResetLinkEmail');
    Route::get('find/{token}', 'Auth\PasswordResetController@find')->name('front.find');
    Route::post('create', 'Auth\PasswordResetController@create')->name('front.sendLinkToUser');
    Route::post('reset', 'Auth\PasswordResetController@reset')->name('front.resetPassword_set');
    Route::post('/user/forgot_pwd','Front\HomeController@forgot_pwd')->name('front.forgot_pwd');
    Route::post('forgotPassword_set', 'Front\UserController@forgot_pwd')->name('front.forgotPassword_set');
    Route::post('/updateProfileDetail','Front\UserController@updateProfileDetail')->name('updateProfileDetail');
    Route::post('/updatePassword','Front\UserController@updatePassword')->name('updatePassword');
    Route::post('/notification_setting','Front\UserController@notification')->name('notification_setting');
    Route::get('/login/facebook', 'HomeController@redirect');
    Route::get('/facebook/callback', 'HomeController@handleProviderFacebookCallback');
    Route::get('/login/google', 'HomeController@redirectToGoogle');
    Route::get('/google/callback', 'HomeController@handleGoogleCallback');
    Route::get('/blog','Front\BlogController@index')->name('blog');
    Route::get('/blogdetail/{id}', 'Front\BlogController@blogdetail')->name('blogdetail');

    Route::post('/check_orderstatus', 'HomeController@check_orderstatus')->name('front.check_orderstatus');
    Route::get('/sign_up/{application_id}', 'HomeController@sign_up')->name('front.sign_up');
    Route::post('/user_sign_up', 'HomeController@user_sign_up')->name('front.user_sign_up');
    Route::get('/cost_calculate', 'HomeController@cost_calculate')->name('front.cost_calculate');
    Route::get('/visa_cost_calculate', 'HomeController@visa_cost_calculate')->name('front.visa_cost_calculate');

    Route::post('/applynowform','HomeController@applynowform')->name('front.applynowform');
    Route::get('/questionform/{application_id}','HomeController@questionform')->name('front.questionform');
    Route::get('/questionformpre/{application_id}','HomeController@questionformpre')->name('front.questionformpre');
    Route::post('/submituserans','HomeController@submituserans')->name('front.submituserans');

    Route::get('/payment/{application_id}','HomeController@payment')->name('front.payment');
    Route::post('submit_payment','HomeController@submit_payment')->name('front.submit_payment');

    Route::get('/success_page','HomeController@success_page')->name('front.success_page');

    Route::group(['middleware'=>'front','prefix' => 'front','namespace' => 'Front','as' => 'front.'],function (){
        Route::get('/offer_discount','ReferController@offerdiscount')->name('offerdiscount');
        Route::get('/front-logout','UserController@logout')->name('logout');
        Route::get('/profile','UserController@profile')->name('profile');
        Route::post('/refer','ReferController@refer')->name('refer');
//        Route::get('/payment/{application_id}','UserController@payment')->name('payment');
//        Route::post('submit_payment','UserController@submit_payment')->name('submit_payment');
    });
 });
 //====================> Admin Panel =========================
    // Route::get('login','Admin\Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
    Route::get('admin/login','Admin\Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
    Route::post('admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');
    Route::get('admin/resetPassword','Admin\Auth\PasswordResetController@showPasswordRest')->name('admin.resetPassword');
    Route::post('admin/sendResetLinkEmail', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.sendResetLinkEmail');
    Route::get('admin/find/{token}', 'Admin\Auth\PasswordResetController@find')->name('admin.find');
    Route::post('admin/create', 'Admin\Auth\PasswordResetController@create')->name('admin.sendLinkToUser');
    Route::post('admin/reset', 'Admin\Auth\PasswordResetController@reset')->name('admin.resetPassword_set');
    Route::group(['prefix' => 'admin','middleware'=>'Admin','namespace' => 'Admin','as' => 'admin.'],function(){
        Route::get('/','MainController@index');
        Route::get('/dashboard','MainController@dashboard')->name('dashboard');
        Route::get('down', 'MainController@maintenancemode_down')->name('down');
        Route::get('up', 'MainController@maintenancemode_up')->name('up');
        /*Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
        Route::post('/login', 'Auth\LoginController@login');*/
        Route::get('/logout','Auth\LoginController@logout')->name('logout');

        //====================> User Management =========================
        Route::get('/user','UsersController@index')->name('index');
        Route::get('/user/create','UsersController@create')->name('create');
        Route::get('/user/edit/{id}','UsersController@edit')->name('edit');
        Route::post('/user/delete/{id}','UsersController@delete')->name('delete');
        Route::post('/user/change_status','UsersController@change_status')->name('change_status');
        Route::post('/user/store','UsersController@store')->name('store');
        Route::post('/user/update/{id}','UsersController@update')->name('update');
        Route::get('/referral','UsersController@referral_index')->name('referral_index');
        Route::post('/get_user_info_data/{id}','UsersController@get_user_info_data')->name('get_user_info_data');
        //====================> User Management =========================

        //====================> Inquiry Management =========================
        Route::get('/inquiry','UsersController@inquiry')->name('inquiry');
        Route::get('/inquiry/show','UsersController@inquiryshow')->name('inquiry.show');
        Route::post('/inquiry/delete/{id}','UsersController@inquirydelete')->name('inquiry.delete');
        //====================> Inquiry Management =========================

        //====================> Themes Management =========================
        Route::post('/themes/change_themes','UsersController@change_themes')->name('themes.change_themes');
        //====================> Themes Management =========================

        //====================> Update Admin Profile =========================
        Route::get('/profile','UsersController@updateProfile')->name('profile');
        Route::post('/updatePassword','UsersController@updatePassword')->name('updatePassword');
        Route::post('/updateProfileDetail','UsersController@updateProfileDetail')->name('updateProfileDetail');
        //====================> Update Admin Profile =========================

        //====================> Role Management =========================
        Route::resource('/role','RoleController');
        Route::get('/role/create','RoleController@create')->name('role.create');
        Route::post('/role/store','RoleController@store')->name('role.store');
        Route::get('/role/{id}/view','RoleController@view')->name('role.view');
        Route::post('/role/add/update','RoleController@addRole')->name('role.add.update');
        Route::post('/role/add/getPermissionDetail','RoleController@getPermissionDetail')->name('role.add.getPermissionDetail');
        //====================> Role Management =========================

        //====================> Country Management =========================
        Route::resource('/country','CountryController');
        Route::get('getcountry/{id}', 'CountryController@getcountry')->name('getcountry');
        Route::post('country','CountryController@store')->name('countrystore');
        Route::post('/country/store','CountryController@store')->name('country.store');
        Route::get('/country/edit/{id}','CountryController@edit')->name('country.edit');
        Route::post('/country/update/{id}','CountryController@update')->name('country.update');
        Route::post('/country/change_status','CountryController@change_status')->name('country.change_status');
        //====================> Country Management =========================

        //====================> Visa Type Management =========================
        Route::get('/visatypes','VisaTypeController@index')->name('visa_types.index');
        Route::get('/visatypes/create','VisaTypeController@create')->name('visa_types.create');
        Route::get('/visatypes/edit/{id}','VisaTypeController@edit')->name('visa_types.edit');
        Route::post('/visatypes/delete/{id}','VisaTypeController@delete')->name('visa_types.delete');
        Route::post('/visatypes/change_status','VisaTypeController@change_status')->name('visa_types.change_status');
        Route::post('/visatypes/store','VisaTypeController@store')->name('visa_types.store');
        Route::post('/visatypes/update/{id}','VisaTypeController@update')->name('visa_types.update');
        //====================> Visa Type Management =========================

        //====================> Embassy Management =========================
        Route::resource('/embassy','EmbassyController');
        Route::get('/embassy/edit/{id}','EmbassyController@edit')->name('embassy.edit');
        Route::post('/embassy/embassy_change_status','EmbassyController@embassy_change_status')->name('embassy_change_status');
        Route::get('/embassy/ShowEmbassy/{id}','EmbassyController@ShowEmbassy')->name('embassy.ShowEmbassy');
        Route::get('/embassy/create','EmbassyController@create')->name('embassy.create');
        Route::post('/embassy/store','EmbassyController@store')->name('embassy.store');
        Route::post('/embassy/update/{id}','EmbassyController@update')->name('embassy.update');
        Route::post('/embassy/delete/{id}','EmbassyController@delete')->name('embassy.delete');
        Route::get('/embassy_country','EmbassyController@getcountry')->name('embassy.country');
        //====================> Embassy Management =========================


        //====================> Blog Management =========================
        Route::resource('/blog','BlogController');
        Route::get('/blog/create','BlogController@create')->name('blog.create');
        Route::post('/blog/store','BlogController@store')->name('blog.store');
        Route::post('/blog/update/{id}','BlogController@update')->name('blog.update');
        Route::post('/blog/change_status','BlogController@change_status')->name('blog.change_status');
        Route::post('/blog/delete/{id}','BlogController@delete')->name('blog.delete');
        //====================> Blog Management=========================
        //====================> Visa Type Entry Management =========================
        Route::get('/visa_type_entry','VisaTypeEntryController@index')->name('visa_type_entry.index');
        Route::get('/visa_type_entry/create','VisaTypeEntryController@create')->name('visa_type_entry.create');
        Route::get('/visa_type_entry/edit/{id}','VisaTypeEntryController@edit')->name('visa_type_entry.edit');
        Route::post('/visa_type_entry/delete/{id}','VisaTypeEntryController@delete')->name('visa_type_entry.delete');
        //POST
        Route::post('/visa_type_entry/change_status','VisaTypeEntryController@change_status')->name('visa_type_entry.change_status');
        Route::post('/visa_type_entry/store','VisaTypeEntryController@store')->name('visa_type_entry.store');
        Route::post('/visa_type_entry/update/{id}','VisaTypeEntryController@update')->name('visa_type_entry.update');
        //====================> Visa Type Entry Management =========================

        //====================> Country wise visa Management =========================
        Route::get('/country_visa','CountryWiseVisaController@index')->name('country_visa.index');
        Route::get('/country_visa/create','CountryWiseVisaController@create')->name('country_visa.create');
        Route::get('/country_visa/edit/{id}','CountryWiseVisaController@edit')->name('country_visa.edit');
        Route::post('/country_visa/delete/{id}','CountryWiseVisaController@delete')->name('country_visa.delete');
        Route::post('/country_visa/start/{id}','CountryWiseVisaController@start')->name('country_visa.start');
        //POST
        Route::post('/country_visa/change_status','CountryWiseVisaController@change_status')->name('country_visa.change_status');
        Route::post('/country_visa/store','CountryWiseVisaController@store')->name('country_visa.store');
        Route::post('/country_visa/update/{id}','CountryWiseVisaController@update')->name('country_visa.update');
        Route::get('/country_visa/ShowCountryVisa/{id}','CountryWiseVisaController@ShowCountryVisa')->name('country_visa.ShowCountryVisa');
        Route::get('/country_visa/show/{id}','CountryWiseVisaController@show')->name('country_visa.show');
        Route::post('/country_visa/clone/{id}','CountryWiseVisaController@createclone')->name('country_visa.createclone');
        //====================> Country wise visa Management =========================

        //====================> Transaction/Report Management =========================
        Route::get('/transaction','TransactionController@index')->name('transaction.index');
        Route::get('/transaction/show','TransactionController@show')->name('transaction.show');
        Route::get('/visa_approval','TransactionController@visa_approval_index')->name('visa_approval.visa_approval_index');
        Route::get('/transaction/approvalshow','TransactionController@approvalshow')->name('transaction.approvalshow');
        Route::get('/visa_reject','TransactionController@visa_reject_index')->name('visa_reject.visa_reject_index');
        Route::get('/transaction/rejectshow','TransactionController@rejectshow')->name('transaction.rejectshow');

        //====================> Transaction/Report Management =========================

        //====================> CMS Management =========================
        Route::resource('/cms','CmsController');
        Route::post('/cms/change_status','CmsController@change_status')->name('cms.change_status');
        Route::post('/cms/update/{id}','CmsController@update')->name('cms.update');
        //====================> CMS Management =========================

        //====================> Email Templates Management =========================
        Route::resource('/emailtemplates','EmailTemplatesController');
        Route::post('/emailtemplates/change_status','EmailTemplatesController@change_status')->name('emailtemplates.change_status');
        Route::post('/emailtemplates/update/{id}','EmailTemplatesController@update')->name('emailtemplates.update');
        //====================> Email Templates Management =========================

        //====================> Script Management =========================
        Route::resource('/script','ScriptController');
        Route::post('/script/update/{id}','ScriptController@update')->name('script.update');
        //====================> Script Management =========================

        //====================> Pre Management =========================
        Route::resource('/pre','PreController');
        Route::get('/pre/show','PreController@show')->name('pre.show');
        Route::post('/pre/change_status','PreController@change_status')->name('pre.change_status');
        Route::post('/pre/delete/{id}','PreController@delete')->name('pre.delete');
        Route::post('/pre/update/{id}','PreController@update')->name('pre.update');
        Route::get('/pre/country/{id}','PreController@country_index')->name('pre.country_index');
        Route::get('/pre/visatype/{id}','PreController@visatype_index')->name('pre.visatype_index');
        //====================> Pre Management =========================

        //====================> Post Management =========================
        Route::resource('/post','PostController');
        Route::get('/post/show','PostController@show')->name('post.show');
        Route::post('/post/change_status','PostController@change_status')->name('post.change_status');
        Route::post('/post/delete/{id}','PostController@delete')->name('post.delete');
        Route::post('/post/update/{id}','PostController@update')->name('post.update');

        Route::get('/post/country/{id}','PostController@country_index')->name('post.country_index');
        Route::get('/post/visatype/{id}','PostController@visatype_index')->name('post.visatype_index');
        //====================> Post Management =========================

        //====================> Price Management =========================
        Route::get('/prices','PriceController@index')->name('prices.index');
        Route::get('/prices/create','PriceController@create')->name('prices.create');
        Route::get('/prices/edit/{id}','PriceController@edit')->name('prices.edit');
        Route::post('/prices/delete/{id}','PriceController@delete')->name('prices.delete');
        Route::post('/prices/change_status','PriceController@change_status')->name('prices.change_status');
        Route::post('/prices/store','PriceController@store')->name('prices.store');
        Route::post('/prices/update/{id}','PriceController@update')->name('prices.update');
        Route::get('/prices/status/{id}','PriceController@status_index')->name('prices.status_index');
        Route::get('/prices/visatype/{id}','PriceController@visatype_index')->name('prices.visatype_index');
        //====================> Price Management =========================


        //====================> CMS Management =========================
        Route::resource('/cms','CmsController');
        Route::post('/cms/change_status','CmsController@change_status')->name('cms.change_status');
        Route::post('/cms/update/{id}','CmsController@update')->name('cms.update');
        //====================> CMS Management =========================

        //===================> CMS Management =========================
        Route::resource('/emailtemplates','EmailTemplatesController');
        Route::post('/emailtemplates/change_status','EmailTemplatesController@change_status')->name('emailtemplates.change_status');
        Route::post('/emailtemplates/update/{id}','EmailTemplatesController@update')->name('emailtemplates.update');
        //====================> CMS Management =========================

        //====================> Script Management =========================
        Route::resource('/pre','PreController');
        Route::get('/pre/show','PreController@show')->name('pre.show');
        Route::post('/pre/change_status','PreController@change_status')->name('pre.change_status');
        Route::post('/pre/delete/{id}','PreController@delete')->name('pre.delete');
        Route::post('/pre/update/{id}','PreController@update')->name('pre.update');
        //====================> Script Management =========================

        //====================> Script Management =========================
        Route::resource('/post','PostController');
        Route::get('/post/show','PostController@show')->name('post.show');
        Route::post('/post/change_status','PostController@change_status')->name('post.change_status');
        Route::post('/post/delete/{id}','PostController@delete')->name('post.delete');
        Route::post('/post/update/{id}','PostController@update')->name('post.update');
        //====================> Script Management =========================

        //====================> FAQ Management =========================
        Route::get('/faq','FaqController@index')->name('faq.index');
        Route::post('/faq/sliderorder','FaqController@sliderorder')->name('faq.sliderorder');
        Route::get('/faq/create','FaqController@create')->name('faq.create');
        Route::get('/faq/edit/{id}','FaqController@edit')->name('faq.edit');
        Route::post('/faq/delete/{id}','FaqController@delete')->name('faq.delete');
        Route::post('/faq/change_status','FaqController@change_status')->name('faq.change_status');
        Route::post('/faq/store','FaqController@store')->name('faq.store');
        Route::post('/faq/update/{id}','FaqController@update')->name('faq.update');
        Route::get('/faq/show','FaqController@show')->name('faq.show');

        Route::get('/faq/country/{id}','FaqController@country_index')->name('faq.country_index');
        Route::get('/faq/visatype/{id}','FaqController@visatype_index')->name('faq.visatype_index');
        Route::get('/faq/show','FaqController@show')->name('faq.show');
        //====================> faq Management =========================

        //====================> Order Status =========================
        Route::get('/order','OrderController@index')->name('order.index');
        Route::post('/order/change_status','OrderController@change_status')->name('order.change_status');
        Route::get('/order/show','OrderController@show')->name('order.show');
        Route::get('/order-show/{id}','OrderController@order_show')->name('order.order_show');
        Route::post('/order/change_visa_status','OrderController@change_visa_status')->name('order.change_visa_status');
        Route::post('/order/rejectreason','OrderController@rejectreason')->name('order.rejectreason');
        //====================> Order Status =========================

        //====================> FeedBack Management =========================
        Route::get('/feedback','FeedbackController@index')->name('feedback.index');
        //====================> FeedBack Management =========================
    });
});


