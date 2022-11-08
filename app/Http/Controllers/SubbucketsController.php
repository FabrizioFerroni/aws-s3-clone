<?php

namespace App\Http\Controllers;

use App\Models\Buckets;
use App\Models\Subbuckets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SubbucketsController extends Controller
{

    public function postCreateBucket($nombre, Request $req)
    {

        function formatBytes($bytes, $precision = 2)
        {
            $base = log($bytes, 1024);
            $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');

            return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
        }

        $type = $req->input('type');
        $id_bucket = e($req->input('id'));
        $id_user = $req->user()->id;
        $id_bucket = (int) $id_bucket;
        $b = Buckets::find($id_bucket);
        $url = $b->url;
        if ($type === "folder") {
            $nombre = e($req->input('name'));
            $slug = Str::slug($nombre, '-');
            $isFolder = true;

            $rules = [
                'name' => 'required|unique:subbuckets',
            ];
            $messages = [
                'name.required' => 'Por favor ingrese el nombre de la carpeta',
                'name.unique' => 'El nombre de la carpeta ' . $nombre . ' ya esta en uso, por favor elija otro',
            ];

            $upload_path = Config::get('filesystems.disks.uploads.root');

            $validator = Validator::make($req->all(), $rules, $messages);
            if ($validator->fails()) {
                return back()->withInput($req->all())->withErrors($validator);
            } else {
                if (!Storage::disk('uploads')->exists($url . '/' . $slug)) {
                    $new_url = $url . '/' . $slug;
                    $sb = new Subbuckets;
                    $sb->name = Str::headline($nombre);
                    $sb->slug = $slug;
                    $sb->tipe = $type;
                    $sb->public_url = $new_url;
                    $sb->size = "-";
                    $sb->class = "-";
                    $sb->isFolder = $isFolder;
                    $sb->user_id = $id_user;
                    $sb->bucket_id = $id_bucket;

                    if ($sb->save()) {
                        Storage::disk('uploads')->makeDirectory($url . '/' . $slug, 0775, true);
                        return redirect('/buckets/' . $b->slug)->with('message', 'Se creo con éxito la nueva carpeta')->with('typealert', 'success');
                    }
                } else {
                    return "Existe: " . $slug;
                }

            }

        }

        if ($type === "file") {

            $public_id = Str::random(25);

            $rules = [
                'name' => 'required|unique:subbuckets',
                'file' => 'required',
            ];
            $messages = [
                'name.required' => 'Por favor ingrese el nombre de la carpeta',
                'name.unique' => 'El nombre de la carpeta ' . $nombre . ' ya esta en uso, por favor elija otro',
                'file.required' => 'Por favor suba un archivo',
            ];

            $validator = Validator::make($req->all(), $rules, $messages);
            if ($validator->fails()) {
                return back()->withInput($req->all())->withErrors($validator);
            } else {
                if (Storage::disk('uploads')->exists($url)) {
                    $nombre = e($req->input('name'));
                    $isFolder = false;
                    $path = $b->url;
                    $fileExt = trim($req->file('file')->getClientOriginalExtension());
                    $size = $req->file('file')->getSize();
                    $fileName = rand(1, 9999) . '-' . Str::slug($nombre) . '.' . $fileExt;
                    $final_file = $path . '/' . $fileName;
                    $sb = new Subbuckets;
                    $sb->name = $fileName;
                    $sb->slug = $fileName;
                    $sb->public_id = $public_id;
                    $sb->tipe = $type;
                    $sb->public_url = $final_file;
                    $sb->size = formatBytes($size, 1);
                    $sb->ext = Str::headline($fileExt);
                    $sb->class = "Estandar";
                    $sb->isFolder = $isFolder;
                    $sb->user_id = $id_user;
                    $sb->bucket_id = $id_bucket;

                    if ($sb->save()) {
                        if ($req->hasFile('file')) {
                            // $path = Storage::disk('uploads')->putFileAs(
                            //     $url, $req->file('file'), $fileName
                            // );

                            $filesystem = Storage::disk('uploads');
                            $filesystem->putFileAs($url, $req->file('file'), $fileName);
                            return redirect('/buckets/' . $b->slug)->with('message', 'Se subio con éxito la imagen')->with('typealert', 'success');
                        }
                    }
                }

                // return $sb;
            }
        }
    }

    public function deleteBucket($nombre, $id)
    {
        $sb = Subbuckets::find($id);
        if (is_null($sb)) {
            return "Es nulo";
        } else {
            $url = $sb->public_url;
            if ($sb->isFolder === 1) {
                if (Storage::disk('uploads')->exists($url)) {
                    if ($sb->delete()) {
                        Storage::disk('uploads')->deleteDirectory($url);
                        return back()->with('message', 'Se borro con éxito la carpeta.')->with('typealert', 'success');
                    }
                }
            } else {
                $url = $sb->public_url;
                if (Storage::disk('uploads')->exists($url)) {
                    if ($sb->delete()) {
                        Storage::disk('uploads')->delete($url);
                        return back()->with('message', 'Se borro con éxito el archivo.')->with('typealert', 'success');
                    }

                } else {
                    return back()->with('message', "No existe el archivo")->with('typealert', 'danger');
                }
            }
        }
    }

    public function subirArchivo($nombre, $subnombre)
    {
        $id = Auth::id();
        $bucket = Buckets::where('slug', $nombre)->where('user_id', $id)->first();
        $id_bucket = $bucket->id;
        $sb = Subbuckets::where('slug',$subnombre)->where('user_id', $id)->where('bucket_id', $id_bucket)->first();
        $id_sb = $sb->id;
        // $subbuckets = Subbuckets::orderBy('id', 'Asc')->where('bucket_id', $id_bucket)->where('user_id', $id)->where('folder_id', $id_sb)->get();
        $data = ['nombre' => $nombre, 'subnombre' => $subnombre, 'id' => $id_sb, 'idb' => $id_bucket];
        return view('subbuckets.upload', $data);
    }

    public function postsubirArchivo($nombre, $subnombre, Request $req)
    {

        function formatBytes($bytes, $precision = 2)
        {
            $base = log($bytes, 1024);
            $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');

            return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
        }

        $type = 'file';
        $id_subbucket = e($req->input('id'));
        $id_user = $req->user()->id;
        $id_subbucket = (int) $id_subbucket;
        $sb = Subbuckets::find($id_subbucket);
        $url = $sb->public_url;
        $id_bucket = e($req->input('idb'));
        $id_bucket = (int) $id_bucket;

        $public_id = Str::random(25);

        $rules = [
            'name' => 'required|unique:subbuckets',
            'file' => 'required',
        ];
        $messages = [
            'name.required' => 'Por favor ingrese el nombre de la carpeta',
            'name.unique' => 'El nombre de la carpeta ' . $nombre . ' ya esta en uso, por favor elija otro',
            'file.required' => 'Por favor suba un archivo',
        ];

        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput($req->all())->withErrors($validator);
        } else {
            if (Storage::disk('uploads')->exists($url)) {
                $name = e($req->input('name'));
                $isFolder = false;
                $path = $sb->public_url;
                $fileExt = trim($req->file('file')->getClientOriginalExtension());
                $size = $req->file('file')->getSize();
                $fileName = rand(1, 9999) . '-' . Str::slug($name) . '.' . $fileExt;
                $final_file = $path . '/' . $fileName;
                $sb = new Subbuckets;
                $sb->name = $fileName;
                $sb->slug = $fileName;
                $sb->public_id = $public_id;
                $sb->tipe = $type;
                $sb->public_url = $final_file;
                $sb->size = formatBytes($size, 1);
                $sb->ext = Str::headline($fileExt);
                $sb->class = "Estandar";
                $sb->isFolder = $isFolder;
                $sb->user_id = $id_user;
                $sb->bucket_id = $id_bucket;
                $sb->folder_id = $id_subbucket;

                if ($sb->save()) {
                    if ($req->hasFile('file')) {
                        // $path = Storage::disk('uploads')->putFileAs(
                        //     $url, $req->file('file'), $fileName
                        // );

                        $filesystem = Storage::disk('uploads');
                        $filesystem->putFileAs($url, $req->file('file'), $fileName);
                        return redirect('/buckets/' . $nombre .'/' . $subnombre)->with('message', 'Se subio con éxito la imagen')->with('typealert', 'success');
                    }
                }
            }

            // return $sb;
        }


        // return $url;
    }


    public function deleteSubirArchivo($nombre, $subnombre, $id)
    {
        $sb = Subbuckets::find($id);
        if (is_null($sb)) {
            return "Es nulo";
        } else {
            $url = $sb->public_url;

                $url = $sb->public_url;
                if (Storage::disk('uploads')->exists($url)) {
                    if ($sb->delete()) {
                        Storage::disk('uploads')->delete($url);
                        return back()->with('message', 'Se borro con éxito el archivo.')->with('typealert', 'success');
                    }
                } else {
                    return back()->with('message', "No existe el archivo")->with('typealert', 'danger');
                }
            }
    }

}
