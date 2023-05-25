<?php
include 'inc/header.php';
include 'inc/banner.php';
?>
<?php
$blog = new Blog();
$place = new Place();
?>
<div class="container-fuild">
    <div id="blog" style="clear: both;">
        <h1>BLOG</h1>
        <?php
        $result_blog = $blog->blogShow();
        if ($result_blog) {
            while ($result = $result_blog->fetch_assoc()) {

        ?>
                <div class="blog-detail">
                    <div <?php if ($result['blogType'] == 1) echo 'class="blog-detail-left"';
                            else echo 'class="blog-detail-right"'; ?>>
                        <div class="image">
                            <img src="admin/uploads/<?php echo $result['blogImage'] ?>" alt="">
                        </div>
                        <div class="descript">
                            <div class="title">
                                <?php echo $result['blogTitle'] ?>
                            </div>
                            <div class="details">
                                <?php echo $result['blogDetail'] ?>
                            </div>
                            <a href="#">Read more</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div style="position: relative;" id="ppp">
        <h1>POPULAR PLACES</h1>
        <button id="place_prev" class="fa-solid fa-angle-left"></button>
        <div id="popularPlace">
            <div id="list">
                <?php
                $get_place = $place->placeShow();
                if ($get_place) {
                    while ($result = $get_place->fetch_assoc()) {
                ?>
                        <div class="place">
                            <img src="admin/uploads/<?php echo $result['placeImage'] ?>" class="placeavatar" alt="">
                            <div class="content">
                                <table style="width: 100%;">
                                    <tr>
                                        <td><?php echo $result['placeName'] ?></td>
                                        <td><i class="fa-solid fa-star"></i> <?php echo $result['star'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fa-sharp fa-solid fa-location-dot"></i> <?php echo $result['Country'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <button id="place_next" class="fa-solid fa-angle-right"></button>
    </div>
</div>
<?php
include 'inc/footer.php';
?>
<script src="asset/script.js"></script>
</body>

</html>