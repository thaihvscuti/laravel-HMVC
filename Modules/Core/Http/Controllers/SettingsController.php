<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use Modules\Core\Entities\Module as ModuleModel;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $breadcrumbs = ['Settings'];
        $title = 'Settings';

        $allModule = ModuleModel::all();
        if ($allModule->isEmpty()) {
            $moduleEnabled = Module::allEnabled();
            foreach ($moduleEnabled as $value) {
                $module = new ModuleModel();
                $module->name = $value->getName();
                $module->status = ModuleModel::ENABLED;
                $module->save();
            }

            $moduleDisabled = Module::allDisabled();
            foreach ($moduleDisabled as $value) {
                $module = new ModuleModel();
                $module->name = $value->getName();
                $module->status = ModuleModel::DISABLED;
                $module->save();
            }
        }

        $modules = new ModuleModel();
        $modules = $modules->where('name', '!=', 'Core');
        if ($request->search) {
            $modules = $modules->where(function ($q) use ($request) {
                $q->orWhere('name', 'like', '%'.trim($request->search).'%');
            });
        }
        $modules = $modules->sortable(['updated_at' => 'desc'])
            ->paginate(20)
            ->withQueryString();
        return view('core::setting.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'modules' => $modules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('core::setting.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('core::setting.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $title = 'Edit module';
        $breadcrumbs = [
            [
                'url' => route('setting.index'),
                'name' => 'Setting'
            ],
            'Edit',
        ];
        $module = ModuleModel::findOrFail($id);
        if ($module->name != ModuleModel::MODULE_CORE) {
            return view('core::setting.edit', [
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'module' => $module,
            ]);
        }
        return redirect()->route('setting.index');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $moduleModel = ModuleModel::findOrFail($id);
        $moduleName = $moduleModel->name;
        $module = Module::find($moduleName);
        if ($moduleName != ModuleModel::MODULE_CORE) {
            if ($request->status) {
                $moduleModel->status = ModuleModel::ENABLED;
                $module->enable();
            } else {
                $moduleModel->status = ModuleModel::DISABLED;
                $module->disable();
            }
            $moduleModel->update();
        }
        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
