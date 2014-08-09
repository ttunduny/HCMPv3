<?php
$month = $this->session->userdata('Month');
if ($month == '') {
    $month = date('mY', time());
}
$year = substr($month, -4);
$month = substr_replace($month, "", -4);
$monthyear = $year . '-' . $month . '-1';
$englishdate = date('F, Y', strtotime($monthyear));

?>

<style type="text/css" title="currentStyle"> 

</style>
<script type="text/javascript">

$(document).ready(function() {
        //datatables settings 
        $('#maintable').dataTable({
            "sDom": "T lfrtip",
            "bPaginate": false,
            "aaSorting": [[3, "asc"]],
            "sScrollY": "377px",
            "sScrollX": "100%",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ Records per page",
                "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
            },
            "oTableTools": {
                "aButtons": [
                "copy",
                "print",
                {
                    "sExtends": "collection",
                    "sButtonText": 'Save',
                    "aButtons": ["csv", "xls", "pdf"]
                }
                ],
                "sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
            }
        });

        $.fn.slideFadeToggle = function(speed, easing, callback) {
            return this.animate({
                opacity: 'toggle',
                height: 'toggle'
            }, speed, easing, callback);
        };


        //       $(".alert").fadeIn(400);
        $(".notif").delay(20000).slideUp(1000);
        $("#tablediv").delay(15000).css("height", '450px');
        $(".dataTables_filter").delay(15000).css("color", '#ccc');
        $("#dpp_stats").click(function(event)
        {
            $(".dataTables_wrapper").load("<?php echo base_url(); ?>rtk_management/summary_tab_display/" + <?php echo $countyid; ?> + "/<?php echo $year; ?>/<?php echo $month; ?>/");

        });
    });
function loadcountysummary(county) {
            //$(".dash_main").load("<?php echo base_url(); ?>/rtk_management/rtk_reporting_by_county/" + county);
        }
        </script>
        <style>  
        #switch_district{font-size: 17px;margin: 8px 0px 13px 0px;}
        body > div.container-fluid > div > div > div.leftpanel > div > span{font-size: 18px;text-transform: uppercase;font-style: oblique;font-family: calibri;padding: 0px 6px 5px 17px;border-bottom: solid 1px #ccc;background: #D6CA00;width: 100%;font-style: normal;}
        .label {font-size: 11px;padding: 3px;}
        body > div.container-fluid > div > h1{margin-left: 235px;}
        table {
            font-size: 13px;
        }
        </style>
        <script type="text/javascript">
        $(function() {
            $('#switch_district').change(function() {
                var value = $('#switch_district').val();
                var path = "<?php echo base_url() . 'rtk_management/switch_district/'; ?>" + value + "/scmlt";
                window.location.href = path;
            });
        });
        </script>
        <?php if ($this->session->userdata('switched_as') == 'scmlt') { ?>
        <div id="fixed-topbar" style="position: fixed;margin-left:18%; top: 74px;background: #708BA5; width: 100%;padding: 7px 1px 0px 13px;border-bottom: 1px solid #ccc;border-bottom: 1px solid #ccc;border-radius: 4px 0px 0px 4px;">
            <span class="lead" style="color: #ccc;">Switch back to RTK Manager</span>
            &nbsp;
            &nbsp;
            <a href="<?php echo base_url(); ?>rtk_management/switch_district/0/rtk_manager/0/home_controller/0//" class="btn btn-primary" id="switch_idenity" style="margin-top: -10px;">Go</a>
        </div><?php } ?>



        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
            <div class="leftpanel">
                <div class="sidebar">
                    <?php
                    $option = '';
                    $id = $this->session->userdata('user_id');
                    $q = 'SELECT * from dmlt_districts,districts 
                    where dmlt_districts.district=districts.id
                    and dmlt_districts.dmlt=' . $id;
                    $q1 = 'SELECT * from user,districts 
                    where user.district=districts.id
                    and user.id=' . $id;
                    $res = $this->db->query($q);
                    $res1 = $this->db->query($q1);
                    foreach ($res->result_array() as $key => $value) {
                        $option .= '<option value = "' . $value['id'] . '">' . $value['district'] . '</option>';
                    }
                    foreach ($res1->result_array() as $key => $value) {
                        $option .= '<option value = "' . $value['id'] . '">' . $value['district'] . '</option>';
                    }
                    ?>
                    <span style="" class="label label-info">Switch Sub-Counties</span>
                    <br />
                    <br />
                    <select id="switch_district">
                        <option>-- Select Sub-County --</option>
                        <?php echo $option; ?>
                    </select>
                    <br />
                    <div class="panel-group " id="accordion" style="padding: 0;">
                        <div class="panel panel-default active-panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="<?php echo base_url('Home'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-bullhorn">
                                    </span>Home</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default active-panel">
                            <div class="panel-heading">
                                <h4 class="panel-title" id="dpp_stats">                        
                                    <a href="#" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-stats">
                                    </span>Statistics</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="<?php echo site_url('rtk_management/rtk_orders'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-sort-by-attributes">
                                    </span>Orders</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="<?php echo site_url('rtk_management/rtk_allocation'); ?>" href="#collapseThree" id="expiries"><span class="glyphicon glyphicon-trash">
                                    </span>Allocation</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dash_main" id = "dash_main">
                <div style="font-size: 13px;">
                    <?php
                    $district = $this->session->userdata('district_id');
                    $district_name = Districts::get_district_name($district)->toArray();
                    $d_name = $district_name[0]['district'];
                    ?>
                    <br />
                    <!-- Report Progress-->
                    <?php
                    $progress_class = " ";
                    if ($percentage_complete <= 100) {
                        $progress_class = 'success';
                    }
                    if ($percentage_complete < 75) {
                        $progress_class = 'info';
                    }
                    if ($percentage_complete < 50) {
                        $progress_class = 'warning';
                    }
                    if ($percentage_complete < 25) {
                        $progress_class = 'danger';
                    }
                    $alertype = '';
                    $alertmsg = '';
                    $date = date('d', time());
                    $lastmonth = date('F', strtotime("last day of previous month"));
                    $thismonth = date('F', strtotime("this month"));
                    $nextmonth = date('F', strtotime("next month"));

                    $sql = "select distinct rtk_settings.* 
                    from rtk_settings, facilities 
                    where facilities.zone = rtk_settings.zone 
                    and facilities.rtk_enabled = 1";
                    $res_ddl = $this->db->query($sql);
                    $deadline_date = null;
                    $settings = $res_ddl->result_array();
                    foreach ($settings as $key => $value) {
                        $deadline_date = $value['deadline'];
                        $five_day_alert = $value['5_day_alert'];
                        $report_day_alert = $value['report_day_alert'];
                        $overdue_alert = $value['overdue_alert'];
                    }
                    $remainingdays = $deadline_date - $date;
                    if($remainingdays<0){
                       $remainingdays = 0;
                   }
                   $remainingpercentage = 100 - $percentage_complete;
                   $five_days_prior = $deadline_date - 5;

                   if($date>0 && $date <$five_days_prior){
                    $alertmsg = '<strong>Take note: ' . $d_name . ' District</strong><br /><br />
                    Reporting for ' . $lastmonth . ' is on, and the Deadline is on the '.$deadline_date.'<br > Click on <u>Report</u> for all Facilities with the red label
                    after this label within the table below<br > <span class="label label-important">  Pending for ' . $lastmonth . '</span>';            
                    $alertype = 'danger';
                    if($percentage_complete==100){
                        $alertype = 'success';
                        $alertmsg = '<i aria-hidden="true" class="icon-thumbs-up"> </i><strong> Congratulations !</strong> <br /><br />
                        You have reported for all facilities in your district in record time.<br /><br />
                        You have ' . $remainingdays . ' days to cross-check and edit your reports';
                    }

                }else if($date == $five_days_prior){
                    $alertmsg = '<strong>Take note: ' . $d_name . ' District</strong><br /><br />'.$five_day_alert;                
                    $alertype = 'error';
                    if($percentage_complete==100){
                        $alertype = 'success';
                        $alertmsg = '<i aria-hidden="true" class="icon-thumbs-up"> </i><strong> Congratulations !</strong> <br /><br />
                        You have reported for all facilities in your district in record time.<br /><br />
                        You have ' . $remainingdays . ' days to cross-check and edit your reports';
                    }



                }else if($date>$five_days_prior && $date<$deadline_date){
                    $alertmsg = '<strong>Take note: ' . $d_name . ' District</strong><br /><br />
                    You are Requested to Complete the Reporting Process as you have '.$remainingdays.' days left';                
                    $alertype = 'error';
                    if($percentage_complete==100){
                        $alertype = 'success';
                        $alertmsg = '<i aria-hidden="true" class="icon-thumbs-up"> </i><strong> Congratulations !</strong> <br /><br />
                        You have reported for all facilities in your district in record time.<br /><br />
                        You have ' . $remainingdays . ' days to cross-check and edit your reports';
                    }



                }else if($date == $deadline_date){
                    $alertmsg = '<strong>Take note: ' . $d_name . ' District</strong><br /><br />'.$report_day_alert;                
                    $alertype = 'error';

                    if($percentage_complete==100){
                        $alertype = 'success';
                        $alertmsg = '<i aria-hidden="true" class="icon-thumbs-up"> </i><strong> Congratulations !</strong> <br /><br />
                        You have reported for all facilities in your district in record time.<br /><br />
                        You have ' . $remainingdays . ' days to cross-check and edit your reports';
                    }


                }else if($date>$deadline_date){
                    $alertmsg = '<strong>Take note: ' . $d_name . ' District</strong><br /><br />'.$overdue_alert;                
                    $alertype = 'success';

                    if($percentage_complete==100){
                        $alertype = 'success';
                        $alertmsg = '<i aria-hidden="true" class="icon-thumbs-up"> </i><strong> Congratulations !</strong> <br /><br />
                        You have reported for all facilities in your district in record time.<br /><br />
                        You have ' . $remainingdays . ' days to cross-check and edit your reports';
                    }


                }
                /*if ($percentage_complete == 100) {
                    $alertype = 'success';
                    $alertmsg = '<i aria-hidden="true" class="icon-thumbs-up"> </i><strong> Congratulations !</strong> <br /><br />
                    You have already reported for all facilities in your district. <br /><br />
                    You have ' . $remainingdays . ' days to cross-check and edit your reports';
//                                        You will be allowed to begin reporting for ' . $lastmonth . ' as from 25th of ' . $thismonth . '';                                        


                }*/
                $sql1 = "select distinct rtk_alerts.*, rtk_alerts_reference.* from rtk_alerts,rtk_alerts_reference,facilities,districts 
                where (facilities.Zone = rtk_alerts_reference.description or rtk_alerts_reference.description = 'All Districts')
                and facilities.district = $district
                and rtk_alerts.reference = rtk_alerts_reference.id                                    
                and rtk_alerts.status = 0
                ";
                $res_alerts = $this->db->query($sql1);                                    
                $notif_alerts = $res_alerts->result_array();
                foreach ($notif_alerts as $value) {
                    $notification = $value['message'];?>
                    <div class="alert notices alert-warning" style="margin-top:-21px;"><?php echo '<p>'.$notification.'</p>';
                    ?> </div> <?php

                }
                if($percentage_complete==100){
                    $alertype ='success';
                }else{
                    $alertype = $progress_class;
                }
                ?>
                <div class="alert alert-<?php echo $alertype ?>" style="margin-top:-18px;"><?php echo $alertmsg ?></div>

                <?php if (isset($notif_message)) {
                    if ($notif_message != '') {
                        $alertype = "error";
                        echo '<div class="alert notif alert-success" style="margin-top:-18px;">' . $notif_message . ' </div>';
                    }
                }?>

                <?php

                /*if ($date > 0 && $date < $five_days_prior) {
                    $alertmsg = '<strong>Take note: ' . $d_name . ' Sub-County</strong><br /><br />
                    Reporting for ' . $lastmonth . ' is on, and the Deadline is on the ' . $deadline_date . '<br > Click on <u>Report</u> for all Facilities with the red label
                    after this label within the table below<br > <span class="label label-important">  Pending for ' . $lastmonth . '</span>';
                    $alertype = "success";
                    echo '<div style="margin-left:5px;" class="alert ' . $alertype . '">' . $alertmsg . ' </div>';
                } else if ($date == $five_days_prior) {
                    $alertmsg = '<strong>Take note: ' . $d_name . ' Sub-County</strong><br /><br />' . $five_day_alert;
                    $alertype = "error";
                    echo '<div style="margin-left:5px;" class="alert ' . $alertype . '">' . $alertmsg . ' </div>';
                } else if ($date > $five_days_prior && $date < $deadline_date) {
                    $alertmsg = '<strong>Take note: ' . $d_name . ' Sub-County</strong><br /><br />
                    You are Requested to Complete the Reporting Process as you have ' . $remainingdays . ' days left';
                    $alertype = "error";
                    echo '<div style="margin-left:5px;" class="alert ' . $alertype . '">' . $alertmsg . ' </div>';
                } else if ($date == $deadline_date) {
                    $alertmsg = '<strong>Take note: ' . $d_name . ' Sub-County</strong><br /><br />' . $report_day_alert;
                    $alertype = "error";
                    echo '<div style="margin-left:5px;" class="alert ' . $alertype . '">' . $alertmsg . ' </div>';
                } else if ($date > $deadline_date) {
                    $alertmsg = '<strong>Take note: ' . $d_name . ' Sub-County</strong><br /><br />' . $overdue_alert;
                    $alertype = "bg-danger";
                    echo '<div style="margin-left:5px;" class="alert ' . $alertype . '">' . $alertmsg . ' </div>';
                }*/



                ?>
            </div>
            <div id="tablediv" style="margin-left:5px;">
                <table  style="margin-left: 0;" id="maintable" width="100%" >
                    <thead>
                        <tr>
                            <th><b>MFL Code</b></th>
                            <th><b>Facility Name</b></th>
                            <th><b>District</b></th>
                            <th ><b>FCDRR Reports</b></th> 

                        </tr>
                    </thead>
                    <tbody id="facilities_home">
                        <?php echo $table_body; ?>
                    </tbody>            
                </table>
                <br /><br /><br />

            </div>
        </div>

        <div style="position:fixed; bottom: 0;margin-bottom: 25px;margin-left:5px;width: 80%;font-size: 118%; background: #fff;">
            <span>Reports Progress: <?php echo $percentage_complete; ?>% </span>

<!--    <div class="progress progress-<?php echo $progress_class; ?>" style="height: 10px;">
        <div class="bar" style="width: <?php echo $percentage_complete; ?>%"></div>
    </div>-->

    <div class="progress">
        <div class="progress-bar progress-bar-<?php echo $progress_class; ?>" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage_complete; ?>%">
            <span class="sr-only"><?php echo $percentage_complete; ?>% Complete </span>
        </div>
    </div>



</div>
</div>



<link rel="stylesheet" type="text/css" href="http://tableclothjs.com/assets/css/tablecloth.css">


<script src="http://tableclothjs.com/assets/js/jquery.tablesorter.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.metadata.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("table").tablecloth({theme: "paper"});
});

</script>

