<form action="{{ route('test') }}" method="post" enctype="multipart/form-data">
@csrf
<input type="file" name="files" multiple>
<input type="submit" value="Submit">
</form>