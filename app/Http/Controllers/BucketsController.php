<?php

namespace App\Http\Controllers;

use App\Models\Buckets;
use App\Models\Subbuckets;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BucketsController extends Controller
{
    public function getHome()
    {
        $id = Auth::id();
        $buckets = Buckets::orderBy('id', 'Asc')->where('user_id', $id)->get();
        $data = ['buckets' => $buckets];
        return view('buckets.index', $data);
    }

    public function getHomeBuckets($nombre)
    {
        $id = Auth::id();
        $bucket = Buckets::where('slug', $nombre)->where('user_id', $id)->first();
        if($bucket === null){
            return redirect('404');
        }
        $id_bucket = $bucket->id;
        $subbuckets = Subbuckets::orderBy('id', 'Asc')->where('bucket_id', $id_bucket)->where('user_id', $id)->where('folder_id', NULL)->get();
        $nombre = Str::headline($nombre);
        $data = ['nombre' => $nombre, 'subbuckets' => $subbuckets];
        return view('buckets.buckets.index', $data);
    }
    public function getHomeBucketsSub($nombre, $subnombre)
    {
        // return [$nombre, $subnombre];
        $id = Auth::id();
        $bucket = Buckets::where('slug', $nombre)->where('user_id', $id)->first();
        // return $nombre;
        $id_bucket = $bucket->id;
        $sb = Subbuckets::where('slug',$subnombre)->where('user_id', $id)->where('bucket_id', $id_bucket)->first();
        if($sb === null){
            return redirect('404');
        }
        $id_sb = $sb->id;
        $subbuckets = Subbuckets::orderBy('id', 'Asc')->where('bucket_id', $id_bucket)->where('user_id', $id)->where('folder_id', $id_sb)->get();
        $data = ['nombre' => $nombre, 'subnombre' => $subnombre, 'buckets' => $bucket, 'subbuckets' => $subbuckets];
        return view('subbuckets.index', $data);
    }

    public function getCrearBucket()
    {
        return view('buckets.buckets.create');
    }

    public function postBucket(Request $req)
    {
        $nombre = e($req->input('nombre'));
        $region = e($req->input('region'));
        $acceso = e($req->input('acceso'));
        $id = $req->user()->id;
        $key_id_user = $req->user()->key_id;
        $segments = Str::ucsplit($key_id_user);

        $guion = strpos($key_id_user, "-");
        if ($guion !== false) {
            $uri = substr($key_id_user, 0, $guion);
        }

        $rules = [
            'nombre' => 'required|unique:buckets',
            'region' => 'required',
            'acceso' => 'required',
        ];

        $messages = [
            'nombre.required' => 'Por favor ingrese el nombre del bucket',
            'nombre.unique' => 'El nombre del bucket ya esta en uso, por favor elija otro',
            'region.required' => 'Por favor ingrese la region del bucket',
            'acceso.required' => 'Por favor ingrese el tipo de acceso del bucket',
        ];
        $upload_path = Config::get('filesystems.disks.uploads.root');

        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput($req->all())->withErrors($validator);
        } else {

            if (!Storage::disk('uploads')->exists($uri)) {
                Storage::disk('uploads')->makeDirectory($uri, 0775, true);
                $slug = Str::slug($nombre, '-');
                if (!Storage::disk('uploads')->exists($uri . '/' . $slug)) {
                    $url = $uri . '/' . $slug;
                    $bucket = new Buckets();
                    $bucket->nombre = $nombre;
                    $bucket->slug = $slug;
                    $bucket->url = $url;
                    $bucket->region = $region;
                    $bucket->accceso = $acceso;
                    $bucket->user_id = $id;

                    if ($bucket->save()) {
                        Storage::disk('uploads')->makeDirectory($uri . '/' . $slug, 0775, true);
                        return redirect('/buckets')->with('message', 'Se creo con éxito el bucket')->with('typealert', 'success');
                    } else {
                        return back()->with('message', 'Hubo un error al crear el bucket')->with('typealert', 'danger');
                    }
                } else {
                    return back()->with('message', 'Ya existe el directorio')->with('typealert', 'warning');
                }
            } else {
                $slug = Str::slug($nombre, '-');
                if (!Storage::disk('uploads')->exists($uri . '/' . $slug)) {
                    $url = $uri . '/' . $slug;
                    $bucket = new Buckets();
                    $bucket->nombre = $nombre;
                    $bucket->slug = $slug;
                    $bucket->url = $url;
                    $bucket->region = $region;
                    $bucket->accceso = $acceso;
                    $bucket->user_id = $id;

                    if ($bucket->save()) {
                        Storage::disk('uploads')->makeDirectory($uri . '/' . $slug, 0775, true);
                        return redirect('/buckets')->with('message', 'Se creo con éxito el bucket')->with('typealert', 'success');
                        // return back()->with('message', 'Se creo con éxito el bucket')->with('typealert', 'success');
                    } else {
                        return back()->with('message', 'Hubo un error al crear el bucket')->with('typealert', 'danger');
                    }
                } else {
                    return back()->with('message', 'Ya existe el directorio')->with('typealert', 'warning');
                }
            }
            // Config::get('filesystems.disks.public.root');
        }
    }

    public function editBucket($slug)
    {
        $bucket = Buckets::where('slug', $slug)->first();
        $data = ['bucket' => $bucket];
        if (!is_null($bucket)) {
            return view('buckets.buckets.edit', $data);
        } else {
            return redirect('/buckets')->with('message', 'El bucket que quieres editar no se encuentra')->with('typealert', 'danger');
        }
    }

    public function posteditBucket($slug, Request $req)
    {

        $nombre = e($req->input('nombre'));
        $region = e($req->input('region'));
        $acceso = e($req->input('acceso'));
        $id = $req->user()->id;
        $key_id_user = $req->user()->key_id;
        $segments = Str::ucsplit($key_id_user);
        $guion = strpos($key_id_user, "-");
        if ($guion !== false) {
            $uri = substr($key_id_user, 0, $guion);
        }

        $rules = [
            'nombre' =>'unique:buckets',
            'region' => 'required',
            'acceso' => 'required',
        ];

        $messages = [
            'nombre.unique' => 'El nombre del bucket no se puede repetir',
            'region.required' => 'Por favor ingrese la region del bucket',
            'acceso.required' => 'Por favor ingrese el tipo de acceso del bucket',
        ];

        $bucket = Buckets::where('slug', $slug)->first();
        $validator = Validator::make($req->all(), $rules, $messages);
        if (is_null($bucket)) {
            return redirect('/buckets')->with('message', 'El bucket que quieres editar no se encuentra')->with('typealert', 'danger');
        } else {
            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                if ($nombre === $bucket->nombre) {
                    $bucket->region = $region;
                    $bucket->accceso = $acceso;
                    if ($bucket->save()) {
                        return redirect('/buckets')->with('message', 'Se edito con éxito el bucket: ' . $bucket->nombre)->with('typealert', 'success');
                    }
                } else {
                    $url = $bucket->url;
                    $slug = Str::slug($nombre, '-');
                    $url2 = $uri . '/' . $slug;
                    if (Storage::disk('uploads')->exists($url)) {
                        $delete = Storage::disk('uploads')->deleteDirectory($url);
                        if ($delete) {
                            $bucket->nombre = $nombre;
                            $bucket->slug = $slug;
                            $bucket->url = $url2;
                            $bucket->region = $region;
                            $bucket->accceso = $acceso;
                            if ($bucket->save()) {
                                Storage::disk('uploads')->makeDirectory($uri . '/' . $slug, 0775, true);
                                return redirect('/buckets')->with('message', 'Se edito con éxito el bucket: ' . $bucket->nombre)->with('typealert', 'success');
                            }
                        }
                    }
                }
            }
        }
    }

    public function deleteBucket($id)
    {
        $bucket = Buckets::find($id);
        $subbucket = Subbuckets::where('bucket_id', $id)->count();

        if (is_null($bucket)) {
            return redirect('404');
        } else {
            $url = $bucket->url;
            if (Storage::disk('uploads')->exists($url)) {
                if($subbucket > 0 ){
                    $sb = Subbuckets::where('bucket_id', $id)->delete();
                    if($sb){
                        if ($bucket->delete()) {
                            Storage::disk('uploads')->deleteDirectory($url);
                            return back()->with('message', 'El bucket que deseas borrar se borro con éxito.')->with('typealert', 'success');
                        }
                    }
                }else{
                    if ($bucket->delete()) {
                        Storage::disk('uploads')->deleteDirectory($url);
                        return back()->with('message', 'El bucket que deseas borrar se borro con éxito.')->with('typealert', 'success');
                    }
                }

            }
        }

    }

    public function getCreateBucket($nombre)
    {
        $bucket = Buckets::where('slug', $nombre)->first();
        if($bucket === null){
            return redirect('404');
        }
        $id = $bucket->id;
        $bnombre = $bucket->nombre;
        $data = ['nombre' => $bnombre, 'slug' => $nombre, 'id'=> $id];
        return view('buckets.buckets.create_sub', $data);
    }
}
