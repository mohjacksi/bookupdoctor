<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySpecialtyRequest;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use App\Models\Specialty;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SpecialtiesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('specialty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Specialty::query()->select(sprintf('%s.*', (new Specialty)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'specialty_show';
                $editGate      = 'specialty_edit';
                $deleteGate    = 'specialty_delete';
                $crudRoutePart = 'specialties';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('icon', function ($row) {
                if ($photo = $row->icon) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'icon']);

            return $table->make(true);
        }

        return view('admin.specialties.index');
    }

    public function create()
    {
        abort_if(Gate::denies('specialty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialties.create');
    }

    public function store(StoreSpecialtyRequest $request)
    {
        $specialty = Specialty::create($request->all());

        if ($request->input('icon', false)) {
            $specialty->addMedia(storage_path('tmp/uploads/' . $request->input('icon')))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $specialty->id]);
        }

        return redirect()->route('admin.specialties.index');
    }

    public function edit(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialties.edit', compact('specialty'));
    }

    public function update(UpdateSpecialtyRequest $request, Specialty $specialty)
    {
        $specialty->update($request->all());

        if ($request->input('icon', false)) {
            if (!$specialty->icon || $request->input('icon') !== $specialty->icon->file_name) {
                if ($specialty->icon) {
                    $specialty->icon->delete();
                }

                $specialty->addMedia(storage_path('tmp/uploads/' . $request->input('icon')))->toMediaCollection('icon');
            }
        } elseif ($specialty->icon) {
            $specialty->icon->delete();
        }

        return redirect()->route('admin.specialties.index');
    }

    public function show(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialty->load('specialtiesDoctors');

        return view('admin.specialties.show', compact('specialty'));
    }

    public function destroy(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialty->delete();

        return back();
    }

    public function massDestroy(MassDestroySpecialtyRequest $request)
    {
        Specialty::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('specialty_create') && Gate::denies('specialty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Specialty();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
