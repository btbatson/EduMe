<?php

namespace App\Model;

use App\Model\Post;
use App\Model\Chat;
use App\Model\Skill;
use App\Model\Comment;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
    protected $fillable = [
        'firstname', 'lastname', 'username', 'email', 'password', 'profile_pic',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName()
    {
        if($this->firstname && $this->lastname)
        {
            return "{$this->firstname} {$this->lastname}";
        }

        if($this->firstname)
        {
            return $this->firstname;
        }

        return null;
    }

    public function getAvatarUrl()
    {
        return $this->profile_pic;
    }

    public function courses()
    {
        return $this->hasMany('App\Model\Course', 'user_id');
    }

    public function joinCourses()
    {
        return $this->belongsToMany('App\Model\Course');
    }

    public function projects()
    {
        return $this->hasMany('App\Model\Project');
    }

    public function skills()
    {
        return $this->morphToMany('App\Model\Skill', 'skillable')->withTimestamps();
    }

    public function interests()
    {
        return $this->belongsToMany('App\Model\Interest')->withTimestamps();;
    }

    public function postType()
    {
        return $this->morphMany('App\Model\Post', 'postable');
    }

    public function posts()
    {
        return $this->hasMany('App\Model\Post', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Model\Like', 'user_id');
    }

    public function educations()
    {
        return $this->hasMany('App\Model\Education', 'user_id');
    }

    public function experiences()
    {
        return $this->hasMany('App\Model\Experience', 'user_id');
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Model\User', 'friends', 'friend_id', 'user_id');
    }

    public function myFriends()
    {
        return $this->belongsToMany('App\Model\User', 'friends', 'user_id', 'friend_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()
                ->wherePivot('accepted', true)->get()
                ->merge($this->myFriends()->wherePivot('accepted', true)->get());
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPinding()
    {
        return $this->myFriends()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPinding(User $user)
    {
        return (bool) $this->friendRequestsPinding()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function AddFriend(User $user)
    {
        $this->myFriends()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->myFriends()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true,
            ]);
    }

    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikedPost(Post $post)
    {
        return (bool) $post->likes()->where('user_id', $this->id)->count();
    }

    public function getLikedPost(Post $post)
    {
        return $post->likes()->where('user_id', $this->id)->first();
    }

    public function hasLikedComment(Comment $comment)
    {
        return (bool) $comment->likes()->where('user_id', $this->id)->count();
    }

    public function getLikedComment(Comment $comment)
    {
        return $comment->likes()->where('user_id', $this->id)->first();
    }

    public function hasSkill(Skill $skill)
    {
        return (bool) $this->skills()->where('skill_id', $skill->id)->count();
    }

    public function hasInterest(Interest $interest)
    {
        return (bool) $this->interests()->where('interest_id', $interest->id)->count();
    }


    public function isAttend(Course $course)
    {
        return (bool) $this->joinCourses()->where('course_id', $course->id)->count();
    }

    public function chatOfMine()
    {
        return $this->hasMany('App\Model\Chat', 'friend_id');
    }

    public function myChats()
    {
        return $this->hasMany('App\Model\Chat', 'user_id');
    }

    public function chats()
    {
        return $this->chatOfMine()->get()
                ->merge($this->myChats()->get());
    }

    public function isChat(User $user)
    {
        if($this->chatOfMine()->where('user_id', $user->id)->count())
        {
            return true;
        }
        else if($this->myChats()
                ->where('friend_id', $user->id)->count())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getChatWith(User $user)
    {

        if($this->chatOfMine()->where('user_id', $user->id)->count())
        {
            return $this->chatOfMine()
                ->where('user_id', $user->id)->first();
        }
        else
        {
            return $this->myChats()
                ->where('friend_id', $user->id)->first();
        }
    }
}
