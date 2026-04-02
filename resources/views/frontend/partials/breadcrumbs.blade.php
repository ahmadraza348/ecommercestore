<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            
                            @php
                                $segments = Request::segments();
                                $url = '';
                            @endphp

                            @foreach ($segments as $index => $segment)
                                @php
                                    $url .= '/' . $segment;
                                @endphp
                                
                                @if ($index < count($segments) - 1)
                                    <li class="breadcrumb-item">
                                        <a href="{{ url($url) }}">{{ ucfirst(str_replace('-', ' ', $segment)) }}</a>
                                    </li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ ucfirst(str_replace('-', ' ', $segment)) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>