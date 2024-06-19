@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ clean(trans('niva-backend.section_projects'), ['Attr.EnableID' => true]) }}</h1>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ clean(trans('niva-backend.section_projects'), ['Attr.EnableID' => true]) }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <div class="row">
                    <!-- Your navigation buttons -->
                </div>

                @if ($message = Session::get('project_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <form action="{{ route('delete.project') }}" method="POST" class="form-inline">
                    @csrf
                    @method('DELETE')
                    <!-- Your form for deleting projects -->
                </form>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="options"></th>
                            <th scope="col">{{ clean(trans('niva-backend.photo'), ['Attr.EnableID' => true]) }}</th>
                            <th scope="col">{{ clean(trans('niva-backend.owner'), ['Attr.EnableID' => true]) }}</th>
                            <th scope="col">{{ clean(trans('niva-backend.title'), ['Attr.EnableID' => true]) }}</th>
                            <th scope="col">{{ clean(trans('niva-backend.category'), ['Attr.EnableID' => true]) }}</th>
                            <th scope="col">{{ clean(trans('niva-backend.body'), ['Attr.EnableID' => true]) }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <!-- Same as thead -->
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($projects)
                            @foreach($projects as $project)
                                <tr>
                                    <td><input class="checkboxes" type="checkbox" name="checkbox_array[]" value="{{ $project->id }}"></td>
                                    <td data-label="Photo">
                                        <img src="{{ $project->photo ? '/images/media/' . $project->photo->file : '/img/200x200.png' }}" alt="{{ $project->title }}" loading="lazy" class="img-fluid">
                                        <p class="mb-0 mt-2"><a href="{{ route('project.edit', $project->id) . '?language=' . request()->input('language') }}">{{ clean(trans('niva-backend.edit'), ['Attr.EnableID' => true]) }}</a></p>
                                    </td>
                                    <td data-label="OWNER">{{ $project->user->name }}</td>
                                    <td data-label="TITLE">{{ $project->title }}</td>
                                    <td data-label="Category">{{ $project->project_category ? $project->project_category->name : clean(trans('niva-backend.uncategorized'), ['Attr.EnableID' => true]) }}</td>
                                    <td class="body-project">{!! $project->body !!}</td>
                                </tr>
                             @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
