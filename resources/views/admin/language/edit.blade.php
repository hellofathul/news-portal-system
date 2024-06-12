@extends("admin.layouts.master")

@section("content")
<section class="section">
    <div class="section-header">
        <h1>Language</h1>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h4>Edit Language</h4>
        </div>
        <div class="card-body">
            <form action="{{ route("admin.language.update", $language->id) }}" method="post">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="">Language</label>
                    <select name="language" id="language-select" class="form-control select2">
                        <option value="">--Select--</option>
                        @foreach (config("language") as $key => $lang)
                        <option @if ($language->language === $key) selected @endif value="{{ $key }}">{{ $lang["name"] }}
                        </option>
                        @endforeach
                    </select>
                    @error("language")
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <input name="name" value="{{ $language->name }}" readonly type="text" class="form-control"
                        id="name">
                    @error("name")
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Slug</label>
                    <input name="slug" value="{{ $language->slug }}" readonly type="text" class="form-control"
                        id="slug">
                    @error("slug")
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Default language?</label>
                    <select name="default" id="" class="form-control">
                        <option {{$language->default === 0 ? "selected" : ""}} value="0">No</option>
                        <option {{$language->default === 1 ? "selected" : ""}} value="1">Yes</option>
                    </select>
                    @error("default")
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{$language->status === 1 ? "selected" : ""}} value="1">Active</option>
                        <option {{$language->status === 0 ? "selected" : ""}} value="0">Inactive</option>
                    </select>
                    @error("status")
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
</section>
@endsection

<!-- jQuery: Set the value for slug and name input -->
@push("scripts")
    <script>
        $(document).ready(function () {
            $("#language-select").on("change", function () {
                let value = $(this).val();
                let name = $(this).children(":selected").text();
                $("#slug").val(value);
                $("#name").val(name);
            })
        })
    </script>
@endpush