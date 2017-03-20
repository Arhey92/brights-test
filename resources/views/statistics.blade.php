@if(Request::url() === url('/view-statistics'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
@endif

<div class="content">
    @if(!empty($data))
        <table class="striped">
            <thead>
            <tr>
                <th data-field="id">Title</th>
                <th data-field="name">Status</th>
                @if(Request::url() === url('/view-statistics'))
                    <th data-field="price">URL</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($data as $urlInfo)
                <tr>
                    <td>{{$urlInfo['title']}}</td>
                    <td>{{$urlInfo['status']}}</td>
                    @if(Request::url() === url('/view-statistics'))
                        <td><a href="{{url("/show-diagram/".$urlInfo['id'])}}">{{$urlInfo['url']}}</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>