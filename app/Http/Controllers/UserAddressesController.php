<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    /**
     * 收货地址列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $addresses = $request->user()->addresses;
        return view('user_addresses.index', compact('addresses'));
    }
    
    /**
     * 新增地址
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user_addresses.create_and_edit', ['address' => new UserAddress()]);
    }
    
    /**
     * 新增收获地址
     * @param UserAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserAddressRequest $request)
    {
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));
        return redirect()->route('user_addresses.index');
    }
    
    /**
     * 收货地址编辑页面
     * @param UserAddress $userAddress
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(UserAddress $userAddress)
    {
        $this->authorize('own', $userAddress);
        return view('user_addresses.create_and_edit', ['address' => $userAddress]);
    }
    
    /**
     * 更新地址
     * @param UserAddress $userAddress
     * @param UserAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserAddress $userAddress, UserAddressRequest $request)
    {
        $this->authorize('own', $userAddress);
        $userAddress->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));
        return redirect()->route('user_addresses.index');
    }
    
    public function destroy(UserAddress $userAddress, Request $request)
    {
        $this->authorize('own', $userAddress);
        $userAddress->delete();
        return redirect()->route('user_addresses.index');
    }
    
}
