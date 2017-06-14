
<html>
<head>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
<head>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
    ul{
        list-style-type: none;
        background-color: black;
        color:white;
    }
    li{
        border:1px solid green;
    }
    .ui-state-focus{
            color: red;
    }
    </style>
    <link rel="Stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<form>
    <input type="text" id="auto">
    <input type="text" id="response" disabled>

</form>

<script>
    $(function() {
        $("#auto").autocomplete({
            source: "getdata",
            minLength: 1,
            select: function( event, ui ) {
                $('#response').val(ui.item.id);
            }
        });
    });
</script>
</body>
</html>



