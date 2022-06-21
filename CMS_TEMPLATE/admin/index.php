<?php include "includes/admin_header.php" ?>

<?php 

$post_counts = get_all_user_posts();
$comment_counts = count_records(get_all_posts_user_comments());
$category_count = count_records(get_all_user_categories());

?>
    <div id="wrapper">
        <!-- Navigation -->

       
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Panel
                            <small><?php 
                            echo strtoupper(get_user_name());

                             ?></small>


                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                       
                <!-- /.row -->
                <!-- Google chart to display posts, users and other data -->
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <!-- Posts square -->
                    <div class='huge'><?php echo $post_counts; ?></div>
                    
                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- Comments square -->
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <div class='huge'><?php echo $comment_counts; ?></div>
                    
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- User count square -->

    <!-- Category count square -->
</div>
                <!-- /.row -->

                <?php 

                // Get counts of posts, users and comments
                
                $post_published_count = count_records(get_all_user_published_posts());

                $post_draft_count = checkStatus('posts', 'post_status', 'draft');

                $unapproved_comment_count = checkStatus('comments', 'comment_status', 'unapproved');

                $subscriber_count = checkStatus('users', 'user_role', 'subscriber');
                
                ?>

                <div class="row">
                <!-- JavaScript to display the Google chart -->
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

        //   We generate dynamically an array with element values

          <?php 
          
          $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments'];

          $element_count = [$post_counts, $post_published_count, $post_draft_count, $comment_counts, $unapproved_comment_count];
          
          //Echo the array into the script
          for($i=0; $i < 5; $i++){
              echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
          }
          ?>
          
        ]);
        //Chart options
        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- Admin footer -->
<?php include "includes/admin_footer.php" ?>
