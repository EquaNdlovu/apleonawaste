<?php
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/top_menu.php';
require APPROOT . '/views/inc/side_menu.php';
//require APPROOT . '/views/inc/pagination.js';
?>

<!-- .app-main -->
<main class="app-main">
    <!-- .wrapper -->
    <div class="wrapper">
        <!-- .page -->
        <div class="page">
            <!-- .page-inner -->
            <div class="page-inner">
                <!-- .page-title-bar -->
                <style>
                    tr[data-stat=""] {
                        /* background-color: #FE4C5C; */
                        color: #FE4C5C;
                    }
                </style>

                <div>
                    <a href="<?php echo URLROOT; ?>/WTF_Docs/add" class="btn btn-dark">Add Waste Transfer Documentation</a>
                    <br><br>
                </div>
                
                <table id="WTF_Docs" class="table table-bordered">
                    <tr>
                        <th>WTF Client</th>
                        <th>WTF Site</th>
                        <th>WTF Date</th>
                        <th>WTF Number</th>
                    </tr>
                    <?php foreach ($data['WTF_Docs'] as $WTF_Doc) :
                        if ($_SESSION['country'] == 'IE' && $_SESSION['user_name'] != 'Administrator' ) {
                        $string = $_SESSION['customer_group'];
                        $string2 = strtok($string, " ");
                        $string3 = $WTF_Doc->wtf_site; } else {
                            $string2 = $_SESSION['country'];
                            $string3 = $WTF_Doc->wtf_country;
                        }
                        if (strpos($string3, $string2) !== false) { ?>
                        <!-- if (($WTF_Doc->wtf_site) == $_SESSION['customer_group']) { ?> -->
                        <tr data-stat="<?php echo $WTF_Doc->wtf_documentation?>">
                            <td><?php echo $WTF_Doc->wtf_client; ?></td>
                            <td><?php echo $WTF_Doc->wtf_site; ?></td>
                            <td><?php echo $WTF_Doc->wtf_date; ?></td>
                            <td><?php echo $WTF_Doc->wtf_number; ?></td>
                            <td><a href="<?php echo URLROOT; ?>/WTF_Docs/edit/<?php echo $WTF_Doc->wtf_key; ?>" class="btn btn-dark">Edit</a></td>
                        <?php }
                     endforeach; ?>
                </table>


            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
    </div><!-- .app-footer -->

    <?php
    require APPROOT . '/views/inc/footer.php';
    ?>