@extends('layouts.layout')

@section('content')
<<<<<<< HEAD
    <style>
        .count {
            background-color: #f5f5f5;
            padding: 20px 0;
            border-radius: 5px;
        }

        .count-title {
            font-size: 40px;
            font-weight: normal;
            margin-top: 10px;
            margin-bottom: 0;
            text-align: center;
        }

        .count-text {
            font-size: 15px;
            font-weight: normal;
            margin-top: 10px;
            margin-bottom: 0;
            text-align: center;
        }

        .fa-2x {
            margin: 0 auto;
            float: none;
            display: table;
            color: #4ad1e5;
        }
    </style>

    <div class="container home">
        <!-- Banner Section -->
        <div class="container d-sm-flex justify-content-center mt-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($banners as $index => $banner)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($banners as $index => $banner)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $banner->image_path) }}" class="d-block w-100" alt="Banner Image">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="container card-cart d-sm-flex justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="chart" style="height: 350px;">
                            <canvas id="barChart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publication Counts Section -->
        <div class="container mt-3">
            <div class="row text-center">
                <div class="col">
                    <div class="count" id="all"></div>
                </div>
                <div class="col">
                    <div class="count" id="scopus"></div>
                </div>
                <div class="col">
                    <div class="count" id="wos"></div>
                </div>
                <div class="col">
                    <div class="count" id="tci"></div>
                </div>
            </div>
        </div>

        <!-- Modal for Reference -->
        <div class="modal" id="myModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reference (APA)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="name"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publications List Section -->
        <div class="container mixpaper pb-10 mt-3">
            <h3>{{ trans('message.publications') }}</h3>
            @foreach ($papers as $n => $pe)
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{$n}}" aria-expanded="true" aria-controls="collapseOne">
                                @if (!$loop->last)
                                    {{$n}}
                                @else
                                    Before {{$n}}
                                @endif
                            </button>
                        </h2>
                        <div id="collapse{{$n}}" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach($pe as $p)
                                    <div class="row mt-2 mb-3 border-bottom">
                                        <div id="number" class="col-sm-1">
                                            <h6>[{{$loop->index + 1}}]</h6>
                                        </div>
                                        <div id="paper2" class="col-sm-11">
                                            <p class="hidden">
                                                <b>{{$p['paper_name']}}</b> (<link>{{$p['author']}}</link>), {{$p['paper_sourcetitle']}}, {{$p['paper_volume']}},
                                                {{$p['paper_yearpub']}}.
                                                <a href="{{$p['paper_url']}}" target="_blank">[url]</a> 
                                                <a href="https://doi.org/{{$p['paper_doi']}}" target="_blank">[doi]</a>
                                                <button style="padding: 0;" class="btn btn-link open_modal" value="{{$p['id']}}">[{{ trans('message.Reference') }}]</button>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
=======
<div class="container home">
    <div class="container d-sm-flex justify-content-center mt-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($banners as $index => $banner)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($banners as $index => $banner)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        @php
                            // ตรวจสอบภาษาปัจจุบัน
                            $lang = session('applocale', 'th'); // ใช้ session('applocale', 'th') แทน
                            
                            // เลือกแสดงภาพตามภาษา
                            if ($lang === 'th') {
                                $imagePath = $banner->image_path_th;
                            } elseif ($lang === 'en') {
                                $imagePath = $banner->image_path_en;
                            } elseif ($lang === 'zh') {
                                $imagePath = $banner->image_path_zh;
                            } else {
                                $imagePath = $banner->image_path_th; // ค่าเริ่มต้นเป็นภาษาไทย
                            }
                        @endphp
                        <img src="{{ asset('storage/' . $imagePath) }}" class="d-block w-100" alt="Banner Image">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<div class="container card-cart d-sm-flex justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="chart" style="height: 350px;">
                    <canvas id="barChart1"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="container mt-3">
    <div class="row text-center">
        <div class="col">
            <div class="count" id='all'></div>
        </div>
        <div class="col">
            <div class="count" id='scopus'></div>
        </div>
        <div class="col">
            <div class="count" id='wos'></div>
        </div>
        <div class="col">
            <div class="count" id='tci'></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reference (APA)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="name"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container mixpaper pb-10 mt-3">
    <h3>{{ trans('message.publications') }}</h3>
    @foreach($papers as $n => $pe)
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$n}}" aria-expanded="true" aria-controls="collapseOne">
                        @if (!$loop->last)
                            {{$n}}
                        @else
                            Before {{$n}}
                        @endif
                    </button>
                </h2>
                <div id="collapse{{$n}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @foreach($pe as $n => $p)
                            <div class="row mt-2 mb-3 border-bottom">
                                <div id="number" class="col-sm-1">
                                    <h6>[{{$n+1}}]</h6>
                                </div>
                                <div id="paper2" class="col-sm-11">
                                    <p class="hidden">
                                        <b>{{$p['paper_name']}}</b> (<link>{{$p['author']}}</link>), {{$p['paper_sourcetitle']}}, {{$p['paper_volume']}},
                                        {{$p['paper_yearpub']}}.
                                        <a href="{{$p['paper_url']}}" target="_blank">[url]</a> <a href="https://doi.org/{{$p['paper_doi']}}" target="_blank">[doi]</a>
                                        <button style="padding: 0;" class="btn btn-link open_modal" value="{{$p['id']}}">[อ้างอิง]</button>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
>>>>>>> c1a2cdf63af96119ce5aad2bdbeaed9987827f05

    <!-- JS for Chart and Counting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        var year = <?php echo $year; ?>;
        var paper_tci = <?php echo $paper_tci; ?>;
        var paper_scopus = <?php echo $paper_scopus; ?>;
        var paper_wos = <?php echo $paper_wos; ?>;

        var areaChartData = {
            labels: year,
            datasets: [
                {
                    label: 'SCOPUS',
                    backgroundColor: '#3994D6',
                    data: paper_scopus
                },
                {
                    label: 'TCI',
                    backgroundColor: '#83E4B5',
                    data: paper_tci
                },
                {
                    label: 'WOS',
                    backgroundColor: '#FCC29A',
                    data: paper_wos
                },
            ]
        };

        var barChartCanvas = $('#barChart1').get(0).getContext('2d');
        new Chart(barChartCanvas, {
            type: 'bar',
            data: areaChartData,
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: { beginAtZero: true }
                    }]
                },
                title: {
                    display: true,
                    text: "{{ trans('message.Report5Year') }}"
                }
            }
        });
    </script>

    <!-- JS for Counting Numbers -->
    <script>
        var paper_tci = <?php echo $paper_tci_numall; ?>;
        var paper_scopus = <?php echo $paper_scopus_numall; ?>;
        var paper_wos = <?php echo $paper_wos_numall; ?>;
        var sum = paper_tci + paper_scopus + paper_wos;

        document.getElementById("all").innerHTML = `
            <i class="count-icon fa fa-book fa-2x"></i>
            <h2 class="timer count-title" data-to="${sum}" data-speed="1500"></h2>
            <p class="count-text ">{{ trans('message.Summary') }}</p>
        `;
        document.getElementById("scopus").innerHTML = `
            <i class="count-icon fa fa-book fa-2x"></i>
            <h2 class="timer count-title" data-to="${paper_scopus}" data-speed="1500"></h2>
            <p class="count-text ">SCOPUS</p>
        `;
        document.getElementById("wos").innerHTML = `
            <i class="count-icon fa fa-book fa-2x"></i>
            <h2 class="timer count-title" data-to="${paper_wos}" data-speed="1500"></h2>
            <p class="count-text ">WOS</p>
        `;
        document.getElementById("tci").innerHTML = `
            <i class="count-icon fa fa-book fa-2x"></i>
            <h2 class="timer count-title" data-to="${paper_tci}" data-speed="1500"></h2>
            <p class="count-text ">TCI</p>
        `;
    </script>

    <!-- Modal Reference JS -->
    <script>
        $(document).on('click', '.open_modal', function() {
            var tour_id = $(this).val();
            $.get('/bib/' + tour_id, function(data) {
                document.getElementById("name").innerHTML = `${data}`;
                $('#myModal').modal('show');
            });
        });
    </script>
@endsection
