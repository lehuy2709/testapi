<form action="{{Route('users.postFormImport')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <input type="file" name="file" />

        <button type="submit" class="btn btn-primary">Import</button>
    </div>
</form>
