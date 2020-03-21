<?php

namespace App\models\control;

use App\Contracts\Model\User\RequestKeyInterface as RequestKeyEnum;
use App\Contracts\Model\User\Table\ColumnNameInterface as ColumnNameEnum;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Customer extends User
{
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'fname', 'sname', ColumnNameEnum::CUSTOMER_GROUP_ID
        //'verify_token'
    ];

    protected $table = 'users';

    /**
     * @param string $name
     * @param string $fname
     * @param string $sname
     * @param string $email
     * @param string $phone
     * @param string $password
     * @param int $customerGroupId
     * @return static
     */
    public static function newUserByAdmin($name, $fname, $sname, $email, $phone, $password, $customerGroupId): self
    {

        return self::create(
            [
                'name' => $name,
                'fname' => $fname,
                'sname' => $sname,
                'email' => $email,
                'password' => bcrypt($password),
                'verify_token' => Str::random(),
                'phone' => $phone,
                ColumnNameEnum::CUSTOMER_GROUP_ID => $customerGroupId
            ]
        );
    }


    public function withRequestData(Request $request)
    {
        $this->name = $request->input('name');
        $this->fname = $request->input('fname');
        $this->sname = $request->input('sname');
        $this->email = $request->input('email');
        $this->phone = $request->input('phone');
        $this[ColumnNameEnum::CUSTOMER_GROUP_ID] = $request->input(RequestKeyEnum::CUSTOMER_GROUP_ID);

        $password = $request->input('password');

        if (!empty($password)) {
            $this->password = bcrypt($password);
            //$this->verify_token =  Str::random();
        }

        return $this;
    }
}
