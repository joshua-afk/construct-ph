<?php

// GET https://construct-ph.me/profile/professional123
// POST https://construct-ph.me/login
// PUT https://construct-ph.me/about

Route::post('/logout',                                      'LogoutController@destroy')->middleware('accounts.only');

Route::get('/user-validate/{code}',                         'UserValidateController')->name('user.validate');

/******  Authentication  ******/
Route::middleware(['guests.only'])->group(function () {
    Route::get('/register',                                 'RegisterController@index');
    Route::post('/register',                                'RegisterController@store');

    Route::get('/login',                                    'LoginController@index');
    Route::post('/login',                                   'LoginController@store');
});

/******  ADMIN  ******/
Route::prefix('admin')->group(function () {
    Route::get('/login',                                    'Admin\LoginController@index');
    Route::post('/login',                                   'Admin\LoginController@store');

    Route::middleware(['admin.only'])->group(function () {
        Route::get('/dashboard',                            'Admin\DashboardController@index');

        Route::get('/logs',                                 'Admin\LogController@index');

        Route::get('/projects/featured-projects',           'Admin\FeaturedProjectController@index');

        Route::put('/projects/{project}/feature',           'Admin\ProjectFeatureController@update');
        Route::put('/projects/{project}/unfeature',         'Admin\ProjectUnfeatureController@update');
    });
});

Route::get('/test',                                         'TestController@index');
Route::post('/test',                                        'TestController@store');

Route::get('/user-role',                                    'Account\RoleController@index');
Route::post('/user-role',                                   'Account\RoleController@store');

/******  Landing Pages  ******/
Route::get('/', 'IndexController')->name('index');
Route::get('/about', 'AboutController')->name('about');
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/labour', 'LabourController@index')->name('labour');
Route::get('/job-listing', 'JobListingController@index')->name('job-listing');
Route::get('/blog', 'BlogController@index')->name('blog');

Route::get('/email-us', 'EmailUsController@create');
Route::post('/email-us', 'EmailUsController@store');

Route::get('/contractors', 'ContractorController@index');
Route::get('/sort/contractors',                             'SortContractorController@index');
Route::post('/sort/contractors',                            'SortContractorController@store');

Route::get('/suppliers', 'SupplierController@index');
Route::get('/sort/suppliers', 'SortSupplierController@index');
Route::post('/sort/suppliers', 'SortSupplierController@store');

Route::get('/professionals', 'ProfessionalController@index');
Route::get('/sort/professionals', 'SortProfessionalController@index');
Route::post('/sort/professionals', 'SortProfessionalController@store');

/******  Socialite  ******/
Route::prefix('login')->group(function () {
    Route::get('/facebook', 'Social\FacebookController@redirectToProvider');
    Route::get('/facebook/callback', 'Social\FacebookController@handleProviderCallback');

    Route::get('/google', 'Social\GoogleController@redirectToProvider');
    Route::get('/google/callback', 'Social\GoogleController@handleProviderCallback');
});

/******  Settings  ******/
Route::group(['prefix' => 'settings', 'middleware' => ['accounts.only']], function () {
    /* Pages */
    Route::get('/', 'Setting\GeneralController');
    Route::get('/personal-info', 'Setting\PersonalInfoController@index');
    Route::get('/security', 'Setting\SecurityController@index');

    /* TODO */
    Route::get('/preferences', 'Setting\PreferenceController@index');
    Route::get('/educations', 'Setting\EducationController@index');
    Route::get('/experiences', 'Setting\ExperienceController@index');
    Route::get('/trainings', 'Setting\TrainingController@index');
    Route::get('/licensures', 'Setting\LicensureController@index');

    Route::get('/affiliations', 'Setting\AffiliationController@index');

    /* Forms */
    Route::put('/personal-info', 'Setting\PersonalInfoController@update');
    Route::put('/contact-info', 'Setting\ContactController@update');
    Route::put('/address', 'Setting\AddressController@update');
    Route::put('/password', 'Setting\PasswordController@update');

    Route::post('/preferences', 'Setting\PreferenceController@store');
    Route::put('/preferences', 'Setting\PreferenceController@update');

    Route::post('/educations', 'Setting\EducationController@store');

    Route::post('/experiences', 'Setting\ExperienceController@store');

    Route::post('/trainings', 'Setting\TrainingController@store');

    Route::post('/licensures', 'Setting\LicensureController@store');

    Route::post('/affiliations', 'Setting\AffiliationController@store');
});

/******  Profile  ******/
Route::prefix('profile')->group(function () {
    Route::get('/', 'ProfileController@index');
    Route::get('/{username}', 'ProfileController@show');

    Route::get('/{username}/companies', 'Account\CompanyController@index');
    Route::get('/{username}/companies/{uuid}', 'Account\CompanyController@show');

    Route::get('/manage', 'Account\ManageAccountController@index');
    Route::get('/credentials', 'Account\CredentialController@index');
});

/******  Companies  ******/
Route::get('/companies', 'CompanyController@index');
Route::post('/companies', 'CompanyController@store');
Route::get('/companies/create', 'CompanyController@create');
Route::get('/companies/{company}', 'CompanyController@show');

/******  Account Credentials  ******/
Route::prefix('account')->group(function () {
    Route::put('/profile-image', 'Account\ProfileImageController@update');
    // Route::put('/profile/image',      						'Account\ProfileImageController@update'); // should be

    Route::get('/manage', 'Account\ManageAccountController@index');
    Route::get('/credentials', 'Account\CredentialController@index'); // this shit is page for all info

    // Route::post('/preference',      					'Account\CredentialPreferenceController@store');
    // Route::patch('/preference',      					'Account\CredentialPreferenceController@update');

    // Route::post('/education',      					 	'Account\EducationController@store');

    // Route::post('/experience',      					'Account\ExperienceController@store');

    Route::get('/companies', 'Account\CompanyController@index');
    Route::get('/companies/{uuid}', 'Account\CompanyController@show');
    Route::get('/companies/{uuid}/edit', 'Account\CompanyController@edit');

    Route::get('/projects', 'Account\ProjectController@index'); // show the current user session projects
    Route::get('/projects/{username}', 'Account\ProjectController@show'); // for visitors
});



/******  Projects  ******/
Route::prefix('projects')->group(function () {
    // Route::get('/', 										'ProjectController@index');
    Route::get('/create', 'ProjectController@create');
    Route::post('/', 'ProjectController@store');
    Route::get('/{uuid}', 'ProjectController@show');
    Route::get('/{uuid}/edit', 'ProjectController@edit');
    Route::patch('/{id}', 'ProjectController@update');
    Route::delete('/{id}', 'ProjectController@destroy');

    /******  Handles the addition of project images  ******/
    Route::get('/{uuid}/images/add', 'ProjectImageController@create');
    Route::put('/{uuid}/images/{id}', 'ProjectImageController@update');
    // Route::put('/projects-images/{uuid}/images/{id}', 		'ProjectImageController@update');

    /******  Project Blog  ******/
    Route::get('/{uuid}/blog/create', 'ProjectBlogController@create');
    Route::post('/{uuid}/blog', 'ProjectBlogController@store');
    Route::get('/{uuid}/blog/edit', 'ProjectBlogController@edit');
    Route::put('/{uuid}/blog/{blog}', 'ProjectBlogController@update');

    /******  Project Blog Comment  ******/
    Route::post('/{uuid}/blog/{blog}/comment', 'ProjectBlogCommentController@store');
});

/******  JOBS  ******/
Route::middleware(['accounts.only'])->group(function () {
    Route::get('/jobs', 'Job\JobController@index');
    Route::get('/jobs/create', 'Job\JobController@create');
    Route::post('/jobs', 'Job\JobController@store');
    Route::get('/jobs/{job}', 'Job\JobController@show');
});

// Route::get('/jobs/{job}/apply',		 						'Job\MyAsdController@show');

Route::post('/jobs/{job}/apply', 'Job\JobApplicationController@store');
Route::put('/jobs/{job}/apply/{entry}', 'Job\JobApplicationController@update');

Route::put('/job-applications/{entry}/accept', 'Job\JobApplicationAcceptController@update');
Route::put('/job-applications/{entry}/decline', 'Job\JobApplicationDeclineController@update');

/******  JOB REVIEW  ******/
Route::post('/applicant/reviews', 'Job\JobReviewApplicantController@store');
Route::put('/applicant/reviews/{review}', 'Job\JobReviewApplicantController@update');

Route::post('/owner/reviews', 'Job\JobReviewOwnerController@store');
Route::put('/owner/reviews/{review}', 'Job\JobReviewOwnerController@update');

/******  JOB REVIEW  ******/
Route::get('/job-invitations', 'JobInvitationController@index');


/******  SEARCH  ******/
Route::post('/search/contractors',                          'Search\ContractorController@store');
Route::get('/search/contractors/{code}',                    'Search\ContractorController@show');

Route::get('/search/suppliers/{code}',                      'Search\SupplierController@show');

/******  SORT  ******/
Route::get('/sort/contractors/classification/{code}',       'Sort\ContractorController@show');

/******  ETC  ******/
Route::post('/count-click/{username}',                      'CountClickController@store');
Route::get('/count-click/{username}',                       'CountClickController@store');

Route::get('/bookmarks', 'BookmarkController@index');
Route::post('/bookmarks', 'BookmarkController@store');
Route::delete('/bookmarks', 'BookmarkController@destroy');

Route::post('/primary-classification',                      'Profile\PrimaryClassificationController@store');
Route::put('/primary-classification',                       'Profile\PrimaryClassificationController@update');

Route::post('/summary',                                     'Account\SummaryController@store');

Route::post('/classifications',                             'Account\ClassificationController@store');

/*
Route::get('/manage-account',      						'Account\ManageAccountController@index'); // LN: 27
Route::get('/manage-credentials',      					'Account\ManageCredentialController@index'); // LN: 29

Route::post('/account-preference',      				'Account\AccountPreferenceController@store'); // LN: 30
Route::patch('/account-preference',      				'Account\AccountPreferenceController@update'); // LN: 31

Route::post('/account-education',      					'Account\AccountEducationController@store'); // LN: 33
Route::patch('/account-education',      					'Account\AccountEducationController@update');

Route::post('/account-experience',      				'Account\ResumeWorkController@store'); // LN: 35
Route::patch('/account-experience',      				'Account\ResumeWorkController@update');
*/

/*
Route::patch('/account/basic-info',      				'Account\BasicInfoController@update'); // LN: 37
Route::patch('/account/contacts',      					'Account\ContactController@update'); // LN: 39
Route::patch('/account/address',      					'Account\AddressController@update'); // LN: 41

Route::post('/account/education',      					'Account\EducationController@store'); // LN: 43
Route::patch('/account/education',      				'Account\EducationController@update');

Route::post('/account/work',      						'Account\WorkController@store'); // LN: 45
Route::patch('/account/education',      				'Account\EducationController@update');

Route::get('/change-password',      					'Account\ChangePasswordController@index'); //LN: 27
Route::put('/change-password',      					'Account\ChangePasswordController@update'); //LN: 28

Route::put('/profile-image',      						'Account\ProfileImageController@update'); //LN: 30
*/

// GET 			/photos					index()		photos.index
// GET	 		/photos/create			create()	photos.create
// POST			/photos					store()		photos.store
// GET			/photos/{photo}			show()		photos.show
// GET			/photos/{photo}/edit	edit()		photos.edit
// PUT/PATCH	/photos/{photo}			update()	photos.update
// DELETE		/photos/{photo}			destroy()	photos.destroy

// Route::get('/test',      								'TestController@index');
// Route::post('/test',      								'TestController@store');

// Route::get('/professionals/filter',      					'FilterProfessionalController@index');
// Route::post('/professionals/filter',      					'FilterProfessionalController@store');
