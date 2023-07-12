<!DOCTYPE html>
<html>
    <head>
        <title></title>

    </head>
    @include('adminHeader');
    <body>
<iframe height="700" width="100%" src="{{ asset('/uploads/files/' .$data->national_id_front) }}"></iframe>
</body>
</html>