<!DOCTYPE html>
<!--https://codepen.io/rachmatsasongko/pen/WKYYPa?__cf_chl_jschl_tk__=fb99d7da37ad5e7226e7af312d025076e0aa60c1-1576590510-0-AZUxQf958sxZLSj7QCWUprvU5JC2S_1JLts2SpwVgXpPCmI_cp2Gz0VBocZkkalYZwS-iThGUTnqA-JPufBi2ETN2IErFvZxZ88kMfYHhn5nWGaw2t9FRN85Eh5HCMy__eO0_1ZSVtZrzt9C6xNJTSXPX5W3VF590gVLaLb2_SZV10jP-3-EKwGtqVzZhsn_1Q_AwlBhdNNAuEzt04V2shfGVwMQNBpWwXdVOYHlcO2r7tUEQn3FHFQevuS67iCeAYFJ067c5YeVWCPNjyNmMweSWE1hz7eOeYwJ142GbLKygSFZ1gjpRLzGCyqwtEX50aI1xcx11k7ngc59TTwvuAE1_Tom3GGc7dj0mQvGsNik-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Project Antrian </title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/node_modules/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/node_modules/simple-line-icons/css/simple-line-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/node_modules/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet"
          href="<?= base_url('assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') ?>">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('assets/node_modules/font-awesome/css/font-awesome.min.css') ?>"/>
    <link rel="stylesheet"
          href="<?= base_url('assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css') ?>">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <!-- endinject -->

    <link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>

</head>

<body>
<!-- start container-->
<div class="container-scroller">
    <div id="app-container" style="background-color: #0ba1b5;">
        <!-- ---- HEADER SECTION ---- -->
        <div id="header-card" style="background-color: #0f1531;">
            <div class="row">
                <div class="col-9">
                    <!-- ---- TAG LINE AND BRAND SECTION -->
                    <div id="tagline-head">
                        <div class="tagline-wrapper">
                            <div class="parallelogram" style="background: white;">
                            </div>
                            <div class="brand-wrapper">
                                <img src="<?= base_url('assets/images/logo-dintanak.png') ?>" alt="" width="100%"
                                     height="100%">
                            </div>
                        </div>
                    </div>
                    <!-- ---- END BRAND AND TAG LINE SECTION -->

                </div>
                <div class="col-3">
                    <div id="date-time-indicator">
                        <div id="date-time-wrapper" style="background-color: #007bff2e">
                            <div class="time-indicator d-flex justify-content-center">
                                <h1 style="color:white;line-height: 60px;font-family: roboto-bold" class="m-0"
                                    id="time-content">
                                </h1>
                            </div>
                            <div class="date-indicator d-flex justify-content-center">
                                <h4 style="color: white;font-family: 'roboto-light', sans-serif;line-height: 44px"
                                    class="m-0" id="date-content">
                                    Kamis, 28 Januari 2019
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ---- END HEADER SECTION ---- -->


        <!-- ---- CONTENT SECTION ---- -->
        <div id="content-card">
            <div class="row">
                <div class="col-5">
                    <div id="queue-box-wrapper">


                                <div class="content">

                                </div>

<!--                        <audio autoplay src="--><?//= base_url('assets/audios/Airport_Bell.mp3') ?><!--" controls</audio>-->
                    </div>
                </div>
            </div>
        </div>

        <!-- ---- FOOTER SECTION ---- -->
        <div id="footer-card" style="background-color:  #0f1531;">
            <marquee behavior="scroll" direction="left" id="running-text" style="font-size: 20px;color: white;">Selamat
                Datang Di Dinas Pertanian dan Peternakan
            </marquee>
        </div>
        <!-- ---- END FOOTER SECTION ---- -->

    </div>
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="<?= base_url('assets/node_modules/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/moment/moment.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/popper.js/dist/umd/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') ?>"></script>
<!-- endinject -->

<!-- Plugin js for this page-->
<script src="<?= base_url('assets/') ?>node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/raphael/raphael.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/morris.js/morris.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- End plugin js for this page-->

<!-- inject:js -->
<script src="<?= base_url('assets/') ?>js/off-canvas.js"></script>
<script src="<?= base_url('assets/') ?>js/hoverable-collapse.js"></script>
<script src="<?= base_url('assets/') ?>js/misc.js"></script>
<script src="<?= base_url('assets/') ?>js/settings.js"></script>
<script src="<?= base_url('assets/') ?>js/todolist.js"></script>
<!-- endinject -->

<!-- Custom js for this page-->
<script src="<?= base_url('assets/js/plugins/countdown.js') ?>"></script>
<script src="<?= base_url('assets/js/antrian.js?ver=11') ?>"></script>
<script src="<?= base_url('assets/js/plugins/moment.js') ?>"></script>
<script src="<?= base_url('assets/') ?>js/dashboard.js"></script>
<script src="<?= base_url('assets/js/app/waktu.js') ?>"></script>
<script src="<?= base_url('assets/js/package/timer.js') ?>"></script>
<!-- End custom js for this page-->

<script>
    $(document).ready(function () {

        let baseUrl = window.location.origin + '/antrian/';
        $(document).keypress(function (key) {
            let btnSetting = key.originalEvent.key;
            if (btnSetting === 's') {
                window.location.href = baseUrl + 'settings';
            }
        })
    })
</script>

</body>

</html>
