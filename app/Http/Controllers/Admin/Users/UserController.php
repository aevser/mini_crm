<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\Admin as Requests;
use App\Services\Admin\Users\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ){}

    public function getCreateView(): View
    {
        return view('admin.users.user.create');
    }

    public function store(Requests\Create $request)
    {
        $this->userService->create($request->validated());
        return redirect()->route('admin.dashboard')->with('success', trans('admin/users/user/messages.created'));
    }

    public function getEditView(int $id): View
    {
        $user = $this->userService->getOne($id);
        return view('admin.users.user.edit', compact('user'));
    }

    public function update(Requests\Update $request, int $id): RedirectResponse
    {
        $this->userService->update($request->validated(), $id);
        return redirect()->route('admin.dashboard')->with('success', trans('admin/users/user/messages.updated'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->userService->delete($id);
        return redirect()->route('admin.dashboard')->with('success', trans('admin/users/user/messages.deleted'));
    }
}
