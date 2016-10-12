<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb'); ?>
    <div id="content">
        <div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Reporting</strong>
               </h3>
           </div>
           <!-- <div class="pull-right">
               <a href="<?php echo base_url('admin/settings/addRoomType');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Room Type</a>
           </div> -->
       </div>
        <!-- widget grid -->
        <section id="widget-grid" class="">

            <!-- row -->
            <div class="row">

                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                        
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2><?=$list_heading?></h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <div class="jarviswidget-editbox">
                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <canvas id="pieChart" height="120"></canvas>
                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->
            </div>

        </section>

    </div>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/chartjs/chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dateformat.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // PIE CHART

        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - types of animation
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - Re-draw chart on page resize
            responsive: true,
            //String - A legend template
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };

        var pieData = [
                {
                    value: 300,
                    color:"rgba(220,220,220,0.9)",
                    highlight: "rgba(220,220,220,0.8)",
                    label: "Grey"
                },
                {
                    value: 50,
                    color: "rgba(151,187,205,1)",
                    highlight: "rgba(151,187,205,0.8)",
                    label: "Blue"
                },
                {
                    value: 100,
                    color: "rgba(169, 3, 41, 0.7)",
                    highlight: "rgba(169, 3, 41, 0.7)",
                    label: "Red"
                }
            ];

            // render chart
            var ctx = document.getElementById("pieChart").getContext("2d");
            var myNewChart = new Chart(ctx).Pie(pieData, pieOptions);

            // END PIE CHART
    });

</script>
