<div class="row">
    <h3>Upload File</h3>
    <div class="card col-sm-12">

        <form action="{{ url('/store') }}" method="POST" enctype="multipart/form-data" class="form-inline">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="file">Select File</label>
                <input class="form-control-file" type="file" name="file" id="file">
            </div>

            <button type="submit" class="btn btn-primary mb-2">Upload</button>

        </form>
    </div>
</div>

{{--<div class="row">--}}
{{--    <h3>Files</h3>--}}
{{--    <div class="card col-sm-12">--}}
{{--        @if (count($files) > 0)--}}
{{--            @foreach ($files as $file)--}}
{{--                <a href="{{ url($file['downloadUrl']) }}">{{ $file['name'] }}</a>--}}
{{--                <form action="{{ url($file['removeUrl']) }}" method="POST">--}}
{{--                    {{ csrf_field() }}--}}
{{--                    {{ method_field('DELETE') }}--}}
{{--                    <button type="submit" class="btn btn-default">Remove</button>--}}
{{--                </form>--}}
{{--            @endforeach--}}
{{--        @else--}}
{{--            <p>Nothing found</p>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}
