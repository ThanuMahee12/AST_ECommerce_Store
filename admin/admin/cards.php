<div class="cards">
                <div class="card" style="background-color: black;">
                    <div class="card-content">
                        <?php

                        $res=mysqli_query($link,"select * from tbl_order");
                        $count3 = mysqli_num_rows($res);
                        ?>
                        <div class="number" style="font-size: 20px;"><?php echo $count3 ?></div>
                        <div class="card-name" style="color: white;">Orders</div>
                    </div>
                    <div class="icon-box">
                        <i class="fad fa-cart-arrow-down" style="color: white;"></i>
                    </div>
                </div>
                <div class="card" style="background-color: black;">
                    <div class="card-content">
                        <?php

                        $res=mysqli_query($link,"select * from cus_details");
                        $count = mysqli_num_rows($res);
                        ?>
                        <div class="number" style="font-size: 20px;"><?php echo $count ?></div>
                        <div class="card-name" style="color: white;">Customers</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-user" style="color: white;"></i>
                    </div>
                </div>
                <div class="card" style="background-color: black;">
                    <div class="card-content">
                        <?php

                        $res=mysqli_query($link,"select * from tbl_product");
                        $count2 = mysqli_num_rows($res);
                        ?>
                        <div class="number" style="font-size: 20px;"><?php echo $count2 ?></div>
                        <div class="card-name" style="color: white;">Products</div>
                    </div>
                    <div class="icon-box">
                        <i class="fab fa-product-hunt" style="color: white;"></i>
                    </div>
                </div>
                <div class="card" style="background-color: black;">
                    <div class="card-content">
                        <?php
                        $profit = 0;
                        $res=mysqli_query($link,"select * from payment_details");
                        while($row=mysqli_fetch_array($res))
                        {
                            $profit = $profit + $row["total"];
                        }
                        ?>
                        <div class="number" style="font-size: 20px;">RS. <?php echo $profit ?></div>
                        <div class="card-name" style="color: white;">Sales</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-dollar-sign" style="color: white;"></i>
                    </div>
                </div>
            </div>