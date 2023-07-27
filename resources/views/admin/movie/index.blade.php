@extends('admin.layouts.base')
@section('title','Movies')

@section('content')
{{-- alert --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

{{-- tambah data --}}
<div class="row">
    <div class="col-md-12">
         <div class="card" id="my-card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data</h3>
            <div class="card-tools">
            <!-- Collapse Button -->
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {{-- form tambah movie --}}
        <form enctype="multipart/form-data" method="POST" action="{{ route('admin.movie.index') }}">
            @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="e.g Guardian of The Galaxy" value="{{ @old('title') }}">
          </div>
          <div class="form-group">
            <label for="trailer">Trailer</label>
            <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Movie Name" value="{{ @old('trailer') }}">
          </div>
          <div class="form-group">
            <label for="movie">Movie</label>
            <input type="text" class="form-control" id="movie" name="movie" placeholder="Video url" value="{{ @old('movie') }}">
          </div>
          <div class="form-group">
            <label for="duration">Duration</label>
            <input type="text" class="form-control" id="duration" name="duration" placeholder="1h 39m" value="{{ @old('duration') }}">
          </div>
          <div class="form-group">
            <label>Date:</label>
            <div class="input-group date" id="release-date" data-target-input="nearest">
              <input type="text" name="release_date" class="form-control datetimepicker-input" value="{{ @old('release_date') }}" data-target="#release-date"/>
              <div class="input-group-append" data-target="#release-date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="short-about">Casts</label>
            <input type="text" class="form-control" id="short-about" name="casts" placeholder="Jackie Chan"value="{{ @old('casts') }}">
          </div>
          <div class="form-group">
            <label for="short-about">Categories</label>
            <input type="text" class="form-control" id="short-about" name="categories" placeholder="Action, Fantasy" value="{{ @old('categories') }}">
          </div>
          <div class="form-group">
            <label for="small-thumbnail">Small Thumbnail</label>
            <input type="file" class="form-control" name="small_thumbnail" value="{{ @old('small_thumbnail') }}">
          </div>
          <div class="form-group">
            <label for="large-thumbnail">Large Thumbnail</label>
            <input type="file" class="form-control" name="large_thumbnail" value="{{ @old('large_thumbnail') }}">
          </div>
          <div class="form-group">
            <label for="short-about">Short About</label>
            <input type="text" class="form-control" id="short-about" name="short_about" placeholder="Awesome Movie" value="{{ @old('short_about') }}">
          </div>
          <div class="form-group">
            <label for="short-about">About</label>
            <input type="text" class="form-control" id="about" name="about" placeholder="Awesome Movie" value="{{ @old('about') }}">
          </div>
          <div class="form-group">
            <label>Featured</label>
            <select class="custom-select" name="featured">
              <option value="0" {{ @old('featured') === "0" ? "selected" : "" }}>No</option>
              <option value="1" {{ @old('featured') === "1" ? "selected" : "" }}>Yes</option>
            </select>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
        </div>
    </div>
    </div>
</div>

{{-- Tabel Movie --}}
  <div class="row">
    <div class="col-md-12">
      <div class="card card-dark">
        <div class="card-header">
          <h3 class="card-title">Movies</h3>
        </div>

        <div class="card-body">
          {{-- <div class="row">
            <div class="col-md-12 mb-2">
              <a href="" class="btn btn-warning">Create Movie</a>
            </div>
          </div> --}}

          <div class="row">
            <div class="col-md-12">
              <table id="movieTable" class="table table-bordered table-hover movie">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Categories</th>
                    <th>Casts</th>

                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $data )
                    <tr>
                        <td>{{ $data->title }}</td>
                        <td>
                            <img src="{{asset('storage/thumbnail/'. $data->small_thumbnail)}}" width="50px" >
                        </td>
                        <td>{{ $data->categories }}</td>
                        <td>{{ $data->casts }}</td>
                        <td>
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Action
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.movie.edit',[$data->id]) }}">Edit</a>
                                <form action="{{ route('admin.movie.destroy',$data->id) }}" method="POST">
                                      @method('delete')
                                      @csrf
                                      <button class="dropdown-item" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
    <script>
        $('.movie').DataTable();
    </script>
    <script>
        $('#my-card').CardWidget()
    </script>
    <script>
        $('#release-date').datetimepicker({
            format: 'yyyy-MM-DD'
        });
    </script>
@endsection


