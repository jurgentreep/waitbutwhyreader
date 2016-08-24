@extends('master')

@section('content')
    <h1>Welcome</h1>
    <p>
        Hi,<br>
        <br>
        You've got two options for now, you can append the uri of the article like this:<br>
        <pre>waitbutwhyreader.com/<strong>&lt;uri&gt;</strong></pre><br>
        Or browse to the article you want on <a target="_blank" href="http://waitbutwhy.com">waitbutwhy.com</a> and add the word <strong>reader</strong> after <strong>waitbutwhy</strong> like this:<br>
        <pre>waitbutwhy<strong>reader</strong>.com</pre><br>
        An example url would look something like this:<br>
        <a href="http://waitbutwhyreader.com/2016/03/cryonics.html">waitbutwhyreader.com/2016/03/cryonics.html</a><br>
        <br>
        I plan to replace this page with a page where you can easily browse through the different posts later.<br>
    </p>
@endsection
