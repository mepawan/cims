<?php $this->load->view('part/head');?>

<body class="theme-dark">
<?php $this->load->view('/part/left_menu'); ?>
<?php $this->load->view('/part/top_menu'); ?>
<section class="page-content">
	<div class="page-content-inner">

		<!-- Dashboard -->
		<div class="dashboard-container">
			<div class="row">
				<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
					<div class="widget widget-seven background-success">
						<div class="widget-body">
							<div href="javascript: void(0);" class="widget-body-inner">
								<h5 class="text-uppercase">Week Sales</h5>
								<i class="counter-icon icmn-cash3"></i>
								<span class="counter-count">
									<i class="icmn-arrow-up5"></i>
									$<span class="counter-init" data-from="25" data-to="942"></span>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
					<div class="widget widget-seven background-default">
						<div class="widget-body">
							<div href="javascript: void(0);" class="widget-body-inner">
								<h5 class="text-uppercase">Server Uptime</h5>
								<i class="counter-icon icmn-server"></i>
								<span class="counter-count">
									<i class="icmn-arrow-down5"></i>
									<span class="counter-init" data-from="0" data-to="99"></span>%
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
					<div class="widget widget-seven">
						<div class="widget-body">
							<div href="javascript: void(0);" class="widget-body-inner">
								<h5 class="text-uppercase">New Clients</h5>
								<i class="counter-icon icmn-users"></i>
								<span class="counter-count">
									<i class="icmn-arrow-up5"></i>
									<span class="counter-init" data-from="0" data-to="67"></span>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
					<div class="widget widget-seven">
						<div class="widget-body">
							<div href="javascript: void(0);" class="widget-body-inner">
								<h5 class="text-uppercase">Subscriptions</h5>
								<i class="counter-icon icmn-users"></i>
								<span class="counter-count">
									<i class="icmn-arrow-up5"></i>
									<span class="counter-init" data-from="0" data-to="356"></span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-6">
					<div class="widget widget-six">
						<div class="widget-header">
							<div class="dropdown pull-right">
								<a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<i class="dropdown-inline-button-icon icmn-cog"></i>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="" role="menu">
									<a class="dropdown-item" href="javascript:void(0)">Remove</a>
									<a class="dropdown-item" href="javascript:void(0)">Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:void(0)">Remove All</a>
								</ul>
							</div>
							<strong class="margin-right-10">Sales Statistics, Billions</strong>
							<span class="margin-right-10 nowrap">
								<span class="donut donut-success"></span>
								Guns
							</span>
							<span class="margin-right-10 nowrap">
								<span class="donut donut-primary"></span>
								Girls
							</span>
							<span class="margin-right-10 nowrap">
								<span class="donut donut-yellow"></span>
								Drugs
							</span>
						</div>
						<div class="widget-body">
							<div class="chart-line height-250 chartist"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="widget widget-six">
						<div class="widget-header">
							<div class="dropdown pull-right">
								<a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<i class="dropdown-inline-button-icon icmn-cog"></i>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="" role="menu">
									<a class="dropdown-item" href="javascript:void(0)">Remove</a>
									<a class="dropdown-item" href="javascript:void(0)">Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:void(0)">Remove All</a>
								</ul>
							</div>
							<strong class="margin-right-10">Growth, %</strong>
							<span class="margin-right-10 nowrap">
								<span class="donut donut-primary"></span>
								Income
							</span>
							<span class="margin-right-10 nowrap">
								<span class="donut donut-success"></span>
								Outcome
							</span>
						</div>
						<div class="widget-body">
							<div class="chart-overlapping-bar height-250 chartist"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
					<div class="widget widget-seven">
						<div class="carousel-widget carousel slide" data-ride="carousel">
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<div class="widget-body">
										<div class="widget-body-icon">
											<i class="icmn-accessibility"></i>
										</div>
										<a href="javascript: void(0);" class="widget-body-inner">
											<h2>Sales Growth</h2>
											<p>View Report</p>
										</a>
									</div>
								</div>
								<div class="carousel-item">
									<div class="widget-body">
										<div class="widget-body-icon">
											<i class="icmn-download"></i>
										</div>
										<a href="javascript: void(0);" class="widget-body-inner">
											<h2>All Reports</h2>
											<p>Pdf Download</p>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
					<div class="widget widget-seven">
						<div class="carousel-widget-2 carousel slide" data-ride="carousel">
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<a href="javascript: void(0);" class="widget-body">
										<h2>
											<i class="icmn-database"></i> Databases
										</h2>
										<p>
											Total: 765
											<br />
											New: 36
										</p>
									</a>
								</div>
								<div class="carousel-item">
									<a href="javascript: void(0);" class="widget-body">
										<h2>
											<i class="icmn-users"></i> Users
										</h2>
										<p>
											Total: 24 467
											<br />
											New: 456
										</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
					<div class="widget widget-seven background-danger">
						<div class="carousel-widget carousel slide" data-ride="carousel">
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<a href="javascript: void(0);" class="widget-body">
										<h2>
											<i class="icmn-books"></i> Todo
										</h2>
										<p>
											1. Upgrade
											<br />
											2. Finish
										</p>
									</a>
								</div>
								<div class="carousel-item">
									<a href="javascript: void(0);" class="widget-body">
										<h2>
											<i class="icmn-download"></i> Finish
										</h2>
										<p>
											1. Upgrade
											<br />
											2. Prepare
										</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
					<div class="widget widget-seven background-info" style="background-image: url(../img/temp/photos/9.jpeg)">
						<div class="carousel-widget-2 carousel slide" data-ride="carousel">
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<a href="javascript: void(0);" class="widget-body">
										<h2>Clean</h2>
										<p>
											Simple
											<br />
											Responsive
										</p>
									</a>
								</div>
								<div class="carousel-item">
									<a href="javascript: void(0);" class="widget-body">
										<h2>Clean</h2>
										<p>
											Simple
											<br />
											Responsive
										</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-6">
					<div class="widget widget-three">
						<div class="example-calendar-block"></div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="widget widget-two">
						<div class="widget-header">
							<div class="dropdown pull-right">
								<a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<i class="dropdown-inline-button-icon icmn-folder-open"></i>
									<span class="hidden-lg-down">Issues History</span>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="" role="menu">
									<a class="dropdown-item" href="javascript:void(0)">Current search</a>
									<a class="dropdown-item" href="javascript:void(0)">Search for issues</a>
									<div class="dropdown-divider"></div>
									<div class="dropdown-header">Opened</div>
									<a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-checkmark"></i> CLNUI-253 Project implemen...</a>
									<a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-checkmark"></i> CLNUI-234 Active history iss...</a>
									<a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-clock"></i> CLNUI-424 Ionicons intergrat...</a>
									<a class="dropdown-item" href="javascript:void(0)">More...</a>
									<div class="dropdown-divider"></div>
									<div class="dropdown-header">Filters</div>
									<a class="dropdown-item" href="javascript:void(0)">My open issues</a>
									<a class="dropdown-item" href="javascript:void(0)">Reported by me</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:void(0)">Import issues from CSV</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-cog"></i> Settings</a>
								</ul>
							</div>
							Conversation: <strong>Software</strong>
						</div>
						<div class="widget-body clearfix">
							<div class="conversation-block custom-scroll" style="height: 260px">
								<div class="conversation-item">
									<div class="s1">
										<a class="avatar" href="javascript:void(0);">
											<img src="../img/temp/avatars/3.jpg" alt="Alternative text to the image" />
										</a>
									</div>
									<div class="s2">
										<strong>David Scott</strong>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
									</div>
								</div>
								<div class="conversation-item">
									<div class="s1">
										<a class="avatar" href="javascript:void(0);">
											<img src="../img/temp/avatars/3.jpg" alt="Alternative text to the image" />
										</a>
									</div>
									<div class="s2">
										<strong>Chris Smith</strong>
										<p>Lorem Ipsum is simply dummy text of the printing</p>
									</div>
								</div>
								<div class="conversation-item you">
									<div class="s1">
										<a class="avatar" href="javascript:void(0);">
											<img src="../img/temp/avatars/4.jpg" alt="Alternative text to the image" />
										</a>
									</div>
									<div class="s2">
										<strong>Donald Trump</strong>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy</p>
									</div>
								</div>
								<div class="conversation-item">
									<div class="s1">
										<a class="avatar" href="javascript:void(0);">
											<img src="../img/temp/avatars/3.jpg" alt="Alternative text to the image" />
										</a>
									</div>
									<div class="s2">
										<strong>David Scott</strong>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
									</div>
								</div>
								<div class="conversation-item you">
									<div class="s1">
										<a class="avatar" href="javascript:void(0);">
											<img src="../img/temp/avatars/4.jpg" alt="Alternative text to the image" />
										</a>
									</div>
									<div class="s2">
										<strong>Donald Trump</strong>
										<p>Ok. Thanks!</p>
									</div>
								</div>
								<div class="conversation-item you">
									<div class="s1">
										<a class="avatar" href="javascript:void(0);">
											<img src="../img/temp/avatars/4.jpg" alt="Alternative text to the image" />
										</a>
									</div>
									<div class="s2">
										<strong>Donald Trump</strong>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy</p>
									</div>
								</div>
								<div class="conversation-item">
									<div class="s1">
										<a class="avatar" href="javascript:void(0);">
											<img src="../img/temp/avatars/3.jpg" alt="Alternative text to the image" />
										</a>
									</div>
									<div class="s2">
										<strong>David Scott</strong>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
									</div>
								</div>
								<div class="conversation-item you">
									<div class="s1">
										<a class="avatar" href="javascript:void(0);">
											<img src="../img/temp/avatars/4.jpg" alt="Alternative text to the image" />
										</a>
									</div>
									<div class="s2">
										<strong>Donald Trump</strong>
										<p>Ok. Thanks!</p>
									</div>
								</div>
							</div>
							<div class="form-group padding-top-20 margin-bottom-0">
								<textarea id="textarea" class="form-control" placeholder="Type and press enter"></textarea>
								<button class="btn width-full margin-top-10">
									<i class="fa fa-send margin-right-5"></i>
									Send
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget widget-four background-transparent">
				<div class="row">
					<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
						<div class="step-block ">
							<span class="step-digit">
								<i class="icmn-database"><!-- --></i>
							</span>
							<div class="step-desc">
								<span class="step-title">Databases</span>
								<p>
									Total: 765
								</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
						<div class="step-block">
							<span class="step-digit">
								<i class="icmn-users"><!-- --></i>
							</span>
							<div class="step-desc">
								<span class="step-title">Users</span>
								<p>Total: 24 467</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
						<div class="step-block step-warning">
							<span class="step-digit">
								<i class="icmn-stats-growth"><!-- --></i>
							</span>
							<div class="step-desc">
								<span class="step-title">Daily Sales</span>
								<p>
									Total: 765
								</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
						<div class="step-block step-primary">
							<span class="step-digit">
								<i class="icmn-stats-dots"><!-- --></i>
							</span>
							<div class="step-desc">
								<span class="step-title">Bandwidth</span>
								<p>
									<span>160.32 GB/S</span>
									<span>&nbsp;</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- end .page-content-inner -->
<?php $this->load->view('part/js'); ?>

<!-- Page Scripts -->
<script>
    $(function() {

        ///////////////////////////////////////////////////////////
        // COUNTERS
        $('.counter-init').countTo({
            speed: 1500
        });

        ///////////////////////////////////////////////////////////
        // ADJUSTABLE TEXTAREA
        autosize($('#textarea'));

        ///////////////////////////////////////////////////////////
        // CUSTOM SCROLL
        if (!cleanUI.hasTouch) {
            $('.custom-scroll').each(function() {
                $(this).jScrollPane({
                    autoReinitialise: true,
                    autoReinitialiseDelay: 100
                });
                var api = $(this).data('jsp'),
                        throttleTimeout;
                $(window).bind('resize', function() {
                    if (!throttleTimeout) {
                        throttleTimeout = setTimeout(function() {
                            api.reinitialise();
                            throttleTimeout = null;
                        }, 50);
                    }
                });
            });
        }

        ///////////////////////////////////////////////////////////
        // CALENDAR
        $('.example-calendar-block').fullCalendar({
            //aspectRatio: 2,
            height: 450,
            header: {
                left: 'prev, next',
                center: 'title',
                right: 'month, agendaWeek, agendaDay'
            },
            buttonIcons: {
                prev: 'none fa fa-arrow-left',
                next: 'none fa fa-arrow-right',
                prevYear: 'none fa fa-arrow-left',
                nextYear: 'none fa fa-arrow-right'
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            viewRender: function(view, element) {
                if (!cleanUI.hasTouch) {
                    $('.fc-scroller').jScrollPane({
                        autoReinitialise: true,
                        autoReinitialiseDelay: 100
                    });
                }
            },
            defaultDate: '2016-05-12',
            events: [
                {
                    title: 'All Day Event',
                    start: '2016-05-01',
                    className: 'fc-event-success'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2016-05-09T16:00:00',
                    className: 'fc-event-default'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2016-05-16T16:00:00',
                    className: 'fc-event-success'
                },
                {
                    title: 'Conference',
                    start: '2016-05-11',
                    end: '2016-05-14',
                    className: 'fc-event-danger'
                }
            ],
            eventClick: function(calEvent, jsEvent, view) {
                if (!$(this).hasClass('event-clicked')) {
                    $('.fc-event').removeClass('event-clicked');
                    $(this).addClass('event-clicked');
                }
            }
        });

        ///////////////////////////////////////////////////////////
        // CAROUSEL WIDGET
        $('.carousel-widget').carousel({
            interval: 4000
        });

        $('.carousel-widget-2').carousel({
            interval: 6000
        });

        ///////////////////////////////////////////////////////////
        // DATATABLES
        $('#example1').DataTable({
            responsive: true,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
        });

        ///////////////////////////////////////////////////////////
        // CHART 1
        new Chartist.Line(".chart-line", {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            series: [
                [12, 9, 7, 8, 5],
                [2, 1, 3.5, 7, 3],
                [1, 3, 4, 5, 6]
            ]
        }, {
            fullWidth: !0,
            chartPadding: {
                right: 40
            },
            plugins: [
                Chartist.plugins.tooltip()
            ]
        });

        ///////////////////////////////////////////////////////////
        // CHART 2
        var overlappingData = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    series: [
                        [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
                        [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
                    ]
                },
                overlappingOptions = {
                    seriesBarDistance: 10,
                    plugins: [
                        Chartist.plugins.tooltip()
                    ]
                },
                overlappingResponsiveOptions = [
                    ["", {
                        seriesBarDistance: 5,
                        axisX: {
                            labelInterpolationFnc: function(value) {
                                return value[0]
                            }
                        }
                    }]
                ];

        new Chartist.Bar(".chart-overlapping-bar", overlappingData, overlappingOptions, overlappingResponsiveOptions);


    });
</script>
</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>