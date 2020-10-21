<?php include("inc/head.php"); ?>
        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">
            <!-- ===============================================
            ================= HEADER Content ===================
            ================================================ -->
            <section id="header">
                <header class="clearfix">

                    <!-- Branding -->
                    <div class="branding">
                        <a class="brand" href="index">
                            <span>AdminPanel <strong>2.0</strong></span>
                        </a>
                        <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- Branding end -->



                    <!-- Left-side navigation -->
                    <ul class="nav-left pull-left list-unstyled list-inline">
                        <li class="sidebar-collapse divided-right">
                            <a role="button" tabindex="0" class="collapse-sidebar">
                                <i class="fa fa-outdent"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- Left-side navigation end -->
                    <!-- Right-side navigation -->
                    <ul class="nav-right pull-right list-inline">

                        <li class="dropdown nav-profile" style='margin-right: 20px;'>

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <span><?php echo $moje_imie." ".$moje_nazwisko; ?> <i class="fa fa-angle-down"></i></span>
                            </a>

                            <ul class="dropdown-menu animated littleFadeInRight" role="menu">
                                <li>
                                    <a role="button" tabindex="0" href="settings">
                                        <i class="fa fa-cog"></i>Ustawienia
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a role="button" tabindex="0" href="logout">
                                        <i class="fa fa-sign-out"></i>Wyloguj
                                    </a>
                                </li>

                            </ul>

                        </li>
                    </ul>
                    <!-- Right-side navigation end -->
                </header>

            </section>
            <!--/ HEADER Content  -->
            <!-- =================================================
            ================= CONTROLS Content ===================
            ================================================== -->
            <div id="controls">
                <!-- ================================================
                ================= SIDEBAR Content ===================
                ================================================= -->
                <aside id="sidebar">

                    <div id="sidebar-wrap">

                        <div class="panel-group slim-scroll" role="tablist">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarNav">
                                            Operacje <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">


                                        <!-- ===================================================
                                        ================= NAVIGATION Content ===================
                                        ==================================================== -->
                                        <ul id="navigation">
                                            <li<?php if(empty($_GET['sid'])){echo ' class="active"';} ?>><a href="index"><i class="fa fa-home"></i> <span>Strona Główna</span></a></li>
                                            <li<?php if($_GET['sid'] >= 4 AND $_GET['sid'] <= 6){echo ' class="active"';} ?>><a href="index.php?sid=4" tabindex="0"><i class="fa fa-group"></i> <span>Użytkownicy</span></a></li>
																						<li<?php if($_GET['sid'] >= 7 AND $_GET['sid'] <= 9){echo ' class="active"';} ?>><a href="index.php?sid=7" tabindex="0"><i class="fa fa-th-large"></i> <span>Zlecenia</span></a></li>
																						<li<?php if($_GET['sid'] >= 21 AND $_GET['sid'] <= 22){echo ' class="active"';} ?>><a href="index.php?sid=21" tabindex="0"><i class="fa fa-paper-plane"></i> <span>Newsletter</span></a></li>
																						<li<?php if($_GET['sid'] >= 33 AND $_GET['sid'] <= 41){echo ' class="active"';} ?>><a href="index.php?sid=33" tabindex="0"><i class="fa fa-puzzle-piece"></i> <span>Zadania wykonawców</span></a></li>
																						
																				</ul>
                                        <!--/ NAVIGATION Content -->


                                    </div>
                                </div>
                            </div>
														
														<div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarNav2">
                                            Strony statyczne <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sidebarNav2" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">


                                        <!-- ===================================================
                                        ================= NAVIGATION Content ===================
                                        ==================================================== -->
                                        <ul id="navigation">
                                            <li<?php if($_GET['sid'] >= 10 AND $_GET['sid'] <= 14){echo ' class="active"';} ?>><a href="index.php?sid=10" tabindex="0"><i class="fa fa-life-ring"></i> <span>FAQ</span></a></li>
																						<li<?php if($_GET['sid'] == 15){echo ' class="active"';} ?>><a href="index.php?sid=15" tabindex="0"><i class="fa fa-legal"></i> <span>Regulamin</span></a></li>
																						<li<?php if($_GET['sid'] == 16){echo ' class="active"';} ?>><a href="index.php?sid=16" tabindex="0"><i class="fa fa-key"></i> <span>Polityka Prywatności</span></a></li>
																						<li<?php if($_GET['sid'] == 17){echo ' class="active"';} ?>><a href="index.php?sid=17" tabindex="0"><i class="fa fa-hand-o-right"></i> <span>Partnerzy</span></a></li>
																						<li<?php if($_GET['sid'] == 18){echo ' class="active"';} ?>><a href="index.php?sid=18" tabindex="0"><i class="fa fa-building"></i> <span>O Nas</span></a></li>
																						<li<?php if($_GET['sid'] == 19){echo ' class="active"';} ?>><a href="index.php?sid=19" tabindex="0"><i class="fa fa-clipboard"></i> <span>Pisz dla nas</span></a></li>
																						<li<?php if($_GET['sid'] == 20){echo ' class="active"';} ?>><a href="index.php?sid=20" tabindex="0"><i class="fa fa-paragraph"></i> <span>Zasady współpracy</span></a></li>
																						<li<?php if($_GET['sid'] >= 48 AND $_GET['sid'] <= 49){echo ' class="active"';} ?>><a href="index.php?sid=48" tabindex="0"><i class="fa fa-money"></i> <span>Zlecenia wypłat</span></a></li>
																				</ul>
                                        <!--/ NAVIGATION Content -->


                                    </div>
                                </div>
                            </div>
														
														<div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarNav3">
                                            Ustawienia <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sidebarNav3" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">


                                        <!-- ===================================================
                                        ================= NAVIGATION Content ===================
                                        ==================================================== -->
                                        <ul id="navigation">
                                            <li<?php if($_GET['sid'] >= 29 AND $_GET['sid'] <= 30){echo ' class="active"';} ?>><a href="index.php?sid=29" tabindex="0"><i class="fa fa-bar-chart"></i> <span>Statystyki</span></a></li>
																						<li<?php if($_GET['sid'] >= 31 AND $_GET['sid'] <= 32){echo ' class="active"';} ?>><a href="index.php?sid=31" tabindex="0"><i class="fa fa-institution"></i> <span>Filary wiedzy</span></a></li>
																						<li<?php if($_GET['sid'] >= 44 AND $_GET['sid'] <= 45){echo ' class="active"';} ?>><a href="index.php?sid=44" tabindex="0"><i class="fa fa-question-circle"></i> <span>Info dla zlecających</span></a></li>
																						<li<?php if($_GET['sid'] >= 42 AND $_GET['sid'] <= 43){echo ' class="active"';} ?>><a href="index.php?sid=42" tabindex="0"><i class="fa fa-bookmark-o"></i> <span>Wiadomości e-mail</span></a></li>
																						<li<?php if($_GET['sid'] >= 46 AND $_GET['sid'] <= 47){echo ' class="active"';} ?>><a href="index.php?sid=46" tabindex="0"><i class="fa fa-money"></i> <span>Ustawienia wypłat</span></a></li>
																						<li<?php if($_GET['sid'] >= 27 AND $_GET['sid'] <= 28){echo ' class="active"';} ?>><a href="index.php?sid=27" tabindex="0"><i class="fa fa-envelope"></i> <span>Kontakt</span></a></li>
																						
																				</ul>
                                        <!--/ NAVIGATION Content -->


                                    </div>
                                </div>
                            </div>
														
                            <div class="panel charts panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarCharts">
                                            Skrócone Statystyki <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
																
																<div id="sidebarCharts" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="summary">

                                            <div class="media">
                                                <a class="pull-right" role="button" tabindex="0">
                                                    <span class="sparklineChart"
																													<?php
																													$qGetLicznik2 = mysqli_query($connect,"SELECT * FROM `licznik_tydzien` ORDER BY `id` DESC LIMIT 1");
																													$sGetLicznik2 = mysqli_fetch_array($qGetLicznik2);
																													$day1_2 = $sGetLicznik2['day1'];
																													$day2_2 = $sGetLicznik2['day2'];
																													$day3_2 = $sGetLicznik2['day3'];
																													$day4_2 = $sGetLicznik2['day4'];
																													$day5_2 = $sGetLicznik2['day5'];
																													$day6_2 = $sGetLicznik2['day6'];
																													$day7_2 = $sGetLicznik2['day7'];
																													?>
                                                          values="<?=$day1_2;?>, <?=$day2_2;?>, <?=$day3_2;?>, <?=$day4_2;?>, <?=$day5_2;?>, <?=$day6_2;?>, <?=$day7_2;?>"
                                                          sparkType="bar"
                                                          sparkBarColor="#009be6"
                                                          sparkBarWidth="6px"
                                                          sparkHeight="36px">
                                                    Loading...</span>
                                                </a>
                                                <div class="media-body">
                                                    Odwiedziny W TYGODNIU
                                                    <h4 class="media-heading"><?php echo ($day1_2 + $day2_2 + $day3_2 + $day4_2 + $day5_2 + $day6_2 + $day7_2); ?></h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
																
                            </div>
                        </div>

                    </div>


                </aside>
                <!--/ SIDEBAR Content -->

            </div>
            <!--/ CONTROLS Content -->
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <?php
						if(empty($_GET['sid'])){
						include("inc/tablica.php");
						} else {
						include("inc/operations.php");
						}
						?>
            <!--/ CONTENT -->
        </div>
        <!--/ Application Content -->

        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="assets/js/vendor/d3/d3.min.js"></script>
        <script src="assets/js/vendor/d3/d3.layout.min.js"></script>

        <script src="assets/js/vendor/rickshaw/rickshaw.min.js"></script>

        <script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="assets/js/vendor/daterangepicker/moment.min.js"></script>
        <script src="assets/js/vendor/daterangepicker/daterangepicker.js"></script>

        <script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="assets/js/vendor/flot/jquery.flot.min.js"></script>
        <script src="assets/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
        <script src="assets/js/vendor/flot-spline/jquery.flot.spline.min.js"></script>

        <script src="assets/js/vendor/easypiechart/jquery.easypiechart.min.js"></script>

        <script src="assets/js/vendor/raphael/raphael-min.js"></script>
        <script src="assets/js/vendor/morris/morris.min.js"></script>

        <script src="assets/js/vendor/owl-carousel/owl.carousel.min.js"></script>

        <script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

        <script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>

				<script src="assets/js/vendor/summernote/summernote.min.js"></script>
				
        <script src="assets/js/vendor/coolclock/coolclock.js"></script>
        <script src="assets/js/vendor/coolclock/excanvas.js"></script>
				<script src="assets/js/vendor/filestyle/bootstrap-filestyle.min.js"></script>
        <!--/ vendor javascripts -->

        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="assets/js/main.js"></script>
        <!--/ custom javascripts -->

        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){
						//load wysiwyg editor
                $('#summernote').summernote({
                    height: 300   //set editable area's height
                });
									$('#summernote2').summernote({
                    height: 200   //set editable area's height
                });
									$('#summernote3').summernote({
                    height: 200   //set editable area's height
                });
								
						//load wysiwyg editor
                $('#summernote').summernote({
                    toolbar: [
                        //['style', ['style']], // no style button
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        //['insert', ['picture', 'link']], // no insert buttons
                        //['table', ['table']], // no table button
                        //['help', ['help']] //no help button
                    ],
                    height: 143   //set editable area's height
                });
									$('#summernote2').summernote({
                    toolbar: [
                        //['style', ['style']], // no style button
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        //['insert', ['picture', 'link']], // no insert buttons
                        //['table', ['table']], // no table button
                        //['help', ['help']] //no help button
                    ],
                    height: 143   //set editable area's height
                });
									$('#summernote3').summernote({
                    toolbar: [
                        //['style', ['style']], // no style button
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        //['insert', ['picture', 'link']], // no insert buttons
                        //['table', ['table']], // no table button
                        //['help', ['help']] //no help button
                    ],
                    height: 143   //set editable area's height
                });
						//*load wysiwyg editor
						
						//todo's
                $('.widget-todo .todo-list li .checkbox').on('change', function() {
                    var todo = $(this).parents('li');

                    if (todo.hasClass('completed')) {
                        todo.removeClass('completed');
                    } else {
                        todo.addClass('completed');
                    }
                });
                //* todo's

                // Initialize owl carousels
                $('#todo-carousel, #feed-carousel, #notes-carousel').owlCarousel({
                    autoPlay: 5000,
                    stopOnHover: true,
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    singleItem : true,
                    responsive: true
                });

                $('#appointments-carousel').owlCarousel({
                    autoPlay: 5000,
                    stopOnHover: true,
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    navigation: true,
                    navigationText : ['<i class=\'fa fa-chevron-left\'></i>','<i class=\'fa fa-chevron-right\'></i>'],
                    singleItem : true
                });
                //* Initialize owl carousels

                //Initialize mini calendar datepicker
                $('#mini-calendar').datetimepicker({
                    inline: true
                });
                // Initialize Statistics chart
                var data = [{
                    data: [[1,15],[2,40],[3,35],[4,39],[5,42],[6,50],[7,46],[8,49],[9,59],[10,60],[11,58],[12,74]],
                    label: 'Unique Visits',
                    points: {
                        show: true,
                        radius: 4
                    },
                    splines: {
                        show: true,
                        tension: 0.45,
                        lineWidth: 4,
                        fill: 0
                    }
                }, {
                    data: [[1,50],[2,80],[3,90],[4,85],[5,99],[6,125],[7,114],[8,96],[9,130],[10,145],[11,139],[12,160]],
                    label: 'Page Views',
                    bars: {
                        show: true,
                        barWidth: 0.6,
                        lineWidth: 0,
                        fillColor: { colors: [{ opacity: 0.3 }, { opacity: 0.8}] }
                    }
                }];

                var options = {
                    colors: ['#e05d6f','#61c8b8'],
                    series: {
                        shadowSize: 0
                    },
                    legend: {
                        backgroundOpacity: 0,
                        margin: -7,
                        position: 'ne',
                        noColumns: 2
                    },
                    xaxis: {
                        tickLength: 0,
                        font: {
                            color: '#fff'
                        },
                        position: 'bottom',
                        ticks: [
                            [ 1, 'JAN' ], [ 2, 'FEB' ], [ 3, 'MAR' ], [ 4, 'APR' ], [ 5, 'MAY' ], [ 6, 'JUN' ], [ 7, 'JUL' ], [ 8, 'AUG' ], [ 9, 'SEP' ], [ 10, 'OCT' ], [ 11, 'NOV' ], [ 12, 'DEC' ]
                        ]
                    },
                    yaxis: {
                        tickLength: 0,
                        font: {
                            color: '#fff'
                        }
                    },
                    grid: {
                        borderWidth: {
                            top: 0,
                            right: 0,
                            bottom: 1,
                            left: 1
                        },
                        borderColor: 'rgba(255,255,255,.3)',
                        margin:0,
                        minBorderMargin:0,
                        labelMargin:20,
                        hoverable: true,
                        clickable: true,
                        mouseActiveRadius:6
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: '%s: %y',
                        defaultTheme: false,
                        shifts: {
                            x: 0,
                            y: 20
                        }
                    }
                };

                var plot = $.plot($("#statistics-chart"), data, options);

                $(window).resize(function() {
                    // redraw the graph in the correctly sized div
                    plot.resize();
                    plot.setupGrid();
                    plot.draw();
                });
                // * Initialize Statistics chart

                //Initialize morris chart
                Morris.Donut({
                    element: 'browser-usage',
                    data: [
                        {label: 'Chrome', value: 25, color: '#00a3d8'},
                        {label: 'Safari', value: 20, color: '#2fbbe8'},
                        {label: 'Firefox', value: 15, color: '#72cae7'},
                        {label: 'Opera', value: 5, color: '#d9544f'},
                        {label: 'Internet Explorer', value: 10, color: '#ffc100'},
                        {label: 'Other', value: 25, color: '#1693A5'}
                    ],
                    resize: true
                });
                //*Initialize morris chart


                // Initialize owl carousels
                $('#todo-carousel, #feed-carousel, #notes-carousel').owlCarousel({
                    autoPlay: 5000,
                    stopOnHover: true,
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    singleItem : true,
                    responsive: true
                });

                $('#appointments-carousel').owlCarousel({
                    autoPlay: 5000,
                    stopOnHover: true,
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    navigation: true,
                    navigationText : ['<i class=\'fa fa-chevron-left\'></i>','<i class=\'fa fa-chevron-right\'></i>'],
                    singleItem : true
                });
                //* Initialize owl carousels


                // Initialize rickshaw chart
                var graph;

                var seriesData = [ [], []];
                var random = new Rickshaw.Fixtures.RandomData(50);

                for (var i = 0; i < 50; i++) {
                    random.addData(seriesData);
                }

                graph = new Rickshaw.Graph( {
                    element: document.querySelector("#realtime-rickshaw"),
                    renderer: 'area',
                    height: 133,
                    series: [{
                        name: 'Series 1',
                        color: 'steelblue',
                        data: seriesData[0]
                    }, {
                        name: 'Series 2',
                        color: 'lightblue',
                        data: seriesData[1]
                    }]
                });

                var hoverDetail = new Rickshaw.Graph.HoverDetail( {
                    graph: graph,
                });

                graph.render();

                setInterval( function() {
                    random.removeData(seriesData);
                    random.addData(seriesData);
                    graph.update();

                },1000);
                //* Initialize rickshaw chart

                //Initialize mini calendar datepicker
                $('#mini-calendar').datetimepicker({
                    inline: true
                });
                //*Initialize mini calendar datepicker


                //todo's
                $('.widget-todo .todo-list li .checkbox').on('change', function() {
                    var todo = $(this).parents('li');

                    if (todo.hasClass('completed')) {
                        todo.removeClass('completed');
                    } else {
                        todo.addClass('completed');
                    }
                });
                //* todo's


                //initialize datatable
                $('#project-progress').DataTable({
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                });
                //*initialize datatable
            });
        </script>
        <!--/ Page Specific Scripts -->
    </body>
</html>