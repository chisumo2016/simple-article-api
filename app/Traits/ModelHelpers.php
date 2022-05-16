<?php
declare(strict_types=1);

namespace  App\Traits;

trait ModelHelpers
{
    public  function  matches(self $model): bool
    {
        return  $this->id === $model->id;
    }
}
