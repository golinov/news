@section('sidebar')
    <div class="sidebar" style="float: left; width: 20%">
        <nav class="sidebar-nav">
            <ul>
                <li><h5>Categories:</h5>
                    <ul>
                        @foreach($categories as $category)
                            <li>
                                <a
                                    href="{{ url(request()->fullUrlWithQuery(['category' => $category->id])) }}"
                                    class="btn btn-outline-success my-2 my-sm-0"
                                >
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li style="margin-top: 5px">
                    <a
                        href="{{ url(request()->fullUrlWithQuery(['popular' => 'true'])) }}"
                        class="btn btn-outline-success my-2 my-sm-0"
                    >
                        Popular
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
