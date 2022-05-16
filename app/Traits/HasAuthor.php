<?php
declare(strict_types = 1);

namespace  App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait  HasAuthor
{
    public  function  author() :User
    {
        return  $this->authorRelation;
    }

    public  function  authorRelation(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'author_id');
    }

    public  function isAuthoredBy(User $user):bool //Check author
    {
        return $this->author()->matches($user);
    }

    public  function authoredBy(User $author) //assigned the author
    {
       return $this->authorRelation()->associate($author);
    }
}

