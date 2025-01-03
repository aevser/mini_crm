<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\Admin as Requests;
use App\Services\Admin\Users\AdminService;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ){}

    public function getIndexView(): View
    {
        $users = $this->adminService->getAllUsers();
        return view('admin.index', compact('users'));
    }

    public function getCreateView(): View
    {
        return view('admin.users.admin.create');
    }

    public function store(Requests\Create $request): RedirectResponse
    {
        $this->adminService->create($request->validated());
        return redirect()->route('admin.dashboard')->with('success', trans('admin/users/admin/messages.created'));
    }

    public function getEditView(int $id): View
    {
        $user = $this->adminService->getOne($id);
        return view('admin.users.admin.edit', compact('user'));
    }

    public function update(Requests\Update $request, int $id): RedirectResponse
    {
        $this->adminService->update($request->validated(), $id);
        return redirect()->route('admin.dashboard')->with('success', trans('admin/users/admin/messages.updated'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->adminService->delete($id);
        return redirect()->route('admin.dashboard')->with('success', trans('admin/users/admin/messages.deleted'));
    }
}
