				<style type="text/css">
                    @media(max-width: 768px){
            .title{
                display: none;
}
    
}             
                </style>
                <li style="color: black; background: white;">
                    <a href="#">
                        <?php
                        $adminimg=mysqli_query($link,"select logo from website where id = 1");
                        $rowadminimg = mysqli_fetch_row($adminimg); 
                        $webimage = $rowadminimg[0];
                        ?>
                        <div class="user">
                            <img src="img/Website/<?php echo $webimage; ?>" alt="" style="border-radius: 50%;">
                        </div>
                        <?php
                        $admin=mysqli_query($link,"select name from website where id = 1");
                        $rowadmin = mysqli_fetch_row($admin); 
                        $name = $rowadmin[0];
                        ?>
                       <div class="title" style="color: black; font-weight: bolder;"><?php echo $name ?></div>
                    </a>
                </li>