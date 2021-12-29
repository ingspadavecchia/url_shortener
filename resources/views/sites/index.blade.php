@extends('sites.layout')

@section('content')
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>URL Shortener</h2>
            </div>
            <div class="pull-right">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sites.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>URL to short:</strong>
                                <input type="text" name="long_url" class="form-control" placeholder="https://example.com">
                                <button type="submit" class="btn btn-primary">Short!</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Long URL</th>
            <th>Short URL</th>
            <th>Title</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($crawledSites as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->long_url }}</td>
                <td>{{ $value->short_url }}</td>
                <td>{{ $value->title }}</td>
                <td>
                    <form action="{{ route('sites.destroy',$value->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
