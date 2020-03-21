<?php

namespace App\Http\Controllers\Control;

use App\Contracts\Model\User\RequestKeyInterface as RequestKeyEnum;
use App\helpers\ConstantHelper;
use App\helpers\CustomerGroupHelper;
use App\Http\Controllers\Controller;
use App\models\control\Customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /** @var CustomerGroupHelper */
    private $customerGroupHelper;

    public function __construct(CustomerGroupHelper $customerGroupHelper)
    {
        $this->customerGroupHelper = $customerGroupHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', '=', 'user')
            ->paginate(10, ['users.*']);

        return view('control.customers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dataTypeContent = false;
        return view('control.customers.create', compact('dataTypeContent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
        ]);
        $status = false;
        $roleName = 'user';
        if ($user = Customer::where('email', $request['email'])->first()) {
            $message = 'Пользователь существует';
        } else {
            $user = Customer::newUserByAdmin(
                $request['name'],
                $request['fname'],
                $request['sname'],
                $request['email'],
                $request['phone'],
                $request['password']);
            if ($user) {
                $user->setRole($roleName);
                $message = 'Пользователь успешно добавлен';
                $status = ConstantHelper::ENTITY_CREATED;
            } else {
                $message = 'Чтото пошло не так (роль не добавлена)';
                $status = ConstantHelper::ENTITY_WARNING;
            }
        }
        return redirect(route('customers.store'));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\models\control\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\models\control\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\models\control\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $message = 'Пользователь успешно обновлен';
        $status = ConstantHelper::ENTITY_UPDATED;

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'phone' => 'required|unique:users,phone,' . $customer->id,
            RequestKeyEnum::CUSTOMER_GROUP_ID => [
                'required',
                Rule::in($this->getCustomerGroupIds())
            ]
        ]);

        $customer->withRequestData($request)->save();

        return ['status' => $status, 'message' => $message, 'model' => $customer];
    }

    private function getCustomerGroupIds(): array
    {
        return $this->customerGroupHelper->getKnownIds();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\models\control\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
