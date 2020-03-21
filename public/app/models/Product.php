<?php

namespace App\models;

use App\Contracts\CustomerGroup\IdInterface as CustomerGroupIdEnum;
use App\Contracts\Model\Product\Table\ColumnNameInterface as ProductColumnNameEnum;
use App\Contracts\Model\User\Table\ColumnNameInterface as UserColumnNameEnum;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Rinvex\Attributes\Traits\Attributable;

class Product extends Model
{
    use Attributable;

    protected $appends = ['price'];

    public function getPriceAttribute()
    {
        $currentUserCustomerGroupId = $this->getCurrentUserCustomerGroupId();

        switch ($currentUserCustomerGroupId) {
            case null:
                return null;
            case CustomerGroupIdEnum::GROUP_1:
                return $this[ProductColumnNameEnum::PRICE_1];
            case CustomerGroupIdEnum::GROUP_2:
                return $this[ProductColumnNameEnum::PRICE_2];
            case CustomerGroupIdEnum::GROUP_3:
                return $this[ProductColumnNameEnum::PRICE_3];
            case CustomerGroupIdEnum::GROUP_4:
                return $this[ProductColumnNameEnum::PRICE_4];
            case CustomerGroupIdEnum::GROUP_5:
                return $this[ProductColumnNameEnum::PRICE_5];
            default:
                throw new Exception('Unknown customer group id: ' . $currentUserCustomerGroupId);
        }
    }

    private function getCurrentUserCustomerGroupId()
    {
        $currentUser = $this->getCurrentUser();

        if (!$currentUser) {
            return null;
        }

        return $currentUser[UserColumnNameEnum::CUSTOMER_GROUP_ID];
    }

    private function getCurrentUser(): ?Authenticatable
    {
        return Auth::user();
    }
}
