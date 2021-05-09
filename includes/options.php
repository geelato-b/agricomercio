<?php
if(isset($status_logged_in)){
                          switch($status_logged_in['usertype']){
                              case 'Customer':
                          ?>
                           <a href="customer_page.php"><li><button class="dropdown-item" type="button">Profile</button></li></a>
                           <a href="logout.php"><li><button class="dropdown-item" type="button">Log Out</button></li></a>
                 <?php        break;
                              case 'Admin': 
                               header("location: admin/admin.php");
                                break;
                              case 'Seller':
                               header("location: seller/index.php");
                               break;
                          }
                }
                else{ ?>
                    <a href="form.php"><li><button class="dropdown-item" type="button">Sign Up</button></li></a>
                    <a href="sign_in.php"><li><button class="dropdown-item" type="button">Sign In</button></li></a>
                <?php }
                ?>
            