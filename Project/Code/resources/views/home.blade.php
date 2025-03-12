@extends('layouts.layout')
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

    /* highlight */
    .section-title {
        display: flex;
        justify-content: center;
    }

    <<<<<<< HEAD .section-title {
        text-align: center;
        font-size: 3rem;
        /* ปรับเป็นขนาดที่เหมาะสม */
        color: #333;
        margin-bottom: 30px;
        width: 100%;
    }

    =======.highlights-container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        gap: ;
    }

    >>>>>>>298e6cbf87fa4e416eaa971558d3682a4148151c .highlight-item {
        width: 100%;
        max-width: 350px;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .highlight-item:hover {
        transform: translateY(-10px);
    }

    .highlight-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: #444;
    }

    .highlight-detail {
        font-size: 1.2rem;
        color: #555;
        margin-top: 10px;
    }

    .thumbnail-container {
        text-align: center;
        margin-top: 20px;
    }

    .highlight-thumbnail {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .tags-list {
        list-style-type: none;
        padding: 0;
        margin-top: 15px;
    }

    .tag-item {
        display: inline-block;
        background-color: #3498db;
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        margin-right: 10px;
        font-size: 1rem;
    }

    .no-tags {
        font-style: italic;
        color: #999;
        margin-top: 15px;
    }

    .thumbnail-container img {
        width: 100%;
        max-width: 300px;
        height: auto;
    }

    .more-card {
        display: none;
    }

    .load-more-btn {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .load-more-btn:hover {
        background-color: #2980b9;
    }

    /* การ์ดของไฮไลต์ */
    .highlight-card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin: 0 15px 30px 15px;
    }

    .highlight-card:hover {

        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15), 0 4px 6px rgba(0, 0, 0, 0.08);
    }

    .image-container {
        position: relative;
        width: 100%;
        height: 250px;
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .highlight-details {
        padding: 20px;
        text-align: left;
        background: #f9f9f9;
    }

    .tags-list {
        list-style: none;
        padding: 0;
        margin: 0 0 10px 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .tag-item {
        display: inline-block;
        background: linear-gradient(90deg, #007bff, #0056b3);
        color: white;
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 20px;
        font-weight: 500;
        text-transform: uppercase;
    }

    .no-tags {
        font-size: 13px;
        color: #888;
        margin: 0 0 10px 0;
        font-style: italic;
    }

    .highlight-title {
        font-size: 18px;
        font-weight: 600;
        color: #222;
        margin: 0 0 10px 0;
        line-height: 1.5;
        transition: color 0.3s ease;
    }

    .highlight-title:hover {
        color: #007bff;
    }

    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }

    .content-highlight {
        margin: 0;
        padding: 0;
    }

    a.text-black {
        text-decoration: none;
        color: #333;
        display: block;
    }

    a.text-black:hover {
        text-decoration: none;
    }

    /* ปุ่มอ่านเพิ่มเติม */
    .read-more-container {
        text-align: center;
        margin-top: 10px;
        padding-bottom: 30px;
    }

    .read-more-btn {
        display: inline-block;
        background: linear-gradient(90deg, #007bff, #00aaff);
        color: white;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 25px;
        text-decoration: none;
        transition: background 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }

    .read-more-btn:hover {
        color: white;
        text-decoration: none;
        background: linear-gradient(90deg, #0056b3, #0099ff);
        box-shadow: 0 6px 12px rgba(0, 123, 255, 0.4);
    }
</style>
@section('content')
<div class="container home">
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
                    @php
                    // ตรวจสอบภาษาปัจจุบัน
                    $lang = session('applocale', 'th'); // ใช้ session('applocale', 'th') แทน

                    // เลือกแสดงภาพตามภาษา
                    if ($lang === 'th') {
                    $imagePath = $banner->image_path_th;
                    $altText = 'Banner Image TH';
                    } elseif ($lang === 'en') {
                    $imagePath = $banner->image_path_en;
                    $altText = 'Banner Image EN';
                    } elseif ($lang === 'zh') {
                    $imagePath = $banner->image_path_zh;
                    $altText = 'Banner Image ZH';
                    } else {
                    $imagePath = $banner->image_path_th; // ค่าเริ่มต้นเป็นภาษาไทย
                    $altText = 'Banner Image TH'; // ค่าเริ่มต้นเป็นภาษาไทย
                    }
                    @endphp
                    <img src="{{ asset('storage/' . $imagePath) }}" class="d-block w-100" alt="{{ $altText }}">
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<!-- Highlight -->
<div class="col-12"
    style="background-image: url('https://api.computing.kku.ac.th//storage/images/1661921029-3.png'); background-position: center center; background-size: cover; padding: 15px; margin: 0px;">
    <div class="container">
        <div class="row mx-0">
            <div class="p-0 col-sm-12 col-md-12 col-lg-12">
                <div class="w-100 h-100">
                    <div class="w-100 h-100">
                        <div>
                            <h2 style="color:white;font-weight:bold;text-align:center;">Highlights</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- รวมทั้งสองแถวใน col-12 เดียว -->
<div class="col-12" style="padding: 0px; margin-top: 20px;">
    <div class="w-100 h-80">
        <!-- แถวที่ 1: แสดง 3 รูปแรก -->
        <div class="row mx-0" style="margin-bottom: 3px;">
            @foreach($highlights->take(3) as $highlight)
            <div class="p-0 col-sm-12 col-md-4 col-lg-4">
                <div class="highlight-card" style="padding: 0;">
                    <div data-v-2db70b80="" class="row content-highlight mx-0">
                        <div data-v-2db70b80="" class="p-0 col-12">
                            <a href="{{ route('highlight.show', ['id' => $highlight->id]) }}" class="text-black">
                                <div class="image-container">
                                    <img data-v-2db70b80="" src="{{ Storage::url($highlight->thumbnail) }}"
                                        alt="{{ $highlight->title ?? 'default_no_image' }}"
                                        sizes="(max-width: 640px) 100vw, (max-width: 768px) 100vw, 100vw"
                                        srcset="{{ Storage::url($highlight->thumbnail) }} 640w, {{ Storage::url($highlight->thumbnail) }} 768w, {{ Storage::url($highlight->thumbnail) }} 1024w"
                                        style="height: auto; width: 100%;">
                                </div>
                                    <h3 class="highlight-title">{{ $highlight->title ?? 'ชื่อเรื่องเริ่มต้น' }}</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- แถวที่ 2: แสดง 3 รูปถัดไป (ลำดับ 4-6) -->
        <div class="row mx-0">
            @foreach($highlights->slice(3, 3) as $highlight)
            <div class="p-0 col-sm-12 col-md-4 col-lg-4">
                <div class="highlight-card" style="0;">
                    <div data-v-2db70b80="" class="row content-highlight mx-0">
                        <div data-v-2db70b80="" class="p-0 col-12">
                            <a href="{{ route('highlight.show', ['id' => $highlight->id]) }}" class="text-black">
                                <div class="image-container">
                                    <img data-v-2db70b80="" src="{{ Storage::url($highlight->thumbnail) }}"
                                        alt="{{ $highlight->title ?? 'default_no_image' }}"
                                        sizes="(max-width: 640px) 100vw, (max-width: 768px) 100vw, 100vw"
                                        srcset="{{ Storage::url($highlight->thumbnail) }} 640w, {{ Storage::url($highlight->thumbnail) }} 768w, {{ Storage::url($highlight->thumbnail) }} 1024w"
                                        style="height: auto; width: 100%;">
                                </div>
                                <div class="highlight-details">
                                    @if($highlight->tags->count() > 0)
                                    <ul class="tags-list">
                                        @foreach($highlight->tags as $tag)
                                        <li class="tag-item">{{ $tag->name }}</li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p class="no-tags">No tags available for this highlight.</p>
                                    @endif
                                    <h3 class="highlight-title">{{ $highlight->title ?? 'ชื่อเรื่องเริ่มต้น' }}</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- ปุ่มอ่านเพิ่มเติม -->
        <div class="read-more-container">
            <a href="/more-highlights" class="read-more-btn">อ่านเพิ่มเติม</a>
        </div>
    </div>
</div>

<!-- ปุ่ม "More" ถ้ามีการ์ดเพิ่มเติม -->
<!-- @if($highlights->count() > 3)
                                        <button id="load-more" class="load-more-btn">More</button>
                                    @endif
                                    </div> -->

<div class="container card-cart d-sm-flex justify-content-center mt-0">
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
                    @foreach($pe as $n => $p)
                    <div class="row mt-2 mb-3 border-bottom">
                        <div id="number" class="col-sm-1">
                            <h6>[{{$n + 1}}]</h6>
                        </div>
                        <div id="paper2" class="col-sm-11">
                            <p class="hidden">
                                <b>{{$p['paper_name']}}</b> (
                                <link>{{$p['author']}}</link>), {{$p['paper_sourcetitle']}}, {{$p['paper_volume']}},
                                {{$p['paper_yearpub']}}.
                                <a href="{{$p['paper_url']}}" target="_blank">[url]</a> <a
                                    href="https://doi.org/{{$p['paper_doi']}}" target="_blank">[doi]</a>
                                <button style="padding: 0;" class="btn btn-link open_modal"
                                    value="{{$p['id']}}">[{{ trans('message.reference') }}]</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    $(document).ready(function() {
        $(".moreBox").slice(0, 1).show();
        if ($(".blogBox:hidden").length != 0) {
            $("#loadMore").show();
        }
        $("#loadMore").on('click', function(e) {
            e.preventDefault();
            $(".moreBox:hidden").slice(0, 1).slideDown();
            if ($(".moreBox:hidden").length == 0) {
                $("#loadMore").fadeOut('slow');
            }
        });
    });
</script>
<script>
    var year = <?php echo $year; ?>;
    var paper_tci = <?php echo $paper_tci; ?>;
    var paper_scopus = <?php echo $paper_scopus; ?>;
    var paper_wos = <?php echo $paper_wos; ?>;
    var areaChartData = {

        labels: year,

        datasets: [{
                label: 'SCOPUS',
                backgroundColor: '#3994D6',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: '#3994D6',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: '#3994D6',
                data: paper_scopus
            },
            {
                label: 'TCI',
                backgroundColor: '#83E4B5',
                borderColor: 'rgba(255, 255, 255, 0.5)',
                pointRadius: false,
                pointColor: '#83E4B5',
                pointStrokeColor: '#3b8bba',
                pointHighlightFill: '#fff',
                pointHighlightStroke: '#83E4B5',
                data: paper_tci
            },
            {
                label: 'WOS',
                backgroundColor: '#FCC29A',
                borderColor: 'rgba(0, 0, 255, 1)',
                pointRadius: false,
                pointColor: '#FCC29A',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: '#FCC29A',
                data: paper_wos
            },
        ]
    }



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart1').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
        scales: {
            yAxes: [{
                formatter: function() {
                    return Math.abs(this.value);
                },
                scaleLabel: {
                    display: true,
                    labelString: '{{ trans('
                    message.numberChart ') }}',

                },
                ticks: {
                    reverse: false,
                    stepSize: 10
                },
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: '{{ trans('
                    message.yearChart ') }}',
                }
            }]
        },

        title: {
            display: true,
            text: '{{ trans('
            message.reporttotal ') }}',
            fontSize: 20
        }


    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
</script>
<script>
    var paper_tci = <?php echo $paper_tci_numall; ?>;
    var paper_scopus = <?php echo $paper_scopus_numall; ?>;
    var paper_wos = <?php echo $paper_wos_numall; ?>;
    //console.log(paper_scopus)
    let sumtci = paper_tci;
    let sumsco = paper_scopus;
    let sumwos = paper_wos;
    (function($) {

        let sum = paper_wos + paper_tci + paper_scopus;
        //console.log(sum);
        //$("#scopus").append('data-to="100"');
        document.getElementById("all").innerHTML += `
                                                                <i class="count-icon fa fa-book fa-2x"></i>
                                                                <h2 class="timer count-title count-number" data-to="${sum}" data-speed="1500"></h2>
                                                                <p class="count-text ">SUMMARY</p>`
        document.getElementById("scopus").innerHTML += `
                                                                <i class="count-icon fa fa-book fa-2x"></i>
                                                                <h2 class="timer count-title count-number" data-to="${sumsco}" data-speed="1500"></h2>
                                                                <p class="count-text ">SCOPUS</p>`
        document.getElementById("wos").innerHTML += `
                                                                <i class="count-icon fa fa-book fa-2x"></i>
                                                                <h2 class="timer count-title count-number" data-to="${sumwos}" data-speed="1500"></h2>
                                                                <p class="count-text ">WOS</p>`
        document.getElementById("tci").innerHTML += `
                                                                <i class="count-icon fa fa-book fa-2x"></i>
                                                                <h2 class="timer count-title count-number" data-to="${sumtci}" data-speed="1500"></h2>
                                                                <p class="count-text ">TCI</p>`
        //document.getElementById("scopus").appendChild('data-to="100"');
        $.fn.countTo = function(options) {
            options = options || {};

            return $(this).each(function() {
                // set options for current element
                var settings = $.extend({}, $.fn.countTo.defaults, {
                    from: $(this).data('from'),
                    to: $(this).data('to'),
                    speed: $(this).data('speed'),
                    refreshInterval: $(this).data('refresh-interval'),
                    decimals: $(this).data('decimals')
                }, options);

                // how many times to update the value, and how much to increment the value on each update
                var loops = Math.ceil(settings.speed / settings.refreshInterval),
                    increment = (settings.to - settings.from) / loops;

                // references & variables that will change with each update
                var self = this,
                    $self = $(this),
                    loopCount = 0,
                    value = settings.from,
                    data = $self.data('countTo') || {};

                $self.data('countTo', data);

                // if an existing interval can be found, clear it first
                if (data.interval) {
                    clearInterval(data.interval);
                }
                data.interval = setInterval(updateTimer, settings.refreshInterval);

                // initialize the element with the starting value
                render(value);

                function updateTimer() {
                    value += increment;
                    loopCount++;

                    render(value);

                    if (typeof(settings.onUpdate) == 'function') {
                        settings.onUpdate.call(self, value);
                    }

                    if (loopCount >= loops) {
                        // remove the interval
                        $self.removeData('countTo');
                        clearInterval(data.interval);
                        value = settings.to;

                        if (typeof(settings.onComplete) == 'function') {
                            settings.onComplete.call(self, value);
                        }
                    }
                }

                function render(value) {
                    var formattedValue = settings.formatter.call(self, value, settings);
                    $self.html(formattedValue);
                }
            });
        };

        $.fn.countTo.defaults = {
            from: 0, // the number the element should start at
            to: 0, // the number the element should end at
            speed: 1000, // how long it should take to count between the target numbers
            refreshInterval: 100, // how often the element should be updated
            decimals: 0, // the number of decimal places to show
            formatter: formatter, // handler for formatting the value before rendering
            onUpdate: null, // callback method for every time the element is updated
            onComplete: null // callback method for when the element finishes updating
        };

        function formatter(value, settings) {
            return value.toFixed(settings.decimals);
        }
    }(jQuery));

    jQuery(function($) {
        // custom formatting example
        $('.count-number').data('countToOptions', {
            formatter: function(value, options) {
                return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
            }
        });

        // start all the timers
        $('.timer').each(count);

        function count(options) {
            var $this = $(this);
            options = $.extend({}, options || {}, $this.data('countToOptions') || {});
            $this.countTo(options);
        }
    });
</script>
<script>
    $(document).on('click', '.open_modal', function() {
        //var url = "domain.com/yoururl";
        var tour_id = $(this).val();
        $.get('/bib/' + tour_id, function(data) {
            //success data
            console.log(data);
            $(".bibtex-biblio").remove();
            document.getElementById("name").innerHTML += `${data}`
            // $('#tour_id').val(data.id);
            // $('#name').val(data);
            // $('#details').val(data.details);
            // $('#btn-save').val("update");
            $('#myModal').modal('show');
        })
    });
</script>
@endsection