<div class="table-pagination">
                    
    <?php
    
        $query_2 = "SELECT COUNT(*) FROM $table";
        $rs_result = mysqli_query($conn, $query_2);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        echo "</br>";
        $total_pages = ceil($total_records / $per_page_record);
        $count = 7;
        $startPage = max(1, $page - $count);
        $endPage = min($total_pages, $page + $count);
        $pagLink = "";       
    
    
    ?>

    <?php if($page>=2):?>
        <a href="<?php echo BASE_URL . $path .($page-1);?>">  Prev </a>
    <?php endif;?>

    <?php for($i=$startPage; $i<=$endPage; $i++): //$total_pages?>
        <?php if($i == $page):?>

            <a class="table-pagination-active-page" href="<?php echo BASE_URL . $path . $i;?>"> <?php echo $i;?> </a>

        <?php else:?> 

            <a href="<?php echo BASE_URL . $path . $i;?>"> <?php echo $i;?> </a>

        <?php endif;?>

    <?php endfor;?>
    
    <?php if($page<$total_pages):?>
        
        <a href="<?php echo BASE_URL . $path .($page+1);?>">  Next </a>

    <?php endif;?>

</div>