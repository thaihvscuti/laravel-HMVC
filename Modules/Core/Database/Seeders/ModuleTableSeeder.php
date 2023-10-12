<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Module as ModuleModel;
use Nwidart\Modules\Facades\Module;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
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
        // $this->call("OthersTableSeeder");
    }
}
