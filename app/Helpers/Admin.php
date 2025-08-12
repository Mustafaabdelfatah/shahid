<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

//Get All Route And filter
if (!function_exists('getAdminRoutes')) {
    function getAdminRoutes()
    {
        $routeCollection = Route::getRoutes();


        $routes = [];
        $permissions = [];
        foreach ($routeCollection as $value) {
            $routes[] = $value->getName();
        }
        $routes = array_filter($routes);
        foreach ($routes as $route) {
            if (str_contains($route, "admin") == true) {
                $permissions[] = $route;
            }
        }
        return $permissions;
    }
}

if (!function_exists('getPublisherRoutes')) {
    function getPublisherRoutes()
    {
        $routeCollection = Route::getRoutes();


        $routes = [];
        $permissions = [];
        foreach ($routeCollection as $value) {
            $routes[] = $value->getName();
        }
        $routes = array_filter($routes);
        foreach ($routes as $route) {
            if (str_contains($route, "publisher") == true) {
                $permissions[] = $route;
            }
        }
        return $permissions;
    }
}

if (!function_exists('syncPermisionsPublisher')) {
    function syncPermisionsPublisher($model = null)
    {
        $routes = getPublisherRoutes();
        foreach ($routes as $route) {
            $permissionExist = (clone $model)->where('name', $route)->first();
            if ($permissionExist == null) {
                Permission::create([
                    'name' => $route,
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}

// if (!function_exists('syncPermisions')) {
//     function syncPermisions($model = null)
//     {
//         // Get the list of routes
//         $routes = getAdminRoutes();

//         foreach ($routes as $route) {
//             // Check if the permission already exists
//             $permissionExist = Permission::where('name', $route)
//                 ->where('guard_name', 'admin')
//                 ->first();

//             // If the permission doesn't exist, create it
//             if ($permissionExist == null) {
//                 Permission::create([
//                     'name' => $route,
//                     'guard_name' => 'admin',
//                 ]);
//             }
//         }
//     }
// }
if (!function_exists('syncPermisions')) {
    function syncPermisions()
    {
        $routes = getAdminRoutes();

        foreach ($routes as $route) {
            Permission::updateOrCreate(
                ['name' => $route, 'guard_name' => 'admin'],
                ['name' => $route, 'guard_name' => 'admin']
            );
        }
    }
}

if (!function_exists('transPermission')) {
    function transPermission($val)
    {
        $val = str_replace('admin.', '', $val);
        $val = str_replace('.', ' ', $val);
        $val = str_replace('-', ' ', $val);
        return $val;
    }
}
if (!function_exists('transWebPermission')) {
    function transWebPermission($val)
    {
        $val = str_replace('publisher.', '', $val);
        $val = str_replace('.', ' ', $val);
        $val = str_replace('-', ' ', $val);
        return $val;
    }
}
if (!function_exists('upload_file')) {
    function upload_file($file, $path = '')
    {
        $imageName = time() . '.' . $file->extension();
        return "attachments" . "/" . $file->store($path, 'attachment');
    }
}



if (!function_exists('ImageValidate')) {
    function ImageValidate()
    {
        return "image|mimes:jpeg,png,jpg,gif,svg|max:2048";
    }
}




if (!function_exists('admin_path')) {
    function admin_path($path)
    {
        return asset("storage/admin/" . $path);
    }
}
if (!function_exists('pagination_count')) {
    function pagination_count()
    {
        return 25;
    }
}
