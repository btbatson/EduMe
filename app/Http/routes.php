<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('/chat', function(){
    // Redis::publish('chat message', "John");
    return view('chat.chat');
});

Route::group(['prefix' => '/server/chat'], function () {
    Route::post('message', array('uses'=>'ChatController@postMessage'));
});

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', [
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);

    /*
        ===== search =====
     */

    Route::get('/search', [
        'uses' => 'SearchController@getResaults',
        'as' => 'search.resaults',
        'middleware' => 'auth'
    ]);

    /*
        ===== profile =====
     */

    Route::get('/user/{username}', [
        'uses' => 'ProfileController@getProfile',
        'as' => 'profile.index',
        'middleware' => 'auth'
    ]);

    Route::get('/profile/edit', [
        'uses' => 'ProfileController@getEdit',
        'as' => 'profile.edit',
        'middleware' => 'auth'
    ]);

    Route::post('/profile/edit', [
        'uses' => 'ProfileController@postEdit',
        'as' => 'profile.edit'
    ]);
    Route::post('/profile/edit', [
        'uses' => 'ProfileController@postEdit',
        'as' => 'profile.edit'
    ]);
    /*
        ===== cv =====
     */
    Route::get('/user/{username}/cv', [
        'uses' => 'CvController@index',
        'as' => 'profile.cv'
    ]);

    Route::get('/profile/add/education', [
        'uses' => 'CvController@getEducation',
        'as' => 'cv.addEducation',
        'middleware' => 'auth'
    ]);

    Route::post('/profile/add/education', [
        'uses' => 'CvController@postEducation',
        'middleware' => 'auth'
    ]);

    Route::get('/profile/add/experience', [
        'uses' => 'CvController@getExperience',
        'as' => 'cv.addExperience',
        'middleware' => 'auth'
    ]);

    Route::post('/profile/add/experience', [
        'uses' => 'CvController@postExperience',
        'middleware' => 'auth'
    ]);

    Route::get('/profile/add/skill', [
        'uses' => 'CvController@getSkill',
        'as' => 'cv.addSkill',
        'middleware' => 'auth'
    ]);

    Route::post('/profile/add/skill', [
        'uses' => 'CvController@postSkill',
        'middleware' => 'auth'
    ]);

    Route::get('/profile/add/interest', [
        'uses' => 'CvController@getInterest',
        'as' => 'cv.addInterest',
        'middleware' => 'auth'
    ]);

    Route::post('/profile/add/interest', [
        'uses' => 'CvController@postInterest',
        'middleware' => 'auth'
    ]);

    Route::get('/profile/add/project', [
        'uses' => 'CvController@getProject',
        'as' => 'cv.addProject',
        'middleware' => 'auth'
    ]);

    Route::post('/profile/add/project', [
        'uses' => 'CvController@postProject',
        'middleware' => 'auth'
    ]);
    
    /*
        ===== friends =====
     */
    Route::get('/friends', [
        'uses' => 'ProfileController@getFriendsIndex',
        'as' => 'profile.friends',
        'middleware' => 'auth'
    ]);
    Route::get('/friends/add/{username}', [
        'uses' => 'ProfileController@getAddFriend',
        'as' => 'profile.addFriend',
        'middleware' => 'auth'
    ]);
    Route::get('/friends/accept/{username}', [
        'uses' => 'ProfileController@getAcceptFriend',
        'as' => 'profile.acceptFriend',
        'middleware' => 'auth'
    ]);

    Route::post('/friends/delete/{username}', [
        'uses' => 'ProfileController@postDeleteFriend',
        'as' => 'profile.deleteFriend',
        'middleware' => 'auth'
    ]);
    /*
        ===== post =====
     */
    Route::post('/post', [
        'uses' => 'PostController@postAddPost',
        'as' => 'post.add',
        'middleware' => 'auth'
    ]);
    Route::post('/post/{postId}/comment', [
        'uses' => 'PostController@postComment',
        'as' => 'post.addComment',
        'middleware' => 'auth'
    ]);

    Route::get('/post/{postId}/like', [
        'uses' => 'PostController@getLikePost',
        'as' => 'post.like',
        'middleware' => 'auth'
    ]);

    Route::get('/post/comment/{commentId}/like', [
        'uses' => 'PostController@getLikeComment',
        'as' => 'post.likeComment',
        'middleware' => 'auth'
    ]);

    /*
        ===== chat =====
    */
   
   Route::get('/messages/{id}', [
        'uses' => 'ChatController@getMessages',
        'as' => 'chat.messages',
        'middleware' => 'auth'
    ]);
   Route::get('/list', [
        'uses' => 'ChatController@getList',
        'as' => 'chat.list',
        'middleware' => 'auth'
    ]);

    /*
        ===== course =====
    */
    
    Route::get('/courses', [
        'uses' => 'CourseController@index',
        'as' => 'course.index',
        'middleware' => 'auth'
    ]);

    Route::get('/courses/cat/{id}', [
        'uses' => 'CourseController@getCategory',
        'as' => 'course.category',
        'middleware' => 'auth'
    ]);

    Route::get('/course/add', [
        'uses' => 'CourseController@getAddCourse',
        'as' => 'course.addCourse',
        'middleware' => 'auth'
    ]);

    Route::post('/course/add', [
        'uses' => 'CourseController@postAddCourse',
        'middleware' => 'auth'
    ]);

    Route::get('/course/{id}', [
        'uses' => 'CourseController@getCourse',
        'as' => 'course.show',
        'middleware' => 'auth'
    ]);

    Route::get('/course/{id}/add/video', [
        'uses' => 'CourseController@getAddVideo',
        'as' => 'course.addVideo',
        'middleware' => 'auth'
    ]);

    Route::post('/course/{id}/add/video', [
        'uses' => 'CourseController@postAddVideo',
        'middleware' => 'auth'
    ]);

    Route::get('/course/{id}/{video}/video', [
        'uses' => 'CourseController@getVideo',
        'as' => 'course.getVideo',
        'middleware' => 'auth'
    ]);

    Route::get('/course/{id}/discussion', [
        'uses' => 'CourseController@getDiscussion',
        'as' => 'course.getDiscussion',
        'middleware' => 'auth'
    ]);

    Route::get('/course/{id}/join', [
        'uses' => 'CourseController@getJoin',
        'as' => 'course.getJoin',
        'middleware' => 'auth'
    ]);


    /*
    ========= posts in course ==========
     */
    Route::post('/course/{id}/post', [
        'uses' => 'PostsCourseController@postAddPost',
        'as' => 'course.post.add',
        'middleware' => 'auth'
    ]);
    Route::post('/course/{id}/post/{postId}/comment', [
        'uses' => 'PostsCourseController@postComment',
        'as' => 'course.post.addComment',
        'middleware' => 'auth'
    ]);

    Route::get('/course/{id}/post/{postId}/like', [
        'uses' => 'PostsCourseController@getLikePost',
        'as' => 'course.post.like',
        'middleware' => 'auth'
    ]);

    Route::get('/course/{id}/post/comment/{commentId}/like', [
        'uses' => 'PostsCourseController@getLikeComment',
        'as' => 'course.post.likeComment',
        'middleware' => 'auth'
    ]);

});




/*
    =========== API ===========
 */
Route::group(['prefix' => 'api/v1','middleware' => 'auth.basic'], function () {
    
    Route::get('/', function(){
        return 'welcome';
    });
});

Route::group(['prefix' => 'api/v1'], function () {
    
    Route::post('register', array('uses'=>'Auth\AuthController@postApiRegister'));
    Route::post('login', array('uses'=>'Auth\AuthController@postApiLogin'));

    Route::post('posts', array('uses'=>'Api\HomeController@getPost'));

    Route::post('profile', array('uses'=>'Api\HomeController@getProfile'));

    Route::post('myProfile', array('uses'=>'Api\HomeController@getMyProfile'));
    
    Route::post('getPost', array('uses'=>'Api\HomeController@getOnePost'));
    
    Route::post('add/post', array('uses'=>'Api\HomeController@addPost'));

    Route::post('add/comment', array('uses'=>'Api\HomeController@addComment'));

    Route::post('cv', array('uses'=>'Api\HomeController@getCv'));

    Route::get('courses', array('uses'=>'Api\CourseController@allCourses'));

    Route::post('course', array('uses'=>'Api\CourseController@getCourse'));

    Route::post('myCourses', array('uses'=>'Api\HomeController@getMyCourses'));

    Route::post('lecture', array('uses'=>'Api\CourseController@getvideos'));

});